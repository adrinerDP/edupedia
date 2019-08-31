<?php
namespace App\Services;

class APIWrapper {
    private $returnCode = 200;
    private $statusMessage = 'Successful';

    public function code($code)
    {
        $this->returnCode = $code;

        return $this;
    }

    public function message($message)
    {
        $this->statusMessage = $message;

        return $this;
    }

    public function return($body=[])
    {
        $returnData = [
            'status' => [
                'code' => $this->returnCode,
                'message' => $this->statusMessage,
                'size' => count($body)
            ],
            'body' => $body
        ];

        return response()->json($returnData);
    }
}
