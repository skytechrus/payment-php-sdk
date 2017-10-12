<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 11:01
 */

namespace Skytech;
use XMLWriter;

class XMLDataOrder3DS extends DataProvider
{
    use XMLOrderGetResponse;
    /**
     * XMLDataOrder3DS constructor.
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation=$operation;
    }
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLCreateOrder();
        return $xmlRequestdata;
    }
    public function makeXMLCreateOrder()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','CreateOrder');          //<Operation>CreateOrder</Operation>
        $xmlRequest->writeElement('Language', $this->operation->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('OrderType', $this->operation->order->getOperationtype());//<OrderType></OrderType>
        $xmlRequest->writeElement('Merchant', $this->operation->order->getMerchantid());           //<Merchant></Merchant>
        $xmlRequest->writeElement('Amount',$this->operation->order->getAmount());                 //<Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->operation->order->getCurrency());              //<Currency></Currency>
        $xmlRequest->writeElement('Description', $this->operation->order->getDescription());  //<Description></Description>
        $xmlRequest->writeElement('ApproveURL', $this->operation->url_settings->getApproveurl());    //<ApproveURL></ApproveURL>
        $xmlRequest->writeElement('CancelURL', $this->operation->url_settings->getCancelurl());      //<CancelURL></CancelURL>
        $xmlRequest->writeElement('DeclineURL', $this->operation->url_settings->getDeclineurl());    //<DeclineURL></DeclineURL>
        $xmlRequest->writeElement('email', $this->operation->customer->getEmailaddr());          //<email></email>
        $xmlRequest->writeElement('phone', $this->operation->customer->phone);              //<phone></phone>');
        $xmlRequest->startElement('AddParams');                        //<AddParams>
        $xmlRequest->writeRaw( $this->GetAddParams());
        //$xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this->order));
        $xmlRequest->endElement();                                           //</AddParams>
        $xmlRequest->writeElement('Fee',$this->operation->order->getFee());                   //<Fee></Fee>
        $xmlRequest->endElement(); //</Order>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xmlRequest->endDocument();
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function GetAddParams()
    {
        $xml_add_par =  new XMLWriter();
        $xml_add_par->openMemory();
        $xml_add_par->setIndent(true);
        $xml_add_par->writeElement('email',$this->operation->customer->getEmailaddr());
        $xml_add_par->writeElement('phone',$this->operation->customer->getPhone());
        $xml_add_par->writeElement('SenderName',$this->operation->customer->firstname);
        $xml_add_par->writeElement('Address',$this->operation->customer->address->addressline);
        $xml_add_par->writeElement('ResidentCountry',$this->operation->customer->address->getCountry());
        $xml_add_par->writeElement('ResidentCityInLatin',$this->operation->customer->address->getCity());
        $xml_add_par->writeElement('SenderPostalCode',$this->operation->customer->address->getZip());
        $xml = $xml_add_par->outputMemory(true);
        return $xml;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getOrderResponseData($xmlresponse,$this->operation);
    }
}