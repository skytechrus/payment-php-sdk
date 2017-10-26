<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 14:29
 */

namespace Skytech\DataProvider\XML;
use SimpleXMLElement;
use Skytech\DataProvider;
use XMLWriter;

class OrderInfo extends DataProvider
{
    public function __construct(Operation $operation)
    {
        $this->operation=$operation;
    }
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLGetOrderInfo();
        return $xmlRequestdata;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getInfoRequestResp($xmlresponse);
    }
    public function makeXMLGetOrderInfo()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','GetOrderInformation');          //<Operation>GetOrderInformation</Operation>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('Merchant', $this->operation->order->getMerchantId());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID', $this->operation->order->getOrderId());          //<OrderID></OrderID>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('SessionID', $this->operation->order->getSessionId());     //<SessionID></SessionID>
        $xmlRequest->writeElement('ShowParams','true');    //<ShowParams></ShowParams>
        $xmlRequest->writeElement('ShowOperations','true'); //<ShowOperations></ShowOperations>
        $xmlRequest->writeElement('ClassicView','true');   //<ClassicView></ClassicView>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function getInfoRequestResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->operation->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->operation->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->operation->order->setOrderId($crordresp->xpath('Order/row/id'));
        $this->operation->order->setOperationType($crordresp->xpath('Order/row/OrderType'));
        $this->operation->order->setSessionId($crordresp->xpath('Order/row/SessionID'));
        $this->operation->order->setMerchantId($crordresp->xpath('Order/row/MerchantID'));
        $this->operation->order->setAmount($crordresp->xpath('Order/row/Amount'));
        $this->operation->order->setCurrency($crordresp->xpath('Order/row/Currency'));
        $this->operation->order->setLanguage($crordresp->xpath('Order/row/OrderLanguage'));
        $this->operation->order->setDescription($crordresp->xpath('Order/row/Description'));

        $this->operation->url_settings->setApproveurl($crordresp->xpath('Order/row/ApproveURL'));
        $this->operation->url_settings->setCancelurl($crordresp->xpath('Order/row/CancelURL'));
        $this->operation->url_settings->setDeclineurl($crordresp->xpath('Order/row/DeclineURL'));

        $this->operation->order->setOrderStatus($crordresp->xpath('Order/row/Orderstatus'));
        $this->operation->transaction->transid = $crordresp->xpath('Order/row/twoId');
        $this->operation->order->setFee($crordresp->xpath('Order/row/Fee'));

    }
}
