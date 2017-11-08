<?php


class ResponseOrderStatusTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var Skytech\Response\XML\Provider
     */
    protected $response;

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
        $this->assertEquals('14', $this->response->get('OrderID'));
    }

    // tests

    public function testReceipt()
    {
        $this->assertEquals('BASE64-encode-info', $this->response->get('Receipt'));
    }

    protected function _before()
    {
        $fileName = 'C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\OrderStatus.xml';
        $response = $this->loadFileData($fileName);
        $this->response = new Skytech\Response\XML\Provider($response);
    }

    public function loadFileData($fileName)
    {
        $xml = simplexml_load_file($fileName);
        return $xml->asXML();
    }

    protected function _after()
    {
    }
}
