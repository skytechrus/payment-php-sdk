<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 14:44
 */

namespace Skytech\DataProvider\XML;
use XMLWriter;
use SimpleXMLElement;


class Refund extends DataProvider
{
    /**
     * Refund constructor.
     *
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation=$operation;
    }
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLRefund();
        return $xmlRequestdata;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getRefundResp($xmlresponse);
        return $this->operation;
    }
    public function makeXMLRefund()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','Refund');          //<Operation>Refund</Operation>
        $xmlRequest->writeElement('Language', $this->operation->order->getLanguage());        //<Language></Language>)
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('Merchant', $this->operation->order->getMerchantId());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID', $this->operation->order->getOrderId());          //<OrderID></OrderID>
        $xmlRequest->writeElement('AddParams',null);                        //<AddParams></AddParams>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('Description',$this->operation->order->getDescription()); //<Description></Description>//</Order>
        $xmlRequest->writeElement('SessionID', $this->operation->order->getSessionId());     //<SessionID></SessionID>
        $xmlRequest->startElement('Refund');                             //<Refund>
        $xmlRequest->writeElement('Amount',$this->operation->order->getAmount());  //<Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->operation->order->getCurrency()); //<Currency></Currency>
        $xmlRequest->writeElement('WithFee',null); //<WithFee></WithFee>
        $xmlRequest->endElement();                                 //</Refund>
        $xmlRequest->writeElement('PAN',$this->operation->card->getPan()); //<PAN></PAN>
        $xmlRequest->writeElement('CardUID',$this->operation->card->getCardUID());//<CardUID></CardUID>
        $xmlRequest->writeElement('TranId',$this->operation->transaction->transid);   //<TranId></TranId>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function getRefundResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->operation->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->operation->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
    }
}
