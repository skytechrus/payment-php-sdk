<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Author: Sergey Ivanov.
 * Author: Elena Arevkina.
 */

namespace Skytech\DataProvider;

use Skytech\Operation\Operation;

/**
 * Class Data
 *
 * @package Skytech\DataProvider
 */
abstract class DataOperationStrategy
{
    abstract public function getRequestPayload();

    /**
     * @param $operationType
     * @param Operation $operation
     * @return mixed
     */
    abstract protected function loadOperationProvider($operationType, Operation $operation);
}
