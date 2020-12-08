<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Throwable;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Aws\Textract\TextractClient;

use setasign\Fpdi\Tcpdf\Fpdi;

use ZanySoft\Zip\Zip;

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
        $time_start = microtime(true);

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
        error_log($path);

        $elapsed = microtime(true) - $time_start;
        error_log('Upload to S3 Finish : ' . $elapsed . 'ms');

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
            'FeatureTypes' => array('FORMS')
        ));
        $jobId = $result['JobId'];

        $results = array(
            'Form 1009' => [],
            'Borrower Authorization' => [],
            'Counseling Certificate' => [],
            'Anti-Churning Form' => [],
            'GFE' => [],
            'Driver\'s License' => [],
            'Social Security Card' => [],
            'Social Security Income' => [],
            'Monthly Reverse Mortgage Statement' => [],
            'HUD 90900A' => [],
        );
        $words = [];
        $officer = '';

        while(true) {
            $result = $textract->getDocumentAnalysis(array(
                'JobId' => $jobId
            ));
            $jobStatus = $result['JobStatus'];

            if($jobStatus == 'SUCCEEDED' || $jobStatus == 'FAILED')
            {
                if($jobStatus == 'SUCCEEDED')
                {
                    parseResult($result['Blocks'], $results, $words, $officer);

                    $token = $result['NextToken'];
                    while ($token != null)
                    {
                        $nextResult = $textract->getDocumentAnalysis(array(
                            'JobId' => $jobId,
                            'NextToken' => $token
                        ));

                        parseResult($nextResult['Blocks'], $results, $words, $officer);
                        $token = $nextResult['NextToken'];

                        usleep(200 * 1000);
                    }
                }
                break;
            }

            usleep(200 * 1000);
        }

        $s3->deleteObject(array(
            'Bucket'    => Config::get('aws.bucket'),
            'Key'       => $key
        ));

        if($jobStatus != 'SUCCEEDED') {
            unlink($filepath);

            $elapsed = microtime(true) - $time_start;
            error_log('Failed Finish : ' . $elapsed . 'ms');

            return Response::json(array (
                    'result' => 'error',
                    'message' => 'Scan ' . $jobStatus
                )
            );
        }

        // Scan Finished
        error_log(json_encode($results));

        Storage::disk('local')->makeDirectory($key);
        $zip = Zip::create(storage_path('app/' . $key . '.zip'));
        foreach($results as $type => $pages) {
            if(empty($pages))
                continue;
            $pdf = new Fpdi();
            $pdf->setSourceFile($filepath);
            foreach($pages as $page) {
                $templateId = $pdf->importPage($page);
                $pdf->AddPage();
                $pdf->useTemplate($templateId);
            }
            $pdf->Output(storage_path('app/' . $key . '/' . $type . '.pdf'), 'F');
            $zip->add(storage_path('app/' . $key . '/' . $type . '.pdf'));
        }
        unlink($filepath);
        $zip->close();
        Storage::disk('local')->deleteDirectory($key);

        $elapsed = microtime(true) - $time_start;
        error_log('Success Finish : ' . $elapsed . 'ms');

        return Response::json(array (
                'result' => 'success',
                'message' => 'Scan Success',
                'link' => '/files/' . $key,
                'officer' => $officer,
                'time' => $elapsed
            )
        );
    } catch (Throwable $e) {
        unlink($filepath);
        Storage::disk('local')->deleteDirectory($key);

        $elapsed = microtime(true) - $time_start;
        error_log('Error Finish : ' . $elapsed . 'ms');

        return Response::json(array (
                'result' => 'error',
                'message' => 'Failed : ' . $e->getMessage()
            )
        );
    }
  }

}
