<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk;

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
