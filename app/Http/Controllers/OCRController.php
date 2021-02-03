<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Throwable;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use Aws\Textract\TextractClient;

use setasign\Fpdi\Tcpdf\Fpdi;

use ZanySoft\Zip\Zip;

use LaravelDocusign\Facades\DocuSign;
use DocuSign\eSign\ObjectSerializer;

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
            $officer_found = false;
            $forms = [];
            $rotates = [];

            while(true) {
                $result = $textract->getDocumentAnalysis(array(
                    'JobId' => $jobId
                ));
                $jobStatus = $result['JobStatus'];

                if($jobStatus == 'SUCCEEDED' || $jobStatus == 'FAILED')
                {
                    if($jobStatus == 'SUCCEEDED')
                    {
                        parseResult($result['Blocks'], $results, $words, $officer, $officer_found, $forms, $rotates);

                        $token = $result['NextToken'];
                        while ($token != null)
                        {
                            $nextResult = $textract->getDocumentAnalysis(array(
                                'JobId' => $jobId,
                                'NextToken' => $token
                            ));

                            parseResult($nextResult['Blocks'], $results, $words, $officer, $officer_found, $forms, $rotates);
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


            if(!$officer_found) {
                $officer = '';
            } else {
                error_log("Officer Name: " . $officer);
            }

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
                    $size = $pdf->getTemplateSize($templateId);
                    $viewport = 'P';
                    if(isset($rotates[$page]) && $rotates[$page] > 0) {
                        if($rotates[$page] != 180) {
                            $viewport = 'L';
                            swap($size['width'], $size['height']);
                        }
                        $size['Rotate'] = $rotates[$page];
                    }
                    $pdf->AddPage($viewport, $size);
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

                $file_size = File::size($filepath)  / 1048576;
                error_log('Filesize: ' . number_format($file_size, 2) . 'MB');

                $pdf_count = ceil($file_size / 25);
                $processed_pages = 0;

                for($i = 1; $i <= $pdf_count; $i ++) {
                    $pdf = new Fpdi();
                    $page_count = $pdf->setSourceFile($filepath);

                    $pages_per_pdf = ceil($page_count / $pdf_count);
                    $last_page = min($pages_per_pdf * $i, $page_count);

                    $email = 'tyler@southrivermtg.com'; // Retrieve from User DB by officer name
                    $signHereTabs = [];
                    $dateTabs = [];

                    for($j = $processed_pages + 1; $j <= $last_page; $j ++) {
                        $templateId = $pdf->importPage($j);
                        $size = $pdf->getTemplateSize($templateId);
                        $viewport = 'P';
                        if(isset($rotates[$j]) && $rotates[$j] > 0) {
                            if($rotates[$j] != 180) {
                                $viewport = 'L';
                                swap($size['width'], $size['height']);
                            }
                            $size['Rotate'] = $rotates[$j];
                        }
                        $pdf->AddPage($viewport, $size);
                        $pdf->useTemplate($templateId);

                        $signCandidates = array_filter($forms, function($rect) use($j) {
                          return isset($rect['Page']) && $rect['Page'] === $j;
                        });

                        foreach($signCandidates as $formkey => $rect) {
                            if((strpos($formkey, 'signature') !== false && (strpos($formkey, 'loan') !== false || strpos($formkey, 'officer') !== false || strpos($formkey, 'lender') !== false))
                                || (strpos($formkey, $short_officer) !== false)) {

                                $width = isset($size['width']) ? $size['width'] : (isset($size['w']) ? $size['w'] : (isset($size['0']) ? $size['0'] : 0));
                                $height = isset($size['height']) ? $size['height'] : (isset($size['h']) ? $size['h'] : (isset($size['1']) ? $size['1'] : 0));

                                $width = mmToPt($width);
                                $height = mmToPt($height);

                                $x_position = round($width * $rect['Rect']['Left']);
                                $y_position = round($height * $rect['Rect']['Top'] - 20);
                                $y_position = $y_position < 0 ? 0 : $y_position;

                                if($width > $height) {
                                    swap($x_position, $y_position);
                                }

                                array_push($signHereTabs, $docusign->signHere([
                                    'document_id' => '1',
                                    'page_number' => $rect['Page'] - $processed_pages,
                                    'x_position'  => $x_position,
                                    'y_position'  => $y_position
                                ]));
                                array_push($dateTabs, $docusign->date([
                                    'document_id' => '1',
                                    'page_number' => $rect['Page'] - $processed_pages,
                                    'x_position'  => round($width * 0.75),
                                    'y_position'  => $y_position + 20
                                ]));
                            }
                        }
                    }

                    $temp_pdf = time() . random_string() . '.pdf';
                    $temp_pdf = storage_path('app/' . $temp_pdf);
                    $pdf->Output($temp_pdf, 'F');

                    $processed_pages += $j - 1;

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
                                        'sign_here_tabs' => $signHereTabs,
                                        'date_signed_tabs' => $dateTabs,
                                    ])
                                ])
                            ]
                        ]),
                        'documents'     => [
                            $docusign->document([
                                'document_base64' => base64_encode(file_get_contents($temp_pdf)),
                                'name'            => 'PDF for ' . $officer . ($pdf_count > 1 ? ' (' . $i . ')' : ''),
                                'document_id'     => '1'
                            ])
                        ]
                    ]);

                    if(!empty($signHereTabs)) {
                        $envelopeSummary = $docusign->envelopes->createEnvelope($envelopeDefinition);
                        error_log('Envelope ' . $envelopeSummary->getEnvelopeId() . ' with pdf for sign ' . $envelopeSummary->getStatus());
                    }

                    unlink($temp_pdf);
                }
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
            if(isset($temp_pdf))
                unlink($temp_pdf);
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

    public function borrowerScan(Request $request)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $file = $request->file('leads');
        $key = time() . random_string();
        $filepath = $file->storeAs('', $key . '.' . $file->getClientOriginalExtension());
        $filepath = storage_path('app/' . $filepath);
        $json_path = storage_path('app/' . $key . '.json');

        $borrower = $request->get('borrower');
        $borrower_email = $request->get('borrower_email');
        $coborrower = $request->get('coborrower');
        $coborrower_email = $request->get('coborrower_email');
        if(empty($coborrower) || empty($coborrower_email))
            $onlyborrower = true;
        else
            $onlyborrower = false;

        try {
            $time_start = microtime(true);

            shell_exec(env('PDF2JSON_PATH') . ' -i ' . $filepath . ' ' . $json_path);
            $pdf_parse = json_decode(utf8_encode(file_get_contents($json_path)), true);

            $candidates = [];
            $needsOCR = [];
            $page_type = 0;
            $page_except = 0;
            foreach($pdf_parse as $page) {
                if(isset($page['width']) && isset($page['height']) && isset($page['number'])) {
                    if(!isset($page['text']) || empty($page['text'])) {
                        if($page_type == 0)
                            array_push($needsOCR, $page['number']);
                        else
                            continue;
                    } else {
                        foreach($page['text'] as $block) {
                            if(isset($block['width']) && isset($block['height']) && isset($block['data'])) {
                                $text = trim($block['data']);
                                if(strpos($text, 'SeparatorSignedByBorrower') !== false) {
                                    $page_type = 1;
                                    continue;
                                }
                                if(strpos($text, 'SeparatorBorrowerCopy') !== false) {
                                    $page_type = 2;
                                    break;
                                }

                                if(strpos($text, '&amp; Date:') !== false) {
                                    $type = 'BORROWER_';
                                    $left = ($block['left'] - 130) / $page['width'];
                                    if($left > 0.4) {
                                        $type = 'CO' . $type;
                                    }
                                    array_push($candidates, array(
                                        'left' => $left,
                                        'top' => $block['top'] / $page['height'],
                                        'type' => $type . 'SGF',
                                        'page' => $page['number'],
                                    ));
                                    array_push($candidates, array(
                                        'left' => $left + 0.25,
                                        'top' => $block['top'] / $page['height'],
                                        'type' => $type . 'DAT',
                                        'page' => $page['number'],
                                    ));
                                }

                                if($page_type == 0) {
                                    if($text === 'This!')
                                        $page_except = $page['number'];
                                    if($text === 'Borrower' && $page_except !== $page['number'])
                                        $type = 'BORROWER';
                                    else if(!$onlyborrower && $text === 'Co-Borrower' && $page_except !== $page['number'])
                                        $type = 'COBORROWER';
                                    else
                                        continue;
                                }
                                if($page_type == 1) {
                                    if(strpos($text, 'BOR_1_SGF') !== false)
                                        $type = 'BOR_1_SGF';
                                    else if(!$onlyborrower && strpos($text, 'BOR_2_SGF') !== false)
                                        $type = 'BOR_2_SGF';
                                    else if(strpos($text, 'BOR_1_DAT') !== false)
                                        $type = 'BOR_1_DAT';
                                    else if(!$onlyborrower && strpos($text, 'BOR_2_DAT') !== false)
                                        $type = 'BOR_2_DAT';
                                    else
                                        continue;
                                }

                                array_push($candidates, array(
                                    'left' => $block['left'] / $page['width'],
                                    'top' => $block['top'] / $page['height'],
                                    'type' => $type,
                                    'page' => $page['number'],
                                ));
                            }
                        }
                        if($page_type == 2)
                            break;
                    }
                }
            }

            // OCR image pages
            if(!empty($needsOCR)) {
                error_log(json_encode($needsOCR));
                $pdf = new Fpdi();
                $pdf->setSourceFile($filepath);
                foreach($needsOCR as $ocrpage) {
                    $templateId = $pdf->importPage($ocrpage);
                    $size = $pdf->getTemplateSize($templateId);
                    $pdf->AddPage('P', $size);
                    $pdf->useTemplate($templateId);
                }
                $temp_pdf = time() . random_string() . '.pdf';
                $temp_pdf = storage_path('app/' . $temp_pdf);
                $pdf->Output($temp_pdf, 'F');

                $provider = new Credentials(Config::get('aws.credentials.key'), Config::get('aws.credentials.secret'));
                $s3 = new S3Client([
                    'version'     => 'latest',
                    'region'      => Config::get('aws.region'),
                    'credentials' => $provider
                ]);

                $result = $s3->putObject(array(
                    'Bucket'     => Config::get('aws.bucket'),
                    'Key'        => $key,
                    'SourceFile' => $temp_pdf,
                ));

                unlink($temp_pdf);

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

                $words = [];
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
                            parseForm($result['Blocks'], $words, $forms);

                            $token = $result['NextToken'];
                            while ($token != null)
                            {
                                $nextResult = $textract->getDocumentAnalysis(array(
                                    'JobId' => $jobId,
                                    'NextToken' => $token
                                ));

                                parseForm($nextResult['Blocks'], $words, $forms);
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
                            'message' => 'Scan ' . $jobStatus . ' on images'
                        )
                    );
                }

                error_log(json_encode($forms));

                foreach($forms as $formkey => $rect) {
                    if((strpos($formkey,  'homeownersignature&date') !== false) ||
                       (strpos($formkey,  'homeowner(borrowersignature&date') !== false) ||
                       (strpos($formkey,  'homeownerborrower)signature&date') !== false) ||
                       (strpos($formkey,  'homeowner(borrower)signature&date') !== false)) {

                        $type = 1;
                        if($rect['Rect']['Left'] > 0.4) {
                            $type = 2;
                        }

                        array_push($candidates, array(
                            'left' => $rect['Rect']['Left'],
                            'top' => $rect['Rect']['Top'],
                            'type' => 'OCR_' . $type . '_SGF',
                            'page' => $rect['Page'],
                        ));

                        array_push($candidates, array(
                            'left' => $rect['Rect']['Left'] + 0.25,
                            'top' => $rect['Rect']['Top'],
                            'type' => 'OCR_' . $type . '_DAT',
                            'page' => $rect['Page'],
                        ));
                    }
                }
            }

            error_log(json_encode($candidates));

            // For DocuSign
            $docusign = DocuSign::create();

            $file_size = File::size($filepath)  / 1048576;
            error_log('Filesize: ' . number_format($file_size, 2) . 'MB');

            $pdf_count = ceil($file_size / 25);
            $processed_pages = 0;

            for($i = 1; $i <= $pdf_count; $i ++) {
                $pdf = new Fpdi();
                $page_count = $pdf->setSourceFile($filepath);

                $pages_per_pdf = ceil($page_count / $pdf_count);
                $last_page = min($pages_per_pdf * $i, $page_count);

                $borrowerSigns = []; $borrowerDates = [];
                $coborrowerSigns = []; $coborrowerDates = [];

                for($j = $processed_pages + 1; $j <= $last_page; $j ++) {
                    $templateId = $pdf->importPage($j);
                    $size = $pdf->getTemplateSize($templateId);
                    $pdf->AddPage('P', $size);
                    $pdf->useTemplate($templateId);

                    $signCandidates = array_filter($candidates, function($sign) use($j) {
                      return $sign['page'] === $j;
                    });

                    foreach($signCandidates as $sign) {
                        $width = isset($size['width']) ? $size['width'] : (isset($size['w']) ? $size['w'] : (isset($size['0']) ? $size['0'] : 0));
                        $height = isset($size['height']) ? $size['height'] : (isset($size['h']) ? $size['h'] : (isset($size['1']) ? $size['1'] : 0));

                        $width = mmToPt($width);
                        $height = mmToPt($height);

                        $x_position = round($width * $sign['left']);
                        $y_position = round($height * $sign['top']);
                        if($sign['type'] == 'BOR_1_SGF' || $sign['type'] == 'BOR_2_SGF' || $sign['type'] == 'OCR_1_SGF' || $sign['type'] == 'OCR_2_SGF') {
                            $y_position = $y_position - 20;
                        }
                        if($sign['type'] == 'BORROWER' || $sign['type'] == 'COBORROWER') {
                            $y_position = $y_position - 35;
                        }
                        if($sign['type'] == 'BORROWER_SGF' || $sign['type'] == 'COBORROWER_SGF') {
                            $y_position = $y_position - 10;
                        }
                        if($sign['type'] == 'BORROWER_DAT' || $sign['type'] == 'COBORROWER_DAT') {
                            $y_position = $y_position + 10;
                        }
                        $y_position = $y_position < 0 ? 0 : $y_position;

                        if($width > $height) {
                            swap($x_position, $y_position);
                        }

                        if($sign['type'] == 'BOR_1_SGF' || $sign['type'] == 'BORROWER' || $sign['type'] == 'BORROWER_SGF' || $sign['type'] == 'OCR_1_SGF') {
                            array_push($borrowerSigns, $docusign->signHere([
                                'document_id' => '1',
                                'page_number' => $sign['page'] - $processed_pages,
                                'x_position'  => $x_position,
                                'y_position'  => $y_position
                            ]));
                        } else if($sign['type'] == 'BOR_1_DAT' || $sign['type'] == 'BORROWER_DAT' || $sign['type'] == 'OCR_1_DAT') {
                            array_push($borrowerDates, $docusign->date([
                                'document_id' => '1',
                                'page_number' => $sign['page'] - $processed_pages,
                                'x_position'  => $x_position,
                                'y_position'  => $y_position
                            ]));
                        } else if($sign['type'] == 'BOR_2_SGF' || $sign['type'] == 'COBORROWER' || $sign['type'] == 'COBORROWER_SGF' || $sign['type'] == 'OCR_2_SGF') {
                            array_push($coborrowerSigns, $docusign->signHere([
                                'document_id' => '1',
                                'page_number' => $sign['page'] - $processed_pages,
                                'x_position'  => $x_position,
                                'y_position'  => $y_position
                            ]));
                        } else if($sign['type'] == 'BOR_2_DAT' || $sign['type'] == 'COBORROWER_DAT' || $sign['type'] == 'OCR_2_DAT') {
                            array_push($coborrowerDates, $docusign->date([
                                'document_id' => '1',
                                'page_number' => $sign['page'] - $processed_pages,
                                'x_position'  => $x_position,
                                'y_position'  => $y_position
                            ]));
                        }
                    }
                }

                $temp_pdf = time() . random_string() . '.pdf';
                $temp_pdf = storage_path('app/' . $temp_pdf);
                $pdf->Output($temp_pdf, 'F');

                $processed_pages += $j - 1;

                $signers = [
                    $docusign->signer([
                        'email' 	    => $borrower_email,
                        'name'  	    => $borrower,
                        'recipient_id'  => '1',
                        'routing_order' => '1',
                        'tabs'          => $docusign->tabs([
                            'sign_here_tabs' => $borrowerSigns,
                            'date_signed_tabs' => $borrowerDates,
                        ])
                    ])
                ];
                if(!$onlyborrower) {
                    array_push($signers, $docusign->signer([
                        'email' 	    => $coborrower_email,
                        'name'  	    => $coborrower,
                        'recipient_id'  => '2',
                        'routing_order' => '1',
                        'tabs'          => $docusign->tabs([
                            'sign_here_tabs' => $coborrowerSigns,
                            'date_signed_tabs' => $coborrowerDates,
                        ])
                    ]));
                }
                $envelope = $docusign->envelopeDefinition([
                    'status'        => 'sent',
                    'email_subject' => 'Please sign this document',
                    'email_blurb'   => 'Hi ' . $borrower . ' and ' . $coborrower . '<br>Please sign the above document.<br>Thank You, Tyler Plack',
                    'recipients'    => $docusign->recipients([
                        'signers' => $signers
                    ]),
                    'documents'     => [
                        $docusign->document([
                            'document_base64' => base64_encode(file_get_contents($temp_pdf)),
                            'name'            => 'PDF for sign' . ($pdf_count > 1 ? ' (' . $i . ')' : ''),
                            'document_id'     => '1'
                        ])
                    ]
                ]);

                if(!empty($borrowerSigns) || !empty($borrowerDates) || !empty($coborrowerSigns) || !empty($coborrowerDates)) {
                    $envelopeSummary = $docusign->envelopes->createEnvelope($envelope);
                    error_log('Envelope ' . $envelopeSummary->getEnvelopeId() . ' with pdf for sign ' . $envelopeSummary->getStatus());
                }

                unlink($temp_pdf);
            }

            unlink($json_path);
            unlink($filepath);

            $elapsed = microtime(true) - $time_start;
            error_log('Success Finish : ' . $elapsed . 'ms');

            return Response::json(array (
                    'result' => 'success',
                    'message' => 'Scan Success',
                    'time' => $elapsed
                )
            );
        } catch (Throwable $e) {
            if(isset($temp_pdf))
                unlink($temp_pdf);
            unlink($json_path);
            unlink($filepath);

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
