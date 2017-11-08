<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider;

/**
 * Class DataProvider
 *
 * @package Skytech\DataProvider
 */
abstract class DataProvider
{
    /**
     * @var \Skytech\Operation\Operation
     */
    protected $operation;

    /**
     * DataProvider constructor.
     *
     * @param \Skytech\Operation\Operation $operation
     */
    public function __construct(\Skytech\Operation\Operation $operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return mixed
     */
    abstract public function getRequestData();
}
