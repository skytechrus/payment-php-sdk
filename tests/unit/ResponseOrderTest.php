<?php


use Skytech\Response\Order;

class ResponseOrderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var Order
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
     * @param $status
     */
    public function testStatusFeature($fileName, $status)
    {
        $response = $this->loadFileData($fileName);
        $this->response =  new Skytech\Response\XML\Response($response);
        $this->assertEquals($status, $this->response->get('Status'));
    }

    /**
     * @dataProvider provideDataOrderId
     * @param $fileName
     * @param $orderId
     */
    public function testOrderId($fileName, $orderId)
    {
        $response = $this->loadFileData($fileName);
        $this->response =  new Skytech\Response\XML\Response($response);
        $this->assertEquals($orderId, $this->response->get('OrderID'));
    }

    /**
     * @dataProvider provideDataURL
     * @param $fileName
     * @param $url
     */
    public function testURL($fileName, $url)
    {
        $response = $this->loadFileData($fileName);
        $this->response =  new Skytech\Response\XML\Response($response);
        $this->assertEquals($url, $this->response->get('URL'));
    }

    public function provideData()
    {
        return [
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response1.xml',   '00'],
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response2.xml',   '30']
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
            ['C:\work\Project_php\bitrix\payment-php-sdk\tests\_support\xml\Response1.xml',
                'ECDE79578768ECFBF2897A0F44CC0CEF']
        ];
    }
}
