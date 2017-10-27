<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Author: Sergey Ivanov.
 * Author: Elena Arevkina.
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
     * @return mixed
     */
    abstract public function getRequestData();
}
