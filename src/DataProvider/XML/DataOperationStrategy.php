<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use Skytech\DataProvider;
use Skytech\Operation\Operation;
use Skytech\Operation\OperationType;

/**
 * Class Data
 *
 * @package Skytech\DataProvider\XML
 */
class DataOperationStrategy extends DataProvider\DataOperationStrategy
{
    /**
     * @var DataProvider\DataProvider
     */
    private $dataProvider;

    /**
     * Data constructor.
     *
     * @param OperationType $operationType
     * @param Operation $operation
     */
    public function __construct($operationType, Operation $operation)
    {
        $this->dataProvider = $this->loadOperationProvider($operationType, $operation);
    }

    /**
     * @param $operationType
     * @param Operation $operation
     * @return \Skytech\DataProvider\DataProvider
     */
    protected function loadOperationProvider($operationType, Operation $operation)
    {
        $dataProvider = null;
        switch ($operationType) {
            case OperationType::PURCHASE:
                $dataProvider = new OrderPurchase($operation);
                break;
            default:
                throw new \InvalidArgumentException("Unknown operation type");
        }
        return $dataProvider;
    }

    /**
     * @return mixed
     */
    public function getRequestPayload()
    {
        return $this->dataProvider->getRequestData();
    }
}
