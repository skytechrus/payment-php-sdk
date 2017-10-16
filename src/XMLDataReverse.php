<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 14:12
 */

namespace Skytech;
use XMLWriter;
use SimpleXMLElement;

class XMLDataReverse extends DataProvider
{
    /**
     * XMLDataReverse constructor.
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation=$operation;
    }
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLCreateReverse();
        return $xmlRequestdata;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getReverseResp($xmlresponse);
        return $this->operation;
    }
    public function makeXMLCreateReverse()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','Reverse');          //<Operation>Reverse</Operation>
        $xmlRequest->writeElement('Language', $this->operation->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('Merchant', $this->operation->order->getMerchantid());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->operation->order->getOrderid());          //<OrderID></OrderID>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('Amount',$this->operation->order->getAmount());     //<Amount></Amount>
        $xmlRequest->writeElement('Description',$this->operation->order->getDescription());//<Description></Description>
        $xmlRequest->writeElement('SessionID',$this->operation->order->getSessionid());     //<SessionID></SessionID>
        $xmlRequest->writeElement('PAN',$this->operation->card->getPan()); //<PAN></PAN>
        $xmlRequest->writeElement('CardUID', $this->operation->card->getCardUID()); //<CardUID></CardUID>
        $xmlRequest->writeElement('TranId', $this->operation->transaction->transid);//<TranId></TranId>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function getReverseResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->operation->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->operation->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->operation->order->setOrderid($crordresp->xpath('TKKPG/Response/Order/OrderId'));
        $this->operation->transaction->responsecode =  $crordresp->xpath('TKKPG/Response/Reversal/RespCode')   ;
        $this->operation->transaction->responsedescription =   $crordresp->xpath('TKKPG/Response/Reversal/RespMessage');
    }
}