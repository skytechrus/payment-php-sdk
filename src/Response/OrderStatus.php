<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 24.10.2017
 * Time: 16:24
 */

namespace Skytech\Response;

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
     * @return string
     */
    public function getReceipt()
    {
        return $this->getString('Receipt');
    }
}
