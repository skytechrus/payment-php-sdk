<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

/**
 * Class OrderStatus
 *
 * @package Skytech\Response
 */
class OrderStatus extends Response
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
    public function getOrderStatus()
    {
        return $this->getString('OrderStatus');
    }

    /**
     * Get ApprovalCodeSrc
     */
    public function getApprovalCode()
    {
        return $this->getString('ApprovalCodeScr');
    }

    /**
     * @return string
     */
    public function getReceipt()
    {
        return $this->getString('Receipt');
    }
}
