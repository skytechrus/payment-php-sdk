<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use Sabre\Xml\Writer;
use Skytech\DataProvider;
use Skytech\Operation\Operation;
use XMLWriter;
use SimpleXMLElement;

/**
 * Class Purchase
 *
 * @package Skytech\DataProvider\XML
 */
class Purchase extends DataProvider implements \Sabre\XML\XmlSerializable
{
    /**
     * Purchase constructor.
     *
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return string
     */
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLPurchase();
        return $xmlRequestdata;
    }

    /**
     * @return string
     */
    public function makeXMLPurchase()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation', 'Purchase');
        $xmlRequest->startElement('Order');  //<Order>
        $xmlRequest->writeElement('Merchant', $this->operation->merchant->getId());//<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID', $this->operation->order->getOrderid());//<OrderID></OrderID>
        $xmlRequest->startElement('AddParams');//<AddParams>
        $xmlRequest->writeElement('FA-DATA', $this->makeFadaData($this->operation));
        $xmlRequest->endElement(); //</AddParams>
        $xmlRequest->endElement(); //</Order>
        //  $xmlRequest->writeElement('SessionID',$this->operation->order->getSessionid()); // <SessionID></SessionID>
        $xmlRequest->writeElement('Amount', $this->operation->order->getAmount()); // <Amount></Amount>
        $xmlRequest->writeElement('Currency', $this->operation->order->getCurrency());// <Currency></Currency>
        $xmlRequest->writeElement('PAN', $this->operation->card->getPan()); // <PAN></PAN>
        //   $xmlRequest->writeElement('CardUID',$this->order->card->getCardUID()); // <CardUID></CardUID>
        $xmlRequest->writeElement('ExpDate', $this->operation->card->getExpDate()); // <ExpDate></ExpDate> //YYMM
        // $xmlRequest->writeElement('CVV2',null);// <CVV2></CVV2>
        // $xmlRequest->writeElement('CAVV',null);//<CAVV></CAVV> //<!-- код подтверждения 3-D Secure протокола -->
        //$xmlRequest->writeElement('eci',null); //<eci></eci> // <!-- код TWEC-индикатора -->
        //$xmlRequest->writeElement('DraftCaptureFlag',null); // <DraftCaptureFlag></DraftCaptureFlag>
        if (!empty($this->operation->customer->getIp())) {
            $xmlRequest->writeElement('IP', $this->operation->customer->getIp());
        } //<IP></IP>
        //$xmlRequest->writeElement('isMOTO',null); // <isMOTO></isMOTO>
        //$xmlRequest->writeElement('IncreaseOrderAmount',null); // <IncreaseOrderAmount></IncreaseOrderAmount>
        $xmlRequest->writeElement('ResponseFormat', 'TKKPG'); //<ResponseFormat></ResponseFormat>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }

    /**
     * @param $xmlresponse
     * @return Operation
     */
    public function getResponseData($xmlresponse)
    {
        $this->getPurchaseResp($xmlresponse);
        return $this->operation;
    }

    /**
     * @param $xmlResponse
     */
    public function getPurchaseResp($xmlResponse)
    {
        $response = new SimpleXMLElement($xmlResponse);
        //  $this->operation->order->setOperation($response->xpath("//Operation")[0]);
        //  $this->operation->order->setStatus($response->xpath("//Status")[0]);
        if (!empty($response->xpath("//OrderId")[0])) {
            $this->operation->order->setOrderid($response->xpath("//OrderId")[0]);
        }

        if (!empty($response->xpath("//PurchaseAmount")[0])) {
            $amount = $response->xpath("//PurchaseAmount")[0];
            $this->operation->order->setAmount($amount);
        }
        if (!empty($response->xpath("//Currency")[0])) {
            $currency = $response->xpath("//Currency")[0];
            $this->operation->order->setCurrency($currency);
        }
        if (!empty($response->xpath("//OrderDescription")[0])) {
            $description = $response->xpath("//OrderDescription")[0];
            $this->operation->order->setDescription($description);
        }
        if (!empty($response->xpath("//ResponseCode")[0])) {
            $this->operation->transaction->responseCode = $response->xpath("//ResponseCode")[0];
        }
        if (!empty($response->xpath("//ResponseDescription")[0])) {
            $this->operation->transaction->responsedescription = $response->xpath("//ResponseDescription")[0];
        }
        if (!empty($response->xpath("//OrderStatus")[0])) {
            $this->operation->order->setOrderstatus($response->xpath("//OrderStatus")[0]);
        }
        if (!empty($response->xpath("//ApprovalCode")[0])) {
            $this->operation->transaction->approvalcode = $response->xpath("//ApprovalCode")[0];
        }
        if (!empty($response->xpath("//ApprovalCodeScr")[0])) {
            $this->operation->transaction->approvalcodestr = $response->xpath("//ApprovalCodeScr")[0];
        }
        if (!empty($response->xpath("//OrderDescription")[0])) {
            $this->operation->order->setDescription($response->xpath("//OrderDescription")[0]);
        }
        if (!empty($response->xpath("//PAN")[0])) {
            $this->operation->card->setPan($response->xpath("//PAN")[0]);
        }
        if (!empty($response->xpath("//MerchantTranID")[0])) {
            $this->operation->order->setXid($response->xpath("//MerchantTranID")[0]);
        }

        if (!empty($response->xpath("//Brand")[0])) {
            $this->operation->card->setBrand($response->xpath("//Brand")[0]);
        }
        //$this->order->transdata->transid = $response->xpath("//f[@name = 't']")['value']; //?
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * Use the $writer argument to write its own xml serialization.
     *
     * An important note: do _not_ create a parent element. Any element
     * implementing XmlSerializble should only ever write what's considered
     * its 'inner xml'.
     *
     * The parent of the current element is responsible for writing a
     * containing element.
     *
     * This allows serializers to be re-used for different element names.
     *
     * If you are opening new elements, you must also close them again.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(\Sabre\XML\Writer $writer)
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation', 'Purchase');
        $xmlRequest->startElement('Order');  //<Order>
        $xmlRequest->writeElement('Merchant', $this->operation->merchant->getId());//<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID', $this->operation->order->getOrderid());//<OrderID></OrderID>
        $xmlRequest->startElement('AddParams');//<AddParams>
        $xmlRequest->writeElement('FA-DATA', $this->makeFadaData($this->operation));
        $xmlRequest->endElement(); //</AddParams>
        $xmlRequest->endElement(); //</Order>
        //  $xmlRequest->writeElement('SessionID',$this->operation->order->getSessionid()); // <SessionID></SessionID>
        $xmlRequest->writeElement('Amount', $this->operation->order->getAmount()); // <Amount></Amount>
        $xmlRequest->writeElement('Currency', $this->operation->order->getCurrency());// <Currency></Currency>
        $xmlRequest->writeElement('PAN', $this->operation->card->getPan()); // <PAN></PAN>
        //   $xmlRequest->writeElement('CardUID',$this->order->card->getCardUID()); // <CardUID></CardUID>
        $xmlRequest->writeElement('ExpDate', $this->operation->card->getExpDate()); // <ExpDate></ExpDate> //YYMM
        // $xmlRequest->writeElement('CVV2',null);// <CVV2></CVV2>
        // $xmlRequest->writeElement('CAVV',null);//<CAVV></CAVV> //<!-- код подтверждения 3-D Secure протокола -->
        //$xmlRequest->writeElement('eci',null); //<eci></eci> // <!-- код TWEC-индикатора -->
        //$xmlRequest->writeElement('DraftCaptureFlag',null); // <DraftCaptureFlag></DraftCaptureFlag>
        if (!empty($this->operation->customer->getIp())) {
            $xmlRequest->writeElement('IP', $this->operation->customer->getIp());
        } //<IP></IP>
        //$xmlRequest->writeElement('isMOTO',null); // <isMOTO></isMOTO>
        //$xmlRequest->writeElement('IncreaseOrderAmount',null); // <IncreaseOrderAmount></IncreaseOrderAmount>
        $xmlRequest->writeElement('ResponseFormat', 'TKKPG'); //<ResponseFormat></ResponseFormat>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
        // TODO: Implement xmlSerialize() method.
        $writer->write([
            "TKKPG" => [
                "Request"
            ]
        ]);

    }
}
