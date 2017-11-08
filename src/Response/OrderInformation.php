<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 07.11.2017
 * Time: 14:23
 */

namespace Skytech\Response;

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
    public function getCreateDate()
    {
        return $this->getString('Order/row/createDate');
    }
    public function getSessionID()
    {
        return $this->getString('Order/row/SessionID');
    }
    public function getMerchantId()
    {
        return $this->getString('Order/row/MerchantID');
    }
    public function getAmount()
    {
        return $this->getInteger('Order/row/Amount');
    }
    public function getCurrency()
    {
        return $this->getInteger('Order/row/Currency');
    }
    public function getDescription()
    {
        return $this->getString('Order/row/Description');
    }
    public function getApproveURL()
    {
        return $this->getString('Order/row/ApproveURL');
    }
    public function getCancelURL()
    {
        return $this->getString('Order/row/CancelURL');
    }
    public function getDeclineURL()
    {
        return $this->getString('Order/row/DeclineURL');
    }
    public function getOrderStatus()
    {
        return $this->getString('Order/row/Orderstatus');
    }
    public function getTWOId()
    {
        return $this->getInteger('Order/row/twoId');
    }
    public function getReceipt()
    {
        return $this->getString('Order/row/Receipt');
    }
    public function getRefundAmount()
    {
        return $this->getInteger('Order/row/RefundAmount');
    }
    public function getRefundCurrency()
    {
        return $this->getInteger('Order/row/RefundCurrency');
    }
    public function getOrderType()
    {
        return $this->getString('Order/row/OrderType');
    }
    public function getFee()
    {
        return $this->getInteger('Order/row/FEE');
    }
}
