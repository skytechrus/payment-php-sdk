<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Response;

use Skytech\Sdk\Operation\Operation;

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
