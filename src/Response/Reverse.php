<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 01.11.2017
 * Time: 17:07
 */

namespace Skytech\Response;

/**
 * Class Reverse
 * @package Skytech\Response
 */
class Reverse extends Response
{
    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->getInteger('OrderID');
    }

    /**
     * @return int
     */
    public function getRespCode()
    {
        return $this->getInteger('RespCode');
    }

    /**
     * @return string
     */
    public function getRespMessage()
    {
        return $this->getString('RespMessage');
    }
}
