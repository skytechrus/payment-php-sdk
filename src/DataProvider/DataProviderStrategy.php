<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Author: Sergey Ivanov.
 * Author: Elena Arevkina.
 */

namespace Skytech\DataProvider;

use Composer\Config;
use Skytech\Operation\Operation;

/**
 * Class Data
 *
 * @package Skytech
 */
class DataProviderStrategy
{
    /**
     * @var \Skytech\DataProvider\DataOperationStrategy
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
     */
    public function __construct($operationType, Operation $operation)
    {
        $this->operationType = $operationType;
        $this->operation = $operation;
        $this->dataFormat = \Skytech\Config::getDataFormat();
        $this->payload();
    }

    /**
     * @throws \Exception
     */
    private function payload()
    {
        switch ($this->dataFormat) {
            case \Skytech\Config::XML:
                $this->data = new \Skytech\DataProvider\XML\DataOperationStrategy(
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
