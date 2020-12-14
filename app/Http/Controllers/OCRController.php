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

use LaravelDocusign\Facades\DocuSign;

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
                'Social Security Income' => [],
                'Monthly Reverse Mortgage Statement' => [],
                'HUD 92900A' => [],
            );
            $words = [];
            $officer = '';
            $forms = [];

            while(true) {
                $result = $textract->getDocumentAnalysis(array(
                    'JobId' => $jobId
                ));
                $jobStatus = $result['JobStatus'];

                if($jobStatus == 'SUCCEEDED' || $jobStatus == 'FAILED')
                {
                    if($jobStatus == 'SUCCEEDED')
                    {
                        parseResult($result['Blocks'], $results, $words, $officer, $forms);

                        $token = $result['NextToken'];
                        while ($token != null)
                        {
                            $nextResult = $textract->getDocumentAnalysis(array(
                                'JobId' => $jobId,
                                'NextToken' => $token
                            ));

                            parseResult($nextResult['Blocks'], $results, $words, $officer, $forms);
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

            // For PDF Separate
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
            $zip->close();

            // For DocuSign
            $short_officer = strtolower(preg_replace('/\s+/', '', $officer));
            if(!empty($short_officer)) {
                $docusign = DocuSign::create();

                $pdf = new Fpdi();
                $pdf->setSourceFile($filepath);

                $email = 'tyler@southrivermtg.com'; // Retrieve from User DB by officer name
                $signHereTabs = [];
                foreach($forms as $formkey => $rect) {
                    if((strpos($formkey, 'signature') !== false && (strpos($formkey, 'loan') !== false || strpos($formkey, 'officer') !== false || strpos($formkey, 'lender') !== false))
                        || (strpos($formkey, $short_officer) !== false)) {
                        $tplIdx = $pdf -> importPage($rect['Page']);
                        $size = $pdf->getTemplateSize($tplIdx);

                        $pageId = $pdf->importPage($rect['Page']);
                        $size = $pdf->getImportedPageSize($pageId);

                        $width = isset($size['width']) ? $size['width'] : (isset($size['w']) ? $size['w'] : (isset($size['0']) ? $size['0'] : 0));
                        $height = isset($size['height']) ? $size['height'] : (isset($size['h']) ? $size['h'] : (isset($size['1']) ? $size['1'] : 0));

                        $width = mmToPt($width);
                        $height = mmToPt($height);

                        array_push($signHereTabs, $docusign->signHere([
                            'document_id' => '1',
                            'page_number' => $rect['Page'],
                            'x_position'  => round($width * $rect['Rect']['Left']),
                            'y_position'  => round($height * $rect['Rect']['Top'] - 20)
                        ]));
                    }
                }

                $envelopeDefinition = $docusign->envelopeDefinition([
                    'status'        => 'sent',
                    'email_subject' => 'Please sign this document',
                    'email_blurb'   => 'Hi ' . $officer . '<br>Please sign the above document.<br>Thank You, Tyler Plack',
                    'recipients'    => $docusign->recipients([
                        'signers' => [
                            $docusign->signer([
                                'email' 	    => $email,
                                'name'  	    => $officer,
                                'recipient_id'  => '1',
                                'routing_order' => '1',
                                'tabs'          => $docusign->tabs([
                                    'sign_here_tabs' => $signHereTabs
                                ])
                            ])
                        ]
                    ]),
                    'documents'     => [
                        $docusign->document([
                            'document_base64' => base64_encode(file_get_contents($filepath)),
                            'name'            => 'PDF for ' . $officer,
                            'document_id'     => '1'
                        ])
                    ]
                ]);
                error_log(json_encode(\DocuSign\eSign\ObjectSerializer::sanitizeForSerialization($envelopeDefinition->getRecipients())));
                $envelopeSummary = $docusign->envelopes->createEnvelope($envelopeDefinition);
                error_log('Envelope ' . $envelopeSummary->getEnvelopeId() . ' with pdf for sign ' . $envelopeSummary->getStatus());
            }

            unlink($filepath);
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
                    'message' => 'Failed : ' . $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                )
            );
        }
    }

}
