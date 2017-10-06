<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 04.10.2017
 * Time: 15:42
 */

namespace Skytech;
use SimpleXMLElement;
use XMLWriter;

include 'purchase.php';

class Order
{
    private $orderid; /** @var int unique order id generated by TWEC PG */
    private $xid; /** @var int unique order id  generated by merchant */
    private $orderdate;
    private $language;
    private $amount;
    private $currency;
    private $description;
    private $firstname;
    private $lastname;
    private $middlename;
    private $emailaddr;
    private $country;
    private $region;
    private $city;
    private $address;
    private $phone;
    private $zip;
    private $transactiontype;
    private $orderstatas;
    private $sessionid;
    private $merchantid;
    private $fee;
    private $declineurl;
    private $cancelurl;
    private $approveurl;

    function __construct()
    {
        $this->orderdate = time();
        $this->transactiontype = "Purchase";
    }

    /**
     * @param mixed $xid
     */
    public function setXid($xid)
    {
        $this->xid = $xid;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $emailaddr
     */
    public function setEmailaddr($emailaddr)
    {
        $this->emailaddr = $emailaddr;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        $this->region = $region;
    }
    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $middlename
     */
    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $orderid
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getEmailaddr()
    {
        return $this->emailaddr;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return mixed
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * @return int
     */
    public function getOrderdate()
    {
        return $this->orderdate;
    }

    /**
     * @return mixed
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getTransactiontype()
    {
        return $this->transactiontype;
    }

    /**
     * @return mixed
     */
    public function getXid()
    {
        return $this->xid;
    }

    /**
     * @param int $orderdate
     */
    public function setOrderdate($orderdate)
    {
        $this->orderdate = $orderdate;
    }

    /**
     * @param string $transactiontype
     */
    public function setTransactiontype($transactiontype)
    {
        $this->transactiontype = $transactiontype;
    }

    /**
     * @return mixed
     */
    public function getOrderstatas()
    {
        return $this->orderstatas;
    }

    /**
     * @return mixed
     */
    public function getSessionid()
    {
        return $this->sessionid;
    }

    /**
     * @param mixed $orderstatas
     */
    public function setOrderstatas($orderstatas)
    {
        $this->orderstatas = $orderstatas;
    }

    /**
     * @param mixed $approveurl
     */
    public function setApproveurl($approveurl)
    {
        $this->approveurl = $approveurl;
    }

    /**
     * @param mixed $cancelurl
     */
    public function setCancelurl($cancelurl)
    {
        $this->cancelurl = $cancelurl;
    }

    /**
     * @param mixed $declineurl
     */
    public function setDeclineurl($declineurl)
    {
        $this->declineurl = $declineurl;
    }

    /**
     * @return mixed
     */
    public function getApproveurl()
    {
        return $this->approveurl;
    }

    /**
     * @return mixed
     */
    public function getDeclineurl()
    {
        return $this->declineurl;
    }

    /**
     * @return mixed
     */
    public function getCancelurl()
    {
        return $this->cancelurl;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param mixed $fee
     */
    public function setFee($fee)
    {
        $this->fee = $fee;
    }

    /**
     * @return mixed
     */
    public function getMerchantid()
    {
        return $this->merchantid;
    }

    /**
     * @param mixed $merchantid
     */
    public function setMerchantid($merchantid)
    {
        $this->merchantid = $merchantid;
    }
    /**
     * @param mixed $sessionid
     */
    public function setSessionid($sessionid)
    {
        $this->sessionid = $sessionid;
    }
    public function MakeXMLCreateOrder()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','CreateOrder');   //<Operation>CreateOrder</Operation>
        $xmlRequest->writeElement('Language', $this->language);        //<Language></Language>
        $xmlRequest->startElement('Order');                            //<Order>
        $xmlRequest->writeElement('OrderType', $this->transactiontype);//<OrderType></OrderType>
        $xmlRequest->writeElement('Merchant', $this->merchantid);           //<Merchant></Merchant>
        $xmlRequest->writeElement('Amount', $this->amount);    //<Amount></Amount>
        $xmlRequest->writeElement('Currency', $this->currency);        //<Currency></Currency>
        $xmlRequest->writeElement('Description', $this->description);  //<Description></Description>
        $xmlRequest->writeElement('ApproveURL', $this->approveurl);    //<ApproveURL></ApproveURL>
        $xmlRequest->writeElement('CancelURL', $this->cancelurl);      //<CancelURL></CancelURL>
        $xmlRequest->writeElement('DeclineURL', $this->declineurl);    //<DeclineURL></DeclineURL>
        $xmlRequest->writeElement('email', $this->emailaddr);          //<email></email>
        $xmlRequest->writeElement('phone', $this->phone);              //<phone></phone>');
        $xmlRequest->startElement('AddParams');                        //<AddParams>
        $xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this));
        $xmlRequest->endElement();                                           //</AddParams>
        $xmlRequest->writeElement('Fee',$this->fee);                   //<Fee></Fee>
        $xmlRequest->endElement(); //</Order>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xmlRequest->endDocument();
        $xml = $xmlRequest->outputMemory();

        /*
           xmlwriter_start_document($xmlrequest,'1.0','UTF-8');
           xmlwriter_start_element ($xmlrequest,'TKKPG'); //<TKKPG>
           xmlwriter_start_element ($xmlrequest,'Request'); //<Request>
           xmlwriter_write_element ($xmlrequest,'Operation', 'CreateOrder'); //<Operation>CreateOrder</Operation>
           xmlwriter_write_element ($xmlrequest,'Language', $this->language);//<Language></Language>
           xmlwriter_start_element ($xmlrequest,'Order'); //<Order>
           xmlwriter_write_element ($xmlrequest,'OrderType', $this->transactiontype);//<OrderType></OrderType>
           xmlwriter_write_element ($xmlrequest,'Merchant', $this->merid);//<Merchant></Merchant>
           xmlwriter_write_element ($xmlrequest,'Amount', $this->purchaseamount);//<Amount></Amount>
           xmlwriter_write_element ($xmlrequest,'Currency', $this->currency);//<Currency></Currency>
           xmlwriter_write_element ($xmlrequest,'Description', $this->description);//<Description></Description>
           xmlwriter_write_element ($xmlrequest,'ApproveURL', $this->approveurl);//<ApproveURL></ApproveURL>
           xmlwriter_write_element ($xmlrequest,'CancelURL', $this->cancelurl);//<CancelURL></CancelURL>
           xmlwriter_write_element ($xmlrequest,'DeclineURL', $this->declineurl);//<DeclineURL></DeclineURL>
           xmlwriter_write_element ($xmlrequest,'email', $this->emailaddr);//<email></email>
           xmlwriter_write_element ($xmlrequest,'phone', $this->phone);//<phone></phone>
           xmlwriter_start_element ($xmlrequest,'AddParams');//<AddParams>
           xmlwriter_write_element ($xmlrequest,'FA-DATA', null);//<FA-DATA></FA-DATA>
           xmlwriter_write_element ($xmlrequest,'SenderPostalCode', $this->zip);//<SenderPostalCode></SenderPostalCode>
           xmlwriter_write_element ($xmlrequest,'AcctType', '');//<AcctType></AcctType>
           xmlwriter_write_element ($xmlrequest,'TranAddendums', '');//<TranAddendums></TranAddendums>
           xmlwriter_write_element ($xmlrequest,'TranAddendumsVISA', '');//<TranAddendumsVISA></TranAddendumsVISA>
           xmlwriter_write_element ($xmlrequest,'TranAddendumsMC', '');//<TranAddendumsMC></TranAddendumsMC>
           xmlwriter_write_element ($xmlrequest,'TranAddendumsAMEX', '');//<TranAddendumsAMEX></TranAddendumsAMEX>
           xmlwriter_write_element ($xmlrequest,'TranAddendumsMIR', '');//<TranAddendumsMIR></TranAddendumsMIR>
           xmlwriter_write_element ($xmlrequest,'OrderExpirationPeriod', '');//<OrderExpirationPeriod></OrderExpirationPeriod>
           xmlwriter_write_element ($xmlrequest,'OrigAmount', '');//<OrigAmount></OrigAmount>
           xmlwriter_write_element ($xmlrequest,'OrigCurrency', '');//<OrigCurrency></OrigCurrency>
           xmlwriter_end_element ($xmlrequest);  // </AddParams>
           xmlwriter_write_element ($xmlrequest,'Fee', $this->fee);//<Fee></Fee>
           xmlwriter_end_element ($xmlrequest);  //</Order>
           xmlwriter_end_element ($xmlrequest);  //</Request>
           xmlwriter_end_dtd($xmlrequest);
           $xml = xmlwriter_output_memory( $xmlrequest,true);
        */
        return $xml;
    }
    public function makeFada_line($name,$value)
    {
        $fada_line =null;
        if(is_null($value)) $fada_line = $name.'='.$value.';';
        return $fada_line;
    }
    public function makeFada_data(Order $order)
    {
        $fada_data = null;
        $fada_data .= $this->makeFada_line('ShippingCountry', $order->country );
        $fada_data .= $this->makeFada_line('ShippingCity', $order->city );
        $fada_data .= $this->makeFada_line('ShippingState', $order->region );
        $fada_data .= $this->makeFada_line('ShippingZipCode', $order->zip );
        $fada_data .= $this->makeFada_line('ShippingAddress', $order->address );
// $fada_data .= $this->makeFada_line('DeliveryPeriod', null );
        $fada_data .= $this->makeFada_line('Phone', $order->phone );
        $fada_data .= $this->makeFada_line('Email', $order->emailaddr );
        $fada_data .= $this->makeFada_line('MerchantOrderID', $order->xid );

        return $fada_data;
    }
    public function GetOrderCreateResp($xmlresponce)
    {
        $crordresp = new SimpleXMLElement($xmlresponce);
        $this->orderstatas = $crordresp->xpath('TKKPG/Response/Status')   ;
        $this->orderid = $crordresp->xpath('TKKPG/Response/Order/OrderId');
        $this->sessionid =  $crordresp->xpath('TKKPG/Response/Order/SessionID');

    }
}