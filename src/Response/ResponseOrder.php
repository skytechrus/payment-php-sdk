<?php

namespace Skytech\Response;


class ResponseOrder extends Response
{
    public function getOrderId()
    {
        return $this->getInteger('OrderID');
    }

    public function getSessionID()
    {
        return $this->getString('SessionID');
    }

    public function getURL()
    {
        return $this->getString('URL');
    }
}