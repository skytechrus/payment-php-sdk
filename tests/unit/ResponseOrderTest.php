<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Response\Order;

/**
 * Class ResponseOrderTest
 */
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

    /**
     * @param $fileName
     * @return mixed
     */
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
        $this->response =  new Skytech\Sdk\Response\XML\Provider($response);
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
        $this->response =  new Skytech\Sdk\Response\XML\Provider($response);
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
        $this->response =  new Skytech\Sdk\Response\XML\Provider($response);
        $this->assertEquals($url, $this->response->get('URL'));
    }

    /**
     * @return array
     */
    public function provideData()
    {
        return [
            ['./tests/_support/xml/Response1.xml', '00'],
            ['./tests/_support/xml/Response2.xml', '30']
        ];
    }

    /**
     * @return array
     */
    public function provideDataOrderId()
    {
        return [
            ['./tests/_support/xml/Response1.xml', '828'],
            ['./tests/_support/xml/Response3.xml', '999']
        ];
    }

    /**
     * @return array
     */
    public function provideDataURL()
    {
        return [
            ['./tests/_support/xml/Response1.xml', 'PayGateURL'],
            ['./tests/_support/xml/Response3.xml', 'PayGateURL2']
        ];
    }

    /**
     * @return array
     */
    public function provideDataSessionId()
    {
        return [
            [
                './tests/_support/xml/Response1.xml',
                'ECDE79578768ECFBF2897A0F44CC0CEF']
        ];
    }
}
