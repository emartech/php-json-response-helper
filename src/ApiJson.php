<?php

namespace Emartech\Response;

use Symfony\Component\HttpFoundation\JsonResponse;


class ApiJson
{
    private $success = true;
    private $errorMessage = '';
    private $statusCode = 200;
    private $data = [];


    public function __construct(array $data = [])
    {
        $this->setData($data);
    }

    public function setData(array $data)
    {
        $this->success = true;
        $this->data = $data;
    }

    public function setErrorMessage(string $errorMessage)
    {
        $this->success = false;
        $this->data = [];
        $this->errorMessage = $errorMessage;
    }

    public function getResponse(): JsonResponse
    {
        $ret = [
            'success' => $this->success,
        ];
        if ($this->success) {
            $ret['data'] = $this->data;
        } else {
            $ret['errorMessage'] = $this->errorMessage;
        }

        return new JsonResponse($ret, $this->statusCode);
    }

    public function setResponseCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }
}
