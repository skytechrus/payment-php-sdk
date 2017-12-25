<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request\XML;

use Skytech\Sdk\Operation\Operation;
use Skytech\Sdk\Operation\OperationType;
use Skytech\Sdk\Request;

/**
 * Class Data
 *
 * @package Skytech\DataProvider\XML
 */
class DataOperationStrategy extends Request\DataOperationStrategy
{
    /**
     * @var Request\DataProvider
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
     * @return \Skytech\Request\DataProvider
     */
    protected function loadOperationProvider($operationType, Operation $operation)
    {
        $dataProvider = null;
        switch ($operationType) {
            case OperationType::PURCHASE:
                $dataProvider = new Purchase($operation);
                break;
            case OperationType::REVERSE:
                $dataProvider = new Reverse($operation);
                break;
            case OperationType::ORDERSTATUS:
                $dataProvider = new OrderStatus($operation);
                break;
            case OperationType::ORDER_INFORMATION:
                $dataProvider = new OrderInformation($operation);
                break;
            case OperationType::REFUND:
                $dataProvider = new Refund($operation);
                break;
            case OperationType::ORDER_PREAUTHORISATION:
                $dataProvider = new OrderPreAuthorization($operation);
                break;
            case OperationType::COMPLETION:
                $dataProvider = new Completion($operation);
                break;
            case OperationType::PAYMENT:
                $dataProvider = new Payment($operation);
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
