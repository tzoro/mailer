<?php

namespace Api\Http;

trait JsonResponseTrait
{
    public function json($data, int $statusCode = 200): bool
    {
        http_response_code($statusCode);
        header('Content-Type: application/json;charset=utf-8');
        $body = json_encode($data);
        if (json_last_error() === JSON_ERROR_NONE) {
            echo $body;
            return true;
        }

        return false;
    }
}
