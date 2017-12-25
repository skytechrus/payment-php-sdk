<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request;

/**
 * Class DataProvider
 *
 * @package Skytech\DataProvider
 */
abstract class DataProvider
{
    /**
     * @var \Skytech\Sdk\Operation\Operation
     */
    protected $operation;

    /**
     * DataProvider constructor.
     *
     * @param \Skytech\Sdk\Operation\Operation $operation
     */
    public function __construct(\Skytech\Sdk\Operation\Operation $operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return mixed
     */
    abstract public function getRequestData();
}
