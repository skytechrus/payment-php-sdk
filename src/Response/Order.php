<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

/**
 * Class Order
 *
 * @package Skytech\Response
 */
class Order extends Response
{
    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->getInteger('OrderID');
    }

    /**
     * @return string
     */
    public function getSessionID()
    {
        return $this->getString('SessionID');
    }

    /**
     * @return string
     */
    public function getURL()
    {
        return $this->getString('URL');
    }
}
