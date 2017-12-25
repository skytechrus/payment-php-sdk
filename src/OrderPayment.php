<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 22.12.2017
 * Time: 12:51
 */

namespace Skytech;

/**
 * Class OrderExt
 * @package Skytech
 */
class OrderPayment extends Order
{
    /**
     * @var mixed
     */
    private $vendorId;
    /**
     * @var array
     */
    private $paymentParams;

    /**
     * @return mixed
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }

    /**
     * @param $vendorId
     */
    public function setVendorId($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return array
     */
    public function getPaymentParams()
    {
        return $this->paymentParams;
    }

    /**
     * @param $paymentParams
     */
    public function setPaymentParams($paymentParams)
    {
        $this->paymentParams = $paymentParams;
    }
}
