<?php

namespace App\Services\Api;

class ApiResponse {

    const HTTP_OK                       = 200; // OK - Everything went well
    const HTTP_CREATED                  = 201; // CREATED - Everything went well
    const HTTP_ACCEPTED                 = 202; // ACCEPTED - Everything went well
    const HTTP_BAD_REQUEST              = 400; // Bad Request - Server does not understand what we mean
    const UNAUTHORIZED                  = 401; // Unauthorized - Someone has tampered with the data
    const HTTP_METHOD_NOT_ALLOWED       = 405; // Method Not Allowed - Trying a get on a post method
    const HTTP_NOT_FOUND                = 404; // NOT FOUND - The request methods do not exist
    const SERVICE_UNAVAILABLE           = 503; // SERVICE UNAVAILABLE - Error internal


    const RESPONSE_API_KEY_NOT_FOUND = 'Parameter APIKey not found';
    const RESPONSE_INVALID_JSON = 'Invalid Message JSON';
    const RESPONSE_INVALID_ID = 'Parameter id not found';

    public $success         = false;
    public $response        = [];
    public $status_code     = 404;
    public $error           = [];
    public $message          = "";
    public $headers          = "";


    public function init($success, $status_code, $response = null, $message = "", $headers = null)
    {
        if (empty($response) || is_null($response) ) {
            $response = [];
        }

        if (!is_array($response)) {
            $response = [$response];
        }

        if ($message == "" && isset($response[0])) {
            $message = $response[0];
        }

        $this->success = $success;
        $this->response = $response;
        $this->status_code = $status_code;
        $this->message = $message;
        $this->headers = $headers;
        return $this;
    }

    public function sendSuccess($response, $message = "", $headers = null)
    {
        $this->init(true,
            self::HTTP_OK,
            $response,
            $message,
            $headers
        );

        return $this->output();
    }

    public function sendError($code, $errors = null, $message = "", $headers = null)
    {
        $this->init(false,
            $code,
            $errors,
            $message,
            $headers
        );

        return $this->output();
    }

    public function output()
    {
        return response()->json(
            $this->toArray(),
            $this->status_code
        );
    }

    public function toArray()
    {
        return [
            'success'     => $this->success,
            'status_code' => $this->status_code,
            'message'     => $this->message,
            // 'response'    => $this->response,
            // 'headers' => $this->headers,
        ];
    }
}
