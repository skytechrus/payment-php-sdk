<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */


/**
 * Class CompletionResponceTest
 */
class CompletionResponceTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var   Skytech\Response\XML\Provider
     */
    protected $response;


    protected function _before()
    {
     $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
<Response>
<Operation>Completion</Operation>
<Status>00</Status>
<POSResponse>
<l name="ResponseCode" value="001"></l>
<f name="F" value="491385 A"></f>
<f name="R" value="D"></f>
<f name="a" value="F100#C643#R01#"></f>
<f name="h" value="0010010090"></f> 
<f name="t" value="4634791"></f>
</POSResponse>
</Response>
</TKKPG>

XML;
        $this->response =  new Skytech\Sdk\Response\XML\Provider($xml);
    }

    protected function _after()
    {
    }

    // tests
    public function testTransactionID()
    {
      $attributeValue = $this->response->getAttributeName("POSResponse", "f", "t");
      $this->assertEquals("4634791", $attributeValue);
    }

    public function testApproval()
    {
        $attributeValue = $this->response->getAttributeName("POSResponse", "f", "F");
        $this->assertEquals("491385 A", $attributeValue);
    }

    public function testCardType()
    {
        $attributeValue = $this->response->getAttributeName("POSResponse", "f", "R");
        $this->assertEquals("D", $attributeValue);
    }
    public function testSequanceNumber()
    {
        $attributeValue = $this->response->getAttributeName("POSResponse", "f", "h");
        $this->assertEquals("0010010090", $attributeValue);
    }
}