<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Throwable;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Aws\Textract\TextractClient;

class OCRController extends Controller
{
  public function scan(Request $request)
  {
    set_time_limit(0);
    ini_set('memory_limit', '-1');

    $file = $request->file('leads');
    $key = time() . random_string();
    $filepath = $file->storeAs('', $key . '.' . $file->getClientOriginalExtension());
    $filepath = storage_path('app/' . $filepath);

    try {

        $provider = new Credentials(Config::get('aws.credentials.key'), Config::get('aws.credentials.secret'));
        $s3 = new S3Client([
            'version'     => 'latest',
            'region'      => Config::get('aws.region'),
            'credentials' => $provider
        ]);

        $result = $s3->putObject(array(
            'Bucket'     => Config::get('aws.bucket'),
            'Key'        => $key,
            'SourceFile' => $filepath,
        ));
        $path = $result['ObjectURL'];

        $textract = new TextractClient(array(
            'version'     => 'latest',
            'region'      => Config::get('aws.region'),
            'credentials' => $provider
        ));

        $result = $textract->startDocumentAnalysis(array(
            'DocumentLocation' => array(
                'S3Object' => array(
                    'Bucket' => Config::get('aws.bucket'),
                    'Name' => $key
                )
            ),
            'FeatureTypes' => array('TABLES')
        ));
        $jobId = $result['JobId'];
        $time_start = microtime(true);
        while(true) {
            $result = $textract->getDocumentAnalysis(array(
                'JobId' => $jobId
            ));
            $jobStatus = $result['JobStatus'];
            $elapsed = microtime(true) - $time_start;

            if($jobStatus == 'SUCCEEDED' || $jobStatus == 'FAILED')
            {
                if($jobStatus == 'SUCCEEDED')
                {
                    $results = $result['Blocks'];
                    $token = $result['NextToken'];
                    while ($token != null)
                    {
                        $nextResult = $textract->getDocumentAnalysis(array(
                            'JobId' => $jobId,
                            'NextToken' => $token
                        ));
                        $results = array_merge($results, $nextResult['Blocks']);
                        $token = $nextResult['NextToken'];
                    }
                    // Scan Finished
                }
                break;
            }
        }

        $s3->deleteObject(array(
            'Bucket'    => Config::get('aws.bucket'),
            'Key'       => $key
        ));

        if($jobStatus != 'SUCCEEDED') {
            return Response::json(array (
                    'result' => 'error',
                    'message' => 'Scan ' . $jobStatus
                )
            );
        }

        $elapsed = microtime(true) - $time_start;
        error_log('Run Finish : ' . $elapsed . 'ms');

        return Response::json(array (
                'result' => 'success',
                'message' => 'Scan Success'
            )
        );
    } catch (Throwable $e) {
        return Response::json(array (
            'result' => 'error',
            'message' => 'Failed : ' . $e->getMessage()
            )
        );
    }
  }

}
