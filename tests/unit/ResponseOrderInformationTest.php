<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

class ResponseOrderInformationTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var Skytech\Sdk\Response\XML\Provider
     */
    private $response;

    /**
     * @param $fileName
     * @return mixed
     */
    private function loadFile($fileName)
    {
        $xml = simplexml_load_file($fileName);
        return $xml->asXML();
    }
    protected function _before()
    {
//        $filePath = 'tests\_support\xml\OrderInformation.xml';
        var_dump(phpinfo());
        $filePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '_support' . DIRECTORY_SEPARATOR . 'xml' . DIRECTORY_SEPARATOR . 'OrderInformation.xml';
        $fileData = $this->loadFile($filePath);
        $this->response = new Skytech\Sdk\Response\XML\Provider($fileData);
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $this->assertEquals('POS_1', $this->response->get('Order/row/MerchantID'));
    }
    /**
     * @param $fieldName
     * @return int
     */
    protected function getInteger($fieldName)
    {
        return (int)$this->response->get($fieldName);
    }

    /**
     * @param $fieldName
     * @return string
     */
    protected function getString($fieldName)
    {
        return (string)$this->response->get($fieldName);
    }

    public function testGetOrderId()
    {
        $this->assertEquals(9074, $this->getInteger('Order/row/id'));
    }
    public function testGetCreateDate()
    {
        $this->assertEquals('2014-02-14 14:15:37', $this->getString('Order/row/createDate'));
    }
    public function testGetSessionID()
    {
        $this->assertEquals('B5EF753375C69B3A30700A82A43811E8', $this->getString('Order/row/SessionID'));
    }

    public function testGetAmount()
    {
        $this->assertEquals(2500, $this->getInteger('Order/row/Amount'));
    }
    public function testGetCurrency()
    {
        $this->assertEquals(840, $this->getInteger('Order/row/Currency'));
    }
    public function testGetDescription()
    {
        $this->assertEquals('Purchase', $this->getString('Order/row/Description'));
    }
    public function testGetApproveURL()
    {
        $this->assertEquals('/testshopPageApprove.jsp', $this->getString('Order/row/ApproveURL'));
    }
    public function testGetCancelURL()
    {
        $this->assertEquals('/testshopPageCancel.jsp', $this->getString('Order/row/CancelURL'));
    }
    public function testGetDeclineURL()
    {
        $this->assertEquals('/testshopPageReturn.jsp', $this->getString('Order/row/DeclineURL'));
    }
    public function testGetOrderStatus()
    {
        $this->assertEquals('EXPIRED', $this->getString('Order/row/Orderstatus'));
    }
    public function testGetTWOId()
    {
        $this->assertEquals(7014, $this->getInteger('Order/row/twoId'));
    }
    public function testGetReceipt()
    {
        $this->assertEquals('4', $this->getString('Order/row/Receipt'));
    }
    public function testGetRefundAmount()
    {
        $this->assertEquals(0, $this->getInteger('Order/row/RefundAmount'));
    }
    public function testGetRefundCurrency()
    {
        $this->assertEquals(null, $this->getInteger('Order/row/RefundCurrency'));
    }
    public function testGetOrderType()
    {
        $this->assertEquals('Purchase', $this->getString('Order/row/OrderType'));
    }
    public function testGetFee()
    {
        $this->assertEquals(0, $this->getInteger('Order/row/FEE'));
    }
}
