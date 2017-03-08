<?php

namespace Emartech\Response;

use Symfony\Component\HttpFoundation\JsonResponse;


class ApiJson
{
    public static function success(array $data = [])
    {
        return self::getResponse($data);
    }

    public static function error(string $errorMessage = '', int $responseCode = 200)
    {
        return self::getResponse([], false, $errorMessage, $responseCode);
    }

    private static function getResponse(array $data = [], bool $success = true, string $errorMessage = '', int $statusCode = 200): JsonResponse
    {
        $ret = [
            'success' => $success,
        ];
        if ($success) {
            $ret['data'] = $data;
        } else {
            $ret['errorMessage'] = $errorMessage;
        }

        return new JsonResponse($ret, $statusCode);
    }
}
