<?php


class XMLOrderGetResponseTest extends \Codeception\Test\Unit
{
    use Skytech\XMLOrderGetResponse;

    protected $tester;
    protected $operation;

    protected function _before()
    {
        $order = new Skytech\Order();
        $this->operation = new Skytech\Operation($order);
// $this->operation->order->getSessionid()
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider providerResponse
     * @param $fileName
     * @param $operationname
     */

    public function testOperation($fileName,$operationname)
    {
        $xml = new DomDocument() ; // simplexml_load_file('c:\tmp\xml\Response2.xml');
        $xml->load($fileName);
        $xmlResponce= $xml->saveXML();
        $this->getOrderResponseData($xmlResponce,$this->operation);
        $this->assertEquals($operationname,$this->operation->order->operation);
    }
    public function loadFileData($fileName)
    {
        $xml = new DomDocument() ; // simplexml_load_file('c:\tmp\xml\Response2.xml');
        $xml->load($fileName);
        return $xml->saveXML();
    }

    /**
     * @dataProvider providerResponseStatus
     * @param $fileName
     * @param $status
     */
    public function testStatus($fileName,$status)
    {
        $xmlResponce = $this->loadFileData($fileName);
        $this->getOrderResponseData($xmlResponce,$this->operation);
        $this->assertEquals($status,$this->operation->order->getStatus());
    }
    /**
     * @dataProvider providerResponseOrderId
     * @param $fileName
     * @param $orderId
     */
    public function testOrderId($fileName,$orderId)
    {
        $xmlResponce = $this->loadFileData($fileName);
        $this->getOrderResponseData($xmlResponce,$this->operation);
        $this->assertEquals($orderId,$this->operation->order->getOrderid());
    }

    /**
     * @dataProvider providerResponseURL
     * @param $fileName
     * @param $url
     */
    public function testUrl($fileName,$url)
    {
        $xmlResponce = $this->loadFileData($fileName);
        $this->getOrderResponseData($xmlResponce,$this->operation);
        $this->assertEquals($url,$this->operation->order->getUrl());
    }
    /**
     * @dataProvider providerResponseSessionId
     * @param $fileName
     * @param $sessionId
     */
    public function testSessionId($fileName,$sessionId)
    {
        $xmlResponce = $this->loadFileData($fileName);
        $this->getOrderResponseData($xmlResponce,$this->operation);
        $this->assertEquals($sessionId,$this->operation->order->getSessionid());
    }
    public function providerResponse()
    {
        return [
            ['c:\tmp\xml\Response1.xml','CreateOrder'],
            ['c:\tmp\xml\Response2.xml','CreateOrder']
        ];
    }
    public function providerResponseStatus()
    {
        return [
            ['c:\tmp\xml\Response1.xml','00'],
            ['c:\tmp\xml\Response2.xml','30'],
        ];
    }
    public function providerResponseOrderId()
    {
        return [
            ['c:\tmp\xml\Response1.xml','828'],
            ['c:\tmp\xml\Response3.xml','999'],
        ];
    }
    public function providerResponseURL()
    {
        return [
            ['c:\tmp\xml\Response1.xml','PayGateURL'],
            ['c:\tmp\xml\Response3.xml','PayGateURL2'],
        ];
    }
    public function providerResponseSessionId()
    {
        return [
            ['c:\tmp\xml\Response1.xml','ECDE79578768ECFBF2897A0F44CC0CEF'],
            ['c:\tmp\xml\Response3.xml','ECDE79574458EC0BF2897A0F46CC0CEF'],
        ];
    }
}