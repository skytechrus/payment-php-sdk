<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 14:52
 */

namespace Skytech;
use XMLWriter;
use SimpleXMLElement;


class XMLDataPurchase extends DataProvider
{
    use XML_FADA_Data;
    public function __construct(Operation $operation)
    {
        $this->operation=$operation;
    }
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLPurchase();
        return $xmlRequestdata;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getPurchaseResp($xmlresponse);
    }
    public function makeXMLPurchase()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','Purchase');
        $xmlRequest->startElement('Order');  //<Order>
        $xmlRequest->writeElement('Merchant',$this->operation->order->getMerchantid());//<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->operation->order->getOrderid());//<OrderID></OrderID>
        $xmlRequest->startElement('AddParams');//<AddParams>
        $xmlRequest->startElement('FA-DATA');//<FA-DATA>
        $xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this->operation));
        $xmlRequest->endElement(); //</FA-DATA>
        $xmlRequest->endElement(); //</AddParams>
        $xmlRequest->endElement(); //</Order>
        $xmlRequest->writeElement('SessionID',$this->operation->order->getSessionid()); // <SessionID></SessionID>
        $xmlRequest->writeElement('Amount',$this->operation->order->getAmount()); // <Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->operation->order->getCurrency());// <Currency></Currency>
        $xmlRequest->writeElement('PAN',$this->operation->card->getPan()); // <PAN></PAN>
        //   $xmlRequest->writeElement('CardUID',$this->order->card->getCardUID()); // <CardUID></CardUID>
        $xmlRequest->writeElement('ExpDate',$this->operation->card->getExpDate()); // <ExpDate></ExpDate> //YYMM
        // $xmlRequest->writeElement('CVV2',null);// <CVV2></CVV2>
        // $xmlRequest->writeElement('CAVV',null);//<CAVV></CAVV> //<!-- код подтверждения 3-D Secure протокола -->
        $xmlRequest->writeElement('eci',null); //<eci></eci> // <!-- код TWEC-индикатора -->
        $xmlRequest->writeElement('DraftCaptureFlag',null); // <DraftCaptureFlag></DraftCaptureFlag>
        $xmlRequest->writeElement('IP',$this->operation->customer->getIp()); //<IP></IP>
        $xmlRequest->writeElement('isMOTO',null); // <isMOTO></isMOTO>
        $xmlRequest->writeElement('IncreaseOrderAmount',null); // <IncreaseOrderAmount></IncreaseOrderAmount>
        $xmlRequest->writeElement('ResponseFormat','TKKPG'); //<ResponseFormat></ResponseFormat>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function getPurchaseResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->operation->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->operation->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->operation->order->setOrderid($crordresp->xpath('Message/OrderId'));
        $this->operation->order->setOperationtype($crordresp->xpath('Message/TransactionType'));
        $this->operation->order->setAmount($crordresp->xpath('Message/PurchaseAmount'));
        $this->operation->order->setCurrency($crordresp->xpath('Message/Currency'));
        $this->operation->order->setDescription($crordresp->xpath('Message/OrderDescription'));
        $this->operation->order->setFee($crordresp->xpath('Message/AcqFee'));
        $this->operation->transaction->responsecode = $crordresp->xpath('Message/ResponseCode');
        $this->operation->transaction->responsedescription = $crordresp->xpath('Message/ResponseDescription');
        $this->operation->order->setOrderstatus($crordresp->xpath('Message/OrderStatus') );
        $this->operation->transaction->approvalcode =$crordresp->xpath('Message/ApprovalCode');
        $this->operation->transaction->approvalcodestr =$crordresp->xpath('Message/ApprovalCodeScr');
        $this->operation->order->setDescription($crordresp->xpath('Message/OrderDescription'));
        $this->operation->order->setXid($crordresp->xpath('Message/MerchantTranID'));
        //$this->order->transdata->transid = $crordresp->xpath("//f[@name = 't']")['value']; //?
    }
}