<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk;

use Skytech\Sdk\Response\Response;

/**
 * Class OrderInfo
 * @package Skytech
 */
class OrderInfo extends Response
{

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->getString('OrderStatus');
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->getString('OrderID');
    }

    /**
     * @return string
     */
    public function getResponseDescription()
    {
        return $this->getString('ResponseDescription');
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->getString('ResponseCode');
    }
}
