<?php

namespace Skytech\Response;

class OrderStatus extends Response
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
