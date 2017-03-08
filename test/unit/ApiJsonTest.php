<?php

use Emartech\Response\ApiJson;
use Emartech\TestHelper\BaseTestCase;

class ApiJsonTest extends BaseTestCase
{
    /**
     * @test
     */
    public function getResponse_EmptyData_SuccessTrueDataIsEmpty()
    {
        $this->assertJsonStringEqualsJsonString('{"success": true, "data": []}', ApiJson::success()->getContent());
    }

    /**
     * @test
     */
    public function success_DataGiven_SuccessTrueDataSet()
    {
        $response = ApiJson::success(['test' => 'bmw']);
        $this->assertJsonStringEqualsJsonString('{"success": true, "data": {"test": "bmw"}}', $response->getContent());
    }

    /**
     * @test
     */
    public function success_EmptyData_ReturnsStatus200()
    {
        $response = ApiJson::success();
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function error_MessageSet_SuccessFalseAndNoDataAndMessage()
    {
        $response = ApiJson::error('error message');
        $this->assertJsonStringEqualsJsonString('{"success": false, "errorMessage": "error message"}', $response->getContent());
    }

    /**
     * @test
     */
    public function error_CodeSetToInternalServerError_ReturnsStatus500()
    {
        $response = ApiJson::error('', 500);
        $this->assertEquals(500, $response->getStatusCode());
    }
}
