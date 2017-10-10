<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 03.10.2017
 * Time: 12:50
 */

namespace Skytech;
use SimpleXMLElement;
use XMLWriter;

include 'example.php';
include 'order.php';


class Purchase
{
    private $operation;
    private $merid; /** Merchant Id */
    private $merchanttranid; /** @var unique transaction id generated TWEC PG   */
    private $version; /** Version No */
    private $status_code;
    private $status_Description;
    private $orderid;
    private $sessionId;
    private $language; /** Interface language (EN, RU, UK, ..) */
    private $transdatetime;
    private $visualamount;  /**   Operation amount for customer*/
    private $purchaseamount; /** Operation amount*/
    private $currency;   /** Operation currency (840, 810 )*/
    private $description; /** Operation desciption */
    private $customerid;  /** */
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
    private $brand;
    private $name;
    private $threedsstatus;
    //
    private $pan;
    private $expmonth;
    private $expyear;
    private $fee;
    private $transactiontype;
    private $aprovalcode;
    private $approvalcodestr;
    private $threedsverification;
    private $rezultoperation;
    private $responcecode;
    private $responcedescription;
    private $responce;
    private $acqfee;
    private $responce_f; /** @var mixed prepaid code */
    private $xid; /** @var  unique trans id generated by merchant */
    private $calculatedcavv;
    private $rrn;
    private $rrn2;
    private $hexcavv;
    //
    private $declineurl;
    private $cancelurl;
    private $approveurl;
    /**
     * Purchase constructor.
     */
    public function __construct(Order $order)
    {
        $this->language = $order->getLanguage();
        $this->orderid = $order->getOrderid();
        $this->transdatetime = $order->getOrderdate();
        //$this->brand = $order->getbrand;
        $this->purchaseamount = $order->getAmount();
        $this->description = $order->getDescription();
        $this->currency = $order->getCurrency();
        $this->transactiontype = $order->getOperationtype();
        $this->xid = $order->getXid();
        $this->merid = $order->getMerchantid();
        $this->fee = $order->getFee();
    }

    /**
     * @param mixed $operation
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
    }
    public function SetStatus($stat)
    {
        $this->status_code = $stat;
    }
    public function SetMerchantId($merchantId)
    {
        $this->merid = $merchantId;
    }

    /**
     * @return mixed
     */
    public function getPan()
    {
        return $this->pan;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @param mixed $pan
     */
    public function setPan($pan)
    {
        $this->pan = $pan;
    }

    /**
     * @param mixed $hexcavv
     */
    public function setHexcavv($hexcavv)
    {
        $this->hexcavv = $hexcavv;
    }
    /**
     * @param mixed $expyear
     */
    public function setExpyear($expyear)
    {
        $this->expyear = $expyear;
    }

    /**
     * @param mixed $expmonth
     */
    public function setExpmonth($expmonth)
    {
        $this->expmonth = $expmonth;
    }
    /**
     * @param mixed $declineurl
     */
    public function setDeclineurl($declineurl)
    {
        $this->declineurl = $declineurl;
    }

    /**
     * @param mixed $cancelurl
     */
    public function setCancelurl($cancelurl)
    {
        $this->cancelurl = $cancelurl;
    }

    /**
     * @param mixed $approveurl
     */
    public function setApproveurl($approveurl)
    {
        $this->approveurl = $approveurl;
    }
    public function GetAuthorisationData($xmlresponce)
    {
        $authresp = new SimpleXMLElement($xmlresponce);
        $this->responcecode = $authresp->xpath('Message/ResponseCode') ;
        $this->responcedescription = $authresp->xpath('Message/ResponseDescription');
        $this->approvalcode = $authresp->xpath('Message/ApprovalCode');
        $this->approvalcodestr = $authresp->xpath('Message/ApprovalCodeScr');
        $this->status_code = $authresp->xpath('Message/OrderStatus');
        $this->status_Description = $authresp->xpath('Message/OrderStatusScr');
        $this->threedsverification = $authresp->xpath('Message/ThreeDSVerificaion');
        $this->threedsstatus = $authresp->xpath('Message/ThreeDSStatus');
        $this->fee = $authresp->xpath('Message/Fee');
        $this->acqfee = $authresp->xpath('Message/AcqFee');
        $this->merchanttranid = $authresp->xpath('Message/MerchantTranID');
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        echo "__set, property - {$name} is not exists \n";
    }
    public function __get($name)
    {
        // TODO: Implement __get() method.
        echo "__get, property - {$name} is not exists \n";
    }

}

