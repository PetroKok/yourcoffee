<?php
namespace App\Traits;

trait ResponseTrait
{
    public function customResponse(array $data, $status, $message = "")
    {
        return [
            "message" => $message,
            "status" => $status,
            "result" => $data
        ];
    }
}
