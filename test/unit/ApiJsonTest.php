<?php

use Emartech\Response\ApiJson;
use Emartech\TestHelper\BaseTestCase;

class ApiJsonTest extends BaseTestCase
{
    /**
     * @test
     */
    public function getResponse_EmptyData_InProperFormat()
    {
        $response = new ApiJson();
        $this->assertJsonStringEqualsJsonString('{"success": true, "data": []}', $response->getResponse()->getContent());
    }

    /**
     * @test
     */
    public function setData_DataSet_SuccessTrue()
    {
        $response = new ApiJson();
        $response->setData(['test' => 'bmw']);
        $this->assertJsonStringEqualsJsonString('{"success": true, "data": {"test": "bmw"}}', $response->getResponse()->getContent());
    }

    /**
     * @test
     */
    public function setErrorMessage_MessageSet_SuccessFalseAndNoData()
    {
        $response = new ApiJson();
        $response->setErrorMessage('error message');
        $this->assertJsonStringEqualsJsonString('{"success": false, "errorMessage": "error message"}', $response->getResponse()->getContent());
    }

    /**
     * @test
     */
    public function setResponseCode_DefaultValueUsed_ReturnsStatus200()
    {
        $response = new ApiJson();
        $this->assertEquals(200, $response->getResponse()->getStatusCode());
    }

    /**
     * @test
     */
    public function setResponseCode_SetToInternalServerError_ReturnsStatus500()
    {
        $response = new ApiJson();
        $response->setResponseCode(500);
        $this->assertEquals(500, $response->getResponse()->getStatusCode());
    }
}
