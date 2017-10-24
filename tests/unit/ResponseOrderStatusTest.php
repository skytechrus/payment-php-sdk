<?php


use Skytech\Response\ResponseOrderStatus;

class ResponseOrderStatusTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var ResponseOrderStatus
     */
    protected $response;

    public function loadFileData($fileName)
    {
        $xml = simplexml_load_file($fileName);
        return $xml->asXML();
    }

    protected function _before()
    {
        $response = $this->loadFileData('C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\OrderStatus.xml');
        $this->response = new ResponseOrderStatus($response);
    }

    protected function _after()
    {
    }

    // tests
    public function testOperation()
    {
        $this->assertEquals('GetOrderStatus', $this->response->getOperation());
    }

    public function testStatus()
    {
        $this->assertEquals('30', $this->response->getStatus());
    }

    public function testOrderId()
    {
        $this->assertEquals('14', $this->response->getOrderId());
    }

    public function testReceipt()
    {
        $this->assertEquals('BASE64-encode-info', $this->response->getReceipt());
    }
}