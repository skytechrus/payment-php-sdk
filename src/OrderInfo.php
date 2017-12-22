<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use Skytech\Response\Response;


/**
 * Class OrderInfo
 * @package Skytech
 */
class OrderInfo extends Response
{

    public function getOrderStatus()
    {
        return $this->getString('OrderStatus');
    }

    public function getOrderId()
    {
        return $this->getString('OrderID');
    }

    public function getResponseDescription()
    {
        return $this->getString('ResponseDescription');
    }

    public function getResponseCode()
    {
        return $this->getString('ResponseCode');
    }
}