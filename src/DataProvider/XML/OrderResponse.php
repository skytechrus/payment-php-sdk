<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use SimpleXMLElement;

trait OrderResponse
{
    public function getOrderResponseData($xmlresponse,Operation $operation)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $operation->order->setOperation($crordresp->xpath("//Operation")[0]);
        $operation->order->setStatus( $crordresp->xpath("//Status")[0] );
        if (!empty($crordresp->xpath("//Order/OrderID")[0])) {
            $operation->order->setOrderid($crordresp->xpath("//Order/OrderID")[0]);
        }
        if (!empty($crordresp->xpath("//Order/SessionID")[0]))
        {
            $operation->order->setSessionid( $crordresp->xpath("//Order/SessionID")[0] );
        }
        if (!empty($crordresp->xpath("//Order/URL")[0]))
        {
            $operation->order->setUrl($crordresp->xpath("//Order/URL")[0]);
        }
    }
}
