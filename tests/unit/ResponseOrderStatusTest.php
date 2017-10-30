<?php


use Skytech\Response\OrderStatus;

class ResponseOrderStatusTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var OrderStatus
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
        $this->response =  new Skytech\Response\XML\Response($response);
    }

    protected function _after()
    {
    }

    // tests
    public function testOperation()
    {
        $this->assertEquals('GetOrderStatus', $this->response->get('Operation'));
    }

    public function testStatus()
    {
        $this->assertEquals('30', $this->response->get('Status'));
    }

    public function testOrderId()
    {
        $this->assertEquals('14', $this->response->get('OrderId'));
    }

    public function testReceipt()
    {
        $this->assertEquals('BASE64-encode-info', $this->response->getReceipt());
    }
}