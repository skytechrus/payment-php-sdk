<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 12:53
 */

namespace Skytech\DataProvider\XML;
use SimpleXMLElement;
use XMLWriter;

class XMLDataOrderGetStatus  extends DataProvider
{

    /**
    * XMLDataGetOrderStatus constructor.
    * @param Operation $operation
    */
    public function __construct(Operation $operation)
    {
        $this->operation=$operation;
    }
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLgetOrderStatus();
        return $xmlRequestdata;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getOrderStatusResp($xmlresponse);
        return $this->operation;
    }
    public function makeXMLgetOrderStatus()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','GetOrderStatus');          //<Operation>GetOrderStatus</Operation>
        $xmlRequest->writeElement('Language', $this->operation->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('Merchant', $this->operation->order->getMerchantId());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID', $this->operation->order->getOrderId());          //<OrderID></OrderID>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('SessionID', $this->operation->order->getSessionId());     //<SessionID></SessionID>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function getOrderStatusResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->operation->order->SetOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->operation->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->operation->order->setOrderId($crordresp->xpath('TKKPG/Response/Order/OrderId'));
        $this->operation->order->setOrderStatus($crordresp->xpath('TKKPG/Response/Order/OrderStatus'));
        ;
    }
}
