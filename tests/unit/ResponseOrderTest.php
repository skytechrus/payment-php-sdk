<?php


use Skytech\Response\ResponseOrder;

class ResponseOrderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var ResponseOrder
     */
    protected $response;

    protected function _before()
    {

    }

    protected function _after()
    {
    }

    public function loadFileData($fileName)
    {
        $xml = simplexml_load_file($fileName);
        return $xml->asXML();
    }

    /**
     * @dataProvider provideData
     * @param $fileName
     * @param $operationName
     * @param $status
     */
    public function testOperationFeature($fileName, $operationName, $status)
    {
        $response = $this->loadFileData($fileName);
        $this->response = new ResponseOrder($response);
        $this->assertEquals($operationName, $this->response->getOperation());
    }

    /**
     * @dataProvider provideData
     * @param $fileName
     * @param $operationName
     * @param $status
     */
    public function testStatusFeature($fileName, $operationName, $status)
    {
        $response = $this->loadFileData($fileName);
        $this->response = new ResponseOrder($response);
        $this->assertEquals($status, $this->response->getStatus());
    }

    /**
     * @dataProvider provideDataOrderId
     * @param $fileName
     * @param $orderId
     */
    public function testOrderId($fileName, $orderId)
    {
        $response = $this->loadFileData($fileName);
        $this->response = new ResponseOrder($response);
        $this->assertEquals($orderId, $this->response->getOrderId());
    }

    /**
     * @dataProvider provideDataURL
     * @param $fileName
     * @param $url
     */
    public function testURL($fileName, $url)
    {
        $response = $this->loadFileData($fileName);
        $this->response = new ResponseOrder($response);
        $this->assertEquals($url, $this->response->getURL());
    }

    /**
     * @dataProvider provideDataSessionId
     * @param $fileName
     * @param $sessionId
     */
    public function testSessionId($fileName, $sessionId)
    {
        $response = $this->loadFileData($fileName);
        $this->response = new ResponseOrder($response);
        $this->assertEquals($sessionId, $this->response->getSessionID());
    }

    public function provideData()
    {
        return [
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response1.xml', 'CreateOrder', '00'],
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response2.xml', 'CreateOrder', '30']
        ];
    }

    public function provideDataOrderId()
    {
        return [
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response1.xml', '828'],
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response3.xml', '999']
        ];
    }

    public function provideDataURL()
    {
        return [
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response1.xml', 'PayGateURL'],
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response3.xml', 'PayGateURL2']
        ];
    }

    public function provideDataSessionId()
    {
        return [
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response1.xml', 'ECDE79578768ECFBF2897A0F44CC0CEF']
        ];
    }
}