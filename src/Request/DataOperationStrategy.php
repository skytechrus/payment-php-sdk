<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request;

use Skytech\Sdk\Operation\Operation;

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
