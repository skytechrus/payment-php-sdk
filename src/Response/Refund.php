<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

use Skytech\Operation\Operation;

/**
 * Class Refund
 *
 * @package Skytech\Response
 */
class Refund extends Response
{
    private $operation;

    /**
     * Refund constructor.
     *
     * @param Operation $operation
     * @internal param $amount
     * @internal param $currency
     * @internal param mixed|\Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    /**
     * @param $amount
     */
    private function setAmount($amount)
    {
    }

    private function setCurrency()
    {
    }
}
