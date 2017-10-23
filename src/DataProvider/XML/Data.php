<?php


namespace Skytech\DataProvider\XML;


use Skytech\DataProvider;
use Skytech\Operation\Operation;
use Skytech\Operation\OperationType;
use Skytech\XMLDataOrderPurch;

class Data extends \Skytech\DataProvider\Data
{
    /**
     * Data constructor.
     *
     * @param OperationType $operationType
     * @param Operation $operation
     */
    public function __construct(OperationType $operationType, Operation $operation)
    {
        return $this->loadDataProvider($operationType, $operation);
    }

    /**
     * @param $operationType
     * @param Operation $operation
     * @return null|DataProvider
     */
    protected function loadDataProvider($operationType, Operation $operation)
    {
        $dataProvider = null;
        switch ($operationType) {
            case OperationType::PURCHASE:
                $dataProvider = new XMLDataOrderPurch($operation);
        }
        return $dataProvider;
    }

}
