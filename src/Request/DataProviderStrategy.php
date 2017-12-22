<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Request;

 use Skytech\Operation\Operation;
 use Skytech\Config\Config;

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
                $this->data = new \Skytech\Request\XML\DataOperationStrategy(
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
