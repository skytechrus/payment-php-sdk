<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 14:52
 */

namespace Skytech\DataProvider\XML;

use Skytech\DataProvider;
use Skytech\Operation\Operation;
use XMLWriter;
use SimpleXMLElement;


class XMLDataPurchase extends DataProvider
{
    use XML_FADA_Data;


    /**
     * XMLDataPurchase constructor.
     * @param Operation $operation
     */
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
        return $this->operation;
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
        $xmlRequest->writeElement('Merchant',$this->operation->merchant->getMerchantid());//<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->operation->order->getOrderid());//<OrderID></OrderID>
        $xmlRequest->startElement('AddParams');//<AddParams>
        $xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this->operation));
        $xmlRequest->endElement(); //</AddParams>
        $xmlRequest->endElement(); //</Order>
      //  $xmlRequest->writeElement('SessionID',$this->operation->order->getSessionid()); // <SessionID></SessionID>
        $xmlRequest->writeElement('Amount',$this->operation->order->getAmount()); // <Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->operation->order->getCurrency());// <Currency></Currency>
        $xmlRequest->writeElement('PAN',$this->operation->card->getPan()); // <PAN></PAN>
        //   $xmlRequest->writeElement('CardUID',$this->order->card->getCardUID()); // <CardUID></CardUID>
        $xmlRequest->writeElement('ExpDate',$this->operation->card->getExpDate()); // <ExpDate></ExpDate> //YYMM
        // $xmlRequest->writeElement('CVV2',null);// <CVV2></CVV2>
        // $xmlRequest->writeElement('CAVV',null);//<CAVV></CAVV> //<!-- код подтверждения 3-D Secure протокола -->
        //$xmlRequest->writeElement('eci',null); //<eci></eci> // <!-- код TWEC-индикатора -->
        //$xmlRequest->writeElement('DraftCaptureFlag',null); // <DraftCaptureFlag></DraftCaptureFlag>
        if (!empty($this->operation->customer->getIp())){
            $xmlRequest->writeElement('IP',$this->operation->customer->getIp());
        } //<IP></IP>
        //$xmlRequest->writeElement('isMOTO',null); // <isMOTO></isMOTO>
        //$xmlRequest->writeElement('IncreaseOrderAmount',null); // <IncreaseOrderAmount></IncreaseOrderAmount>
        $xmlRequest->writeElement('ResponseFormat','TKKPG'); //<ResponseFormat></ResponseFormat>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function getPurchaseResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
      //  $this->operation->order->setOperation($crordresp->xpath("//Operation")[0]);
      //  $this->operation->order->setStatus($crordresp->xpath("//Status")[0]);
        if (!empty($crordresp->xpath("//OrderId")[0])) {
            $this->operation->order->setOrderid($crordresp->xpath("//OrderId")[0]);
        }

        if (!empty($crordresp->xpath("//PurchaseAmount")[0])) {
            $this->operation->order->setAmount($crordresp->xpath("//PurchaseAmount")[0]);
        }
        if (!empty($crordresp->xpath("//Currency")[0])){
            $this->operation->order->setCurrency($crordresp->xpath("//Currency")[0]);
        }
        if (!empty($crordresp->xpath("//OrderDescription")[0])){
            $this->operation->order->setDescription($crordresp->xpath("//OrderDescription")[0]);
        }
        if (!empty($crordresp->xpath("//ResponseCode")[0])){
            $this->operation->transaction->responsecode = $crordresp->xpath("//ResponseCode")[0];
        }
        if (!empty( $crordresp->xpath("//ResponseDescription")[0])){
            $this->operation->transaction->responsedescription = $crordresp->xpath("//ResponseDescription")[0];
        }
        if (!empty($crordresp->xpath("//OrderStatus")[0])){
            $this->operation->order->setOrderstatus($crordresp->xpath("//OrderStatus")[0] );
        }
        if (!empty($crordresp->xpath("//ApprovalCode")[0])){
            $this->operation->transaction->approvalcode =$crordresp->xpath("//ApprovalCode")[0];
        }
        if (!empty($crordresp->xpath("//ApprovalCodeScr")[0])){
            $this->operation->transaction->approvalcodestr =$crordresp->xpath("//ApprovalCodeScr")[0];
        }
        if (!empty($crordresp->xpath("//OrderDescription")[0])){
            $this->operation->order->setDescription($crordresp->xpath("//OrderDescription")[0]);
        }
        if (!empty($crordresp->xpath("//PAN")[0])){
            $this->operation->card->setPan($crordresp->xpath("//PAN")[0]);
        }
        if (!empty($crordresp->xpath("//MerchantTranID")[0])){
            $this->operation->order->setXid($crordresp->xpath("//MerchantTranID")[0]);
        }

        if (!empty($crordresp->xpath("//Brand")[0])){
            $this->operation->card->setBrand($crordresp->xpath("//Brand")[0]);
        }
        //$this->order->transdata->transid = $crordresp->xpath("//f[@name = 't']")['value']; //?
    }
}
