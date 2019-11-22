<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Manifest;
use App\ApiUser;
use App\Services\Api\ApiResponse;
use App\Services\Csv\Csv;
use Illuminate\Support\Facades\Mail;
use App\Mail\ManifestUploaded;


class ManifestController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Is the request valid json?
        if (!$request->json()->all()) {
            $response = new ApiResponse;
            return $response->sendError(ApiResponse::HTTP_BAD_REQUEST, 'Bad request', $message = 'Check your JSON ;)');
        }


        // ManifestUpload 
        $rules = [
            'ManifestUpload' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = new ApiResponse;
            return $response->sendError(ApiResponse::HTTP_BAD_REQUEST, 'Bad request', $message = $errors->all());
        }

        // CustomerDetails
        $rules = [
            'ManifestUpload.CustomerDetails' => 'required',
            'ManifestUpload.CustomerDetails.CustomerName' => 'required',
            'ManifestUpload.CustomerDetails.AccountNumber' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            
            $response = new ApiResponse;
            return $response->sendError(ApiResponse::HTTP_BAD_REQUEST, 'Bad request', $message = $errors->all());
        }


        // Further customer authentication
        $customerName = $request['ManifestUpload']['CustomerDetails']['CustomerName'];
        $accountNumber = $request['ManifestUpload']['CustomerDetails']['AccountNumber'];
        $apiToken = str_replace('Bearer ', '', $request->header('Authorization'));

        if (!ApiUser::where(['account_number' => $accountNumber, 'api_name' => $customerName, 'api_token' => $apiToken])->exists()) {
            $response = new ApiResponse;
            return $response->sendError(ApiResponse::UNAUTHORIZED, 'Unauthorized', $message = 'Check Customer Details');
        }
        $apiUser = ApiUser::where(['account_number' => $accountNumber, 'api_name' => $customerName, 'api_token' => $apiToken])->first();


        // ManifestRecords and Unique reference
        $rules = [
            'ManifestUpload.ManifestRecords' => 'required',
            'ManifestUpload.Reference' => 'required|between:20,100|string|unique:manifests,ref'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $response = new ApiResponse;
            return $response->sendError(ApiResponse::HTTP_BAD_REQUEST, 'Bad request', $message = $errors->all());
        }

        $rules = [
            'AgentTrackingNumber' => 'required|string',
            'MAWB' => 'string',
            'MasterDate' => 'date_format:Y-m-d',
            'Flight' => 'string',
            'HAWB' => 'string',
            'Client' => 'required|string',
            'Shipper' => 'required|string',
            'OriginCountry' => 'required|string',
            'ShipperAddress' => 'required|string',
            'ShipperCity' => 'required|string',
            'ShipperZip' => 'required|string',
            'Consignee' => 'required|string',
            'ConsigneeTel' => 'string',
            'ConsigneeAddress1' => 'required|string',
            'ConsigneeAddress2' => 'string',
            'ConsigneeAddress3' => 'string',
            'Contact' => 'required|string',
            'ConsigneeCity' => 'required|string',
            'ConsigneeZip' => 'required|string',
            'Pieces' => 'required|string',
            'Contents' => 'required|string',
            'Value' => 'required|string',
            'DeadWeight' => 'required|string',
            'VolWeight' => 'required|string',
            'Notes' => 'string',
            'CountryCode' => 'required|string',
            'JobId' => 'string',
            'DestinationCountryName' => 'required|string',
            'ServiceCode' => 'required|string',
            'Bag' => 'string'
        ];
        $manifestRecords = $request['ManifestUpload']['ManifestRecords'];
        foreach ($manifestRecords as $record) {
            $validator = Validator::make($record, $rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $response = new ApiResponse;
                return $response->sendError(ApiResponse::HTTP_BAD_REQUEST, 'Bad request', $message = $errors->all());
            }
        }

        $ref = $request['ManifestUpload']['Reference'];

        $manifest = Manifest::createWithLines($apiUser->id, $ref, $manifestRecords);
        if ($manifest['status'] == 'failure') {
            dd($manifest);
            $response = new ApiResponse;
            return $response->sendError(ApiResponse::HTTP_BAD_REQUEST, 'Bad request', $message = $errors->all());
        }

        // Send the notification email to office
        Mail::to('office@impactexpress.co.uk')->send(new ManifestUploaded($apiUser->name, $manifest));

        $response = new ApiResponse;
        return $response->sendSuccess('OK', $message = 'OK - Everything went well');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Manifest $manifest) {
        return view('manifest.show');
    }

    public function download(Manifest $manifest) {

        $header = [
            'AGENT TRACKING NUMBER',
            'MAWB',
            'MASTER DATE',
            'FLIGHT',
            'HAWB',
            'CLIENT',
            'ORIGIN COUNTRY',
            'SHIPPER ADDRESS',
            'SHIPPER CITY',
            'SHIPPER ZIP',
            'CONSIGNEE',
            'CNEE TEL',
            'CNEE ADDRESS',
            'CNEE ADDRESS 2',
            'CNEE ADDRESS 3',
            'CONTACT',
            'CNEE CITY',
            'CNEE ZIP',
            'PIECES',
            'CONTENTS',
            'VALUE',
            'DEAD WEIGHT',
            'VOL WEIGHT',
            'NOTES',
            'COUNTRY CODE',
            'JOB ID',
            'DEST COUNTRY NAME',
            'SERVICE CODE',
            'BAG'
        ];

        $csv = new Csv();
        $csv->setHeader($header);
        $records = [];
        foreach ($manifest->lines->toArray() as $line) {
            unset($line['id']);
            unset($line['manifest_id']);
            unset($line['created_at']);
            unset($line['updated_at']);
            $records[] = array_values($line);
        }

        $csv->setRecords($records);

        $name = $manifest->created_at.' '.$manifest->apiUser->api_name.'.csv';

        $outputFile = fopen($name, 'w');
        fwrite($outputFile,$csv->getContent());
        fclose($outputFile);

        return response()->download($name)->deleteFileAfterSend();
    }
}
