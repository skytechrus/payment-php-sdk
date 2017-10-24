<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 24.10.2017
 * Time: 16:24
 */

namespace Skytech\Response;


class ResponseOrderStatus extends Response
{
    public function getOrderId()
    {
        return $this->getInteger('OrderID');
    }

    public function getOrderStatus()
    {
        return $this->getString('OrderStatus');
    }

    public function getReceipt()
    {
        return $this->getString('Receipt');
    }
}