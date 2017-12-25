<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request;

use Skytech\Sdk\Config\Config;
use Skytech\Sdk\Operation\Operation;

/**
 * Class Data
 *
 * @package Skytech
 */
class DataProviderStrategy
{
    /**
     * @var \Skytech\Request\DataOperationStrategy
     */
    private $data;
    /**
     * @var Operation
     */
    private $operation;
    /**
     * @var
     */
    private $operationType;
    private $dataFormat;

    /**
     * Data constructor.
     *
     * @param $operationType
     * @param Operation $operation
     * @throws \Exception
     */
    public function __construct($operationType, Operation $operation)
    {
        $this->operationType = $operationType;
        $this->operation = $operation;
        $this->dataFormat = Config::getDataFormat();
        $this->payload();
    }

    /**
     * @throws \Exception
     */
    private function payload()
    {
        switch ($this->dataFormat) {
            case Config::XML:
                $this->data = new \Skytech\Sdk\Request\XML\DataOperationStrategy(
                    $this->operationType,
                    $this->operation
                );
                break;
            default:
                throw new \Exception('Invalid format');
        }
    }

    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->data->getRequestPayload();
    }
}
