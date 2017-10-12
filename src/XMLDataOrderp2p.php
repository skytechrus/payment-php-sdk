<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 10:30
 */

namespace Skytech;
use XMLWriter;

class XMLDataOrderp2p extends DataProvider
{
    use XMLOrderGetResponse;
    /**
     * XMLData constructor.
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
        $xml_add_par->writeElement('OrigAmount',$this->operation->order->getOrigamount());
        $xml_add_par->writeElement('OrigCurrency',$this->operation->order->getOrigcurrency());
        $xml_add_par->writeElement('RFirstName',$this->order->recipient->firstname);
        $xml_add_par->writeElement('RSurname',$this->order->recipient->lastname);
        $xml_add_par->writeElement('ReMail',$this->order->recipient->getEmailaddr());
        $xml_add_par->writeElement('RPhone',$this->order->recipient->getPhone());
        $xml_add_par->writeElement('SFirstName',$this->order->customer->firstname);
        $xml_add_par->writeElement('SSurname',$this->order->customer->lastname);
        $xml_add_par->writeElement('SeMail',$this->order->customer->getEmailaddr());
        $xml_add_par->writeElement('SPhone',$this->order->customer->getPhone());
        $xml_add_par->writeElement('SAddress',$this->order->customer->address->addressline);
        $xml_add_par->writeElement('SCountry',$this->order->customer->address->getCountry());
        $xml_add_par->writeElement('Fee',$this->operation->order->getFee());
        $xml_add_par->writeElement('DescriptionHtml');
        $xml = $xml_add_par->outputMemory(true);
        return $xml;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getOrderResponseData($xmlresponse,$this->order);
    }
}