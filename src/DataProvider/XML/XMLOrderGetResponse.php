<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 10:34
 */
namespace Skytech;
use SimpleXMLElement;

trait XMLOrderGetResponse
{
    public function getOrderResponseData($xmlresponse,Operation $operation)
    {
        $crordresp = new SimpleXMLElement($xmlresponse);
        $operation->order->setOperation($crordresp->xpath('TKKPG/Response/Operation'));
        $operation->order->setStatus( $crordresp->xpath('TKKPG/Response/Status'))  ;
        $operation->order->setOrderId($crordresp->xpath('TKKPG/Response/Order/OrderId'));
        $operation->order->setSessionId($crordresp->xpath('TKKPG/Response/Order/SessionID'));
        $operation->order->setUrl($crordresp->xpath('TKKPG/Response/Order/URL'));
    }
}
