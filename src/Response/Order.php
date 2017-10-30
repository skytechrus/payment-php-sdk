<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

class Order extends Response
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
