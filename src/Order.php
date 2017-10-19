<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 04.10.2017
 * Time: 15:42
 */

namespace Skytech;
use function htmlentities;

class Order
{
    public  $operation;
    /** @var int unique order id generated by TWEC PG */
    private $orderId;
    /** @var int unique order id  generated by merchant */
    private $xId;
    private $orderDate;
    private $language;
    private $amount;
    private $currency;
    private $description;
    private $operationType;
    private $orderStatus;
    private $sessionId;
    private $merchantId;
    private $fee;
    private $url;
    private $status; /** @var  int  */
    private $origAmount;
    private $origCurrency;
    private $orderExpPeriod;
    private $vendorId;

    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @param mixed $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return mixed
     */
    public function getOrderExpPeriod()
    {
        return $this->orderExpPeriod;
    }

    /**
     * @param mixed $orderExpPeriod
     */
    public function setOrderExpPeriod($orderExpPeriod)
    {
        $this->orderExpPeriod = $orderExpPeriod;
    }
    /**
     * @return int
     */
    public function getOrigAmount()
    {
        return $this->origAmount;
    }

    /**
     * @return mixed
     */
    public function getOrigCurrency()
    {
        return $this->origCurrency;
    }

    /**
     * @param int $origAmount
     */
    public function setOrigAmount($origAmount)
    {
        $this->origAmount = $origAmount;
    }

    /**
     * @param mixed $origCurrency
     */
    public function setOrigCurrency($origCurrency)
    {
        $this->origCurrency = $origCurrency;
    }
    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * @param mixed $operation
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
    }
    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @param mixed $xId
     */
    public function setXId($xId)
    {
        $this->xId = $xId;
    }

     /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
        $this->description = htmlentities( $description);
    }


    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }


    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
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
    public function getLanguage()
    {
        return $this->language;
    }
    /**
     * @return int
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getOperationType()
    {
        return $this->operationType;
    }

    /**
     * @return mixed
     */
    public function getXId()
    {
        return $this->xId;
    }

    /**
     * @param int $orderDate
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @param string $operationType
     */
    public function setOperationType($operationType)
    {
        $this->operationType = $operationType;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param mixed $orderStatus
     */
    public function setOrderStatus($orderStatus)
    {
        $this->$orderStatus = $orderStatus;
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
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param mixed $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }
    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }
}
