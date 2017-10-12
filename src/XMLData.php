<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.10.2017
 * Time: 15:36
 */

namespace Skytech;

use SimpleXMLElement;
use XMLWriter;

class XMLData extends DataProvider
{
    /**
     * XMLData constructor.
     */
    public function __construct(Order $order)
    {
        $this->order=$order;
    }
    /**
     * return request in XML format
     */
    public function getRequestData()
    {
        $operation = $this->order->operation;
        $xmlRequestdata ='';
        switch ($operation)
        {
            case 'CreateOrder':
                $xmlRequestdata = $this->makeXMLCreateOrder();
                break;
            case 'Purchase':
                $xmlRequestdata = $this->makeXMLPurchase();
                break;
            case 'Reverse':
                $xmlRequestdata = $this->makeXMLCreateReverse();
                break;
            case 'Refund':
                $xmlRequestdata = $this->makeXMLRefund();
                break;
            case 'GetOrderInformation':
                $xmlRequestdata = $this->makeXMLGetOrderInfo();
                break;
            case 'GetOrderStatus':
                $xmlRequestdata = $this->makeXMLgetOrderStatus();
                break;
        }
        return $xmlRequestdata;
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
        $xmlRequest->writeElement('Merchant',$this->order->getMerchantid());//<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->order->getOrderid());//<OrderID></OrderID>
        $xmlRequest->startElement('AddParams');//<AddParams>
        $xmlRequest->startElement('FA-DATA');//<FA-DATA>
        $xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this->order));
        $xmlRequest->endElement(); //</FA-DATA>
        $xmlRequest->endElement(); //</AddParams>
        $xmlRequest->endElement(); //</Order>
        $xmlRequest->writeElement('SessionID',$this->order->getSessionid()); // <SessionID></SessionID>
        $xmlRequest->writeElement('Amount',$this->order->getAmount()); // <Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->order->getCurrency());// <Currency></Currency>
        $xmlRequest->writeElement('PAN',$this->order->card->getPan()); // <PAN></PAN>
     //   $xmlRequest->writeElement('CardUID',$this->order->card->getCardUID()); // <CardUID></CardUID>
        $xmlRequest->writeElement('ExpDate',$this->order->card->getExpDate()); // <ExpDate></ExpDate> //YYMM
       // $xmlRequest->writeElement('CVV2',null);// <CVV2></CVV2>
       // $xmlRequest->writeElement('CAVV',null);//<CAVV></CAVV> //<!-- код подтверждения 3-D Secure протокола -->
        $xmlRequest->writeElement('eci',null); //<eci></eci> // <!-- код TWEC-индикатора -->
        $xmlRequest->writeElement('DraftCaptureFlag',null); // <DraftCaptureFlag></DraftCaptureFlag>
        $xmlRequest->writeElement('IP',$this->order->customer->getIp()); //<IP></IP>
        $xmlRequest->writeElement('isMOTO',null); // <isMOTO></isMOTO>
        $xmlRequest->writeElement('IncreaseOrderAmount',null); // <IncreaseOrderAmount></IncreaseOrderAmount>
        $xmlRequest->writeElement('ResponseFormat','TKKPG'); //<ResponseFormat></ResponseFormat>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function makeXMLCreateOrder()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','CreateOrder');          //<Operation>CreateOrder</Operation>
        $xmlRequest->writeElement('Language', $this->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('OrderType', $this->order->getOperationtype());//<OrderType></OrderType>
        $xmlRequest->writeElement('Merchant', $this->order->getMerchantid());           //<Merchant></Merchant>
        $xmlRequest->writeElement('Amount',$this->order->getAmount());                 //<Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->order->getCurrency());              //<Currency></Currency>
        $xmlRequest->writeElement('Description', $this->order->getDescription());  //<Description></Description>
        $xmlRequest->writeElement('ApproveURL', $this->order->getApproveurl());    //<ApproveURL></ApproveURL>
        $xmlRequest->writeElement('CancelURL', $this->order->getCancelurl());      //<CancelURL></CancelURL>
        $xmlRequest->writeElement('DeclineURL', $this->order->getDeclineurl());    //<DeclineURL></DeclineURL>
        $xmlRequest->writeElement('email', $this->order->customer->getEmailaddr());          //<email></email>
        $xmlRequest->writeElement('phone', $this->order->customer->phone);              //<phone></phone>');
        $xmlRequest->startElement('AddParams');                        //<AddParams>
        $xmlRequest->writeRaw( $this->GetAddParams());
        //$xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this->order));
        $xmlRequest->endElement();                                           //</AddParams>
        $xmlRequest->writeElement('Fee',$this->order->getFee());                   //<Fee></Fee>
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
        switch ($this->order->getOperationtype()){
            case 'Purchase':
                $xml_add_par->writeElement('FA-DATA',$this->makeFada_data($this->order));
                //$xml_add_par->writeElement('AcctType');
                //$xml_add_par->writeElement('TranAddendums');
                $xml_add_par->writeElement('OrderExpirationPeriod',$this->order->getOrderexpperiod());
                $xml_add_par->writeElement('OrigAmount',$this->order->getOrigamount());
                $xml_add_par->writeElement('OrigCurrency',$this->order->getOrigcurrency());
                break;
            case 'P2PTransfer':
                $xml_add_par->writeElement('OrigAmount',$this->order->getOrigamount());
                $xml_add_par->writeElement('OrigCurrency',$this->order->getOrigcurrency());
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
                $xml_add_par->writeElement('Fee',$this->order->getFee());
                $xml_add_par->writeElement('DescriptionHtml');
                break;
            case 'QuasiCash':
                $xml_add_par->writeElement('OrigAmount',$this->order->getOrigamount());
                $xml_add_par->writeElement('OrigCurrency',$this->order->getOrigcurrency());
                break;
            case 'PrepaidCode':
                $xml_add_par->writeElement('VendorID',$this->order->getVendorid());
                $xml_add_par->writeElement('OrigAmount',$this->order->getOrigamount());
                $xml_add_par->writeElement('OrigCurrency',$this->order->getOrigcurrency());
                break;
            case '3DSOnly':
                $xml_add_par->writeElement('email',$this->order->customer->getEmailaddr());
                $xml_add_par->writeElement('phone',$this->order->customer->getPhone());
                $xml_add_par->writeElement('SenderName',$this->order->customer->firstname);
                $xml_add_par->writeElement('Address',$this->order->customer->address->addressline);
                $xml_add_par->writeElement('ResidentCountry',$this->order->customer->address->getCountry());
                $xml_add_par->writeElement('ResidentCityInLatin',$this->order->customer->address->getCity());
                $xml_add_par->writeElement('SenderPostalCode',$this->order->customer->address->getZip());
                break;
            case 'PreAuth':
                $xml_add_par->writeElement('FA-DATA',$this->makeFada_data($this->order));
                $xml_add_par->writeElement('SenderPostalCode',$this->order->customer->address->getZip());
                //$xml_add_par->writeElement('AcctType');
                //$xml_add_par->writeElement('TranAddendums');
                $xml_add_par->writeElement('OrderExpirationPeriod',$this->order->getOrderexpperiod());
                $xml_add_par->writeElement('OrigAmount',$this->order->getOrigamount());
                $xml_add_par->writeElement('OrigCurrency',$this->order->getOrigcurrency());
                break;
            case 'Payment':
                $xml_add_par->writeElement('VendorID',$this->order->getVendorid());
                $xml_add_par->writeElement('OrigAmount',$this->order->getOrigamount());
                $xml_add_par->writeElement('OrigCurrency',$this->order->getOrigcurrency());
                // PaymentParams
                break;
        }
        $xml = $xml_add_par->outputMemory(true);
        return $xml;
    }
    public function makeXMLgetOrderStatus()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','GetOrderStatus');          //<Operation>GetOrderStatus</Operation>
        $xmlRequest->writeElement('Language', $this->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('Merchant', $this->order->getMerchantid());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->order->getOrderid());          //<OrderID></OrderID>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('SessionID',$this->order->getSessionid());     //<SessionID></SessionID>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function makeXMLCreateReverse()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','Reverse');          //<Operation>Reverse</Operation>
        $xmlRequest->writeElement('Language', $this->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('Merchant', $this->order->getMerchantid());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->order->getOrderid());          //<OrderID></OrderID>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('Amount',$this->order->getAmount());     //<Amount></Amount>
        $xmlRequest->writeElement('Description',$this->order->getDescription());//<Description></Description>
        $xmlRequest->writeElement('SessionID',$this->order->getSessionid());     //<SessionID></SessionID>
        $xmlRequest->writeElement('PAN',$this->order->card->getPan()); //<PAN></PAN>
        $xmlRequest->writeElement('CardUID', $this->order->card->getCardUID()); //<CardUID></CardUID>
        $xmlRequest->writeElement('TranId', $this->order->transdata->transid);//<TranId></TranId>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
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
        $xmlRequest->writeElement('Merchant', $this->order->getMerchantid());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->order->getOrderid());          //<OrderID></OrderID>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('SessionID',$this->order->getSessionid());     //<SessionID></SessionID>
        $xmlRequest->writeElement('ShowParams','true');    //<ShowParams></ShowParams>
        $xmlRequest->writeElement('ShowOperations','true'); //<ShowOperations></ShowOperations>
        $xmlRequest->writeElement('ClassicView','true');   //<ClassicView></ClassicView>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function makeXMLRefund()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','Refund');          //<Operation>Refund</Operation>
        $xmlRequest->writeElement('Language', $this->order->getLanguage());        //<Language></Language>)
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('Merchant', $this->order->getMerchantid());     //<Merchant></Merchant>
        $xmlRequest->writeElement('OrderID',$this->order->getOrderid());          //<OrderID></OrderID>
        $xmlRequest->writeElement('AddParams',null);                        //<AddParams></AddParams>
        $xmlRequest->endElement();                                                     //</Order>
        $xmlRequest->writeElement('Description',$this->order->getDescription()); //<Description></Description>//</Order>
        $xmlRequest->writeElement('SessionID',$this->order->getSessionid());     //<SessionID></SessionID>
        $xmlRequest->startElement('Refund');                             //<Refund>
        $xmlRequest->writeElement('Amount',$this->order->getAmount());  //<Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->order->getCurrency()); //<Currency></Currency>
        $xmlRequest->writeElement('WithFee',null); //<WithFee></WithFee>
        $xmlRequest->endElement();                                 //</Refund>
        $xmlRequest->writeElement('PAN',$this->order->card->getPan()); //<PAN></PAN>
        $xmlRequest->writeElement('CardUID',$this->order->card->getCardUID());//<CardUID></CardUID>
        $xmlRequest->writeElement('TranId',$this->order->transdata->transid);   //<TranId></TranId>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function makeFada_line($name,$value)
    {
        $fada_line =null;
        if(!is_null($value)) {
            $fada_line = $name . '=' . $value . ';';
        }
        return $fada_line;
    }
    public function makeFada_data(Order $order)
    {
        $fada_data = null;
        $fada_data .= $this->makeFada_line('ShippingCountry', $order->customer->address->getCountry());
        $fada_data .= $this->makeFada_line('ShippingCity', $order->customer->address->getCountry());
        $fada_data .= $this->makeFada_line('ShippingState', $order->customer->address->getRegion());
        $fada_data .= $this->makeFada_line('ShippingZipCode', $order->customer->address->getZip());
        $fada_data .= $this->makeFada_line('ShippingAddress', $order->customer->address->addressline );
// $fada_data .= $this->makeFada_line('DeliveryPeriod', null );
        $fada_data .= $this->makeFada_line('Phone', $order->customer->phone );
        $fada_data .= $this->makeFada_line('Email', $order->customer->getEmailaddr() );
        $fada_data .= $this->makeFada_line('MerchantOrderID', $order->getXid());
        return $fada_data;
    }
    public function getResponseData($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $operation = $crordresp->xpath('TKKPG/Response/Operation');
        switch ($operation) {
            case 'CreateOrder':
                $this->getOrderCreateResp($xmlresponse);
                break;
            case 'Purchase':
                $this->getPurchaseResp($xmlresponse);
                break;
            case 'Refund':
                $this->getRefundResp($xmlresponse);
                break;
            case 'Reverse':
                $this->getReverseResp($xmlresponse);
                break;
            case 'GetOrderStatus':
                $this->getOrderStatusResp($xmlresponse);
                break;
            case 'GetOrderInformation':
                $this->getInfoRequestResp($xmlresponse);
                break;
        }
    }
    public function getOrderCreateResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->order->setStatus( $crordresp->xpath('TKKPG/Response/Status'))  ;
        $this->order->setOrderid($crordresp->xpath('TKKPG/Response/Order/OrderId'));
        $this->order->setSessionid( $crordresp->xpath('TKKPG/Response/Order/SessionID'));
        $this->order->setUrl($crordresp->xpath('TKKPG/Response/Order/URL'));
    }
    public function getOrderStatusResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->order->SetOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->order->setOrderid($crordresp->xpath('TKKPG/Response/Order/OrderId'));
        $this->order->setOrderstatus( $crordresp->xpath('TKKPG/Response/Order/OrderStatus'))  ;
         ;
    }
    public function getReverseResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->order->setOrderid($crordresp->xpath('TKKPG/Response/Order/OrderId'));
        $this->order->transdata->responsecode =  $crordresp->xpath('TKKPG/Response/Reversal/RespCode')   ;
        $this->order->transdata->responsedescription =   $crordresp->xpath('TKKPG/Response/Reversal/RespMessage');
    }
    public function getInfoRequestResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->order->setOrderid($crordresp->xpath('Order/row/id'));
        $this->order->setOperationtype($crordresp->xpath('Order/row/OrderType'));
        $this->order->setSessionid($crordresp->xpath('Order/row/SessionID'));
        $this->order->setMerchantid($crordresp->xpath('Order/row/MerchantID'));
        $this->order->setAmount($crordresp->xpath('Order/row/Amount'));
        $this->order->setCurrency($crordresp->xpath('Order/row/Currency'));
        $this->order->setLanguage($crordresp->xpath('Order/row/OrderLanguage'));
        $this->order->setDescription($crordresp->xpath('Order/row/Description'));

        $this->order->setApproveurl($crordresp->xpath('Order/row/ApproveURL'));
        $this->order->setCancelurl($crordresp->xpath('Order/row/CancelURL'));
        $this->order->setDeclineurl($crordresp->xpath('Order/row/DeclineURL'));

        $this->order->setOrderstatus($crordresp->xpath('Order/row/Orderstatus'));
        $this->order->transdata->transid = $crordresp->xpath('Order/row/twoId');
        $this->order->setFee($crordresp->xpath('Order/row/Fee'));

    }
    public function getRefundResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
    }
    public function getPurchaseResp($xmlresponse)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $this->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $this->order->setStatus($crordresp->xpath('TKKPG/Response/Status'));
        $this->order->setOrderid($crordresp->xpath('Message/OrderId'));
        $this->order->setOperationtype($crordresp->xpath('Message/TransactionType'));
        $this->order->setAmount($crordresp->xpath('Message/PurchaseAmount'));
        $this->order->setCurrency($crordresp->xpath('Message/Currency'));
        $this->order->setDescription($crordresp->xpath('Message/OrderDescription'));
        $this->order->setFee($crordresp->xpath('Message/AcqFee'));
        $this->order->transdata->responsecode = $crordresp->xpath('Message/ResponseCode');
        $this->order->transdata->responsedescription = $crordresp->xpath('Message/ResponseDescription');
        $this->order->setOrderstatus($crordresp->xpath('Message/OrderStatus') );
        $this->order->transdata->approvalcode =$crordresp->xpath('Message/ApprovalCode');
        $this->order->transdata->approvalcodestr =$crordresp->xpath('Message/ApprovalCodeScr');
        $this->order->setDescription($crordresp->xpath('Message/OrderDescription'));
        $this->order->setXid($crordresp->xpath('Message/MerchantTranID'));
        //$this->order->transdata->transid = $crordresp->xpath("//f[@name = 't']")['value']; //?
    }
}