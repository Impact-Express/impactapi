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
            'ShipmentReference' => 'string',
            'ShipperVATEORI' => 'string',
            'Shipper' => 'required|string',
            'ShipperAddress1' => 'required|string',
            'ShipperAddress2' => 'string',
            'ShipperAddress3' => 'string',
            'ShipperCity' => 'required|string',
            'ShipperZip' => 'string',
            'ShipperCountryISOCode' => 'required|string',
            'TrueShipperContactName' => 'required|string',
            'TrueShipperContactTel' => 'string',
            'Consignee' => 'required|string',
            'ConsigneeAddress1' => 'required|string',
            'ConsigneeAddress2' => 'string',
            'ConsigneeAddress3' => 'string',
            'ConsigneeCity' => 'required|string',
            'ConsigneeZip' => 'string',
            'ConsigneeCountryISOCode' => 'required|string',
            'ConsigneeContactName' => 'string',
            'ConsigneeContactTel' => 'string',
            'Contents' => 'required|string',
            'Value' => 'required|string',
            'Pieces' => 'required|string',
            'DeadWeight' => 'required|string',
            'VolWeight' => 'string',
            'ServiceCode' => 'required|string|in:EXP,ECO,exp,eco',
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
        Mail::to(config('api.email.to'))->send(new ManifestUploaded($apiUser->name, $manifest));

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
            'SHIPPER VAT EORI',
            'SHIPMENT REFERENCE',
            'SHIPPER',
            'SHIPPER ADDRESS 1',
            'SHIPPER ADDRESS 2',
            'SHIPPER ADDRESS 3',
            'SHIPPER CITY',
            'SHIPPER ZIP',
            'SHIPPER COUNTRY ISO CODE',
            'TRUE SHIPPER CONTACT NAME',
            'TRUE SHIPPER CONTACT TEL',
            'CONSIGNEE',
            'CONSIGNEE ADDRESS 1',
            'CONSIGNEE ADDRESS 2',
            'CONSIGNEE ADDRESS 3',
            'CONSIGNEE CITY',
            'CONSIGNEE ZIP',
            'CONSIGNEE COUNTRY ISO CODE',
            'CONSIGNEE CONTACT NAME',
            'CONSIGNEE CONTACT TEL',
            'CONTENTS',
            'VALUE',
            'PIECES',
            'DEAD WEIGHT',
            'VOL WEIGHT',
            'SERVICE CODE'
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
