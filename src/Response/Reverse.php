<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 01.11.2017
 * Time: 17:07
 */

namespace Skytech\Response;

class Reverse extends Response
{
    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->getInteger('OrderID');
    }
    public function getRespCode()
    {
        return $this->getInteger('RespCode');
    }
    public function getRespMessage()
    {
        return $this->getString('RespMessage');
    }
}
