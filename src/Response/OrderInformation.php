<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 07.11.2017
 * Time: 14:23
 */

namespace Skytech\Sdk\Response;

/**
 * Class OrderInformation
 *
 * @package Skytech\Response
 */
class OrderInformation extends Response
{
    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->getInteger('Order/row/id');
    }

    /**
     * @return string
     */
    public function getCreateDate()
    {
        return $this->getString('Order/row/createDate');
    }

    /**
     * @return string
     */
    public function getSessionID()
    {
        return $this->getString('Order/row/SessionID');
    }

    /**
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getString('Order/row/MerchantID');
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->getInteger('Order/row/Amount');
    }

    /**
     * @return int
     */
    public function getCurrency()
    {
        return $this->getInteger('Order/row/Currency');
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->getString('Order/row/Description');
    }

    /**
     * @return string
     */
    public function getApproveURL()
    {
        return $this->getString('Order/row/ApproveURL');
    }

    /**
     * @return string
     */
    public function getCancelURL()
    {
        return $this->getString('Order/row/CancelURL');
    }

    /**
     * @return string
     */
    public function getDeclineURL()
    {
        return $this->getString('Order/row/DeclineURL');
    }

    /**
     * @return string
     */
    public function getOrderStatus()
    {
        return $this->getString('Order/row/Orderstatus');
    }

    /**
     * @return int
     */
    public function getTWOId()
    {
        return $this->getInteger('Order/row/twoId');
    }

    /**
     * @return string
     */
    public function getReceipt()
    {
        return $this->getString('Order/row/Receipt');
    }

    /**
     * @return int
     */
    public function getRefundAmount()
    {
        return $this->getInteger('Order/row/RefundAmount');
    }

    /**
     * @return int
     */
    public function getRefundCurrency()
    {
        return $this->getInteger('Order/row/RefundCurrency');
    }

    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->getString('Order/row/OrderType');
    }

    /**
     * @return int
     */
    public function getFee()
    {
        return $this->getInteger('Order/row/FEE');
    }
}
