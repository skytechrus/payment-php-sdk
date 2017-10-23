<?php


namespace Skytech;


use Composer\Config;
use Skytech\Operation\Operation;

class Data
{
    /**
     * @var \Skytech\DataProvider\Data
     */
    private $data;
    /**
     * @var Operation
     */
    private $operation;
    private $operationType;

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
        $this->dataFormat = Config::getDataFormat();
        $this->payload();
    }

    private function payload()
    {
        switch ($this->dataFormat) {
            case Config::XMLData:
                $this->data = new \Skytech\DataProvider\XML\Data($this->operationType, $this->operation);
                break;
            default:
                throw new \Exception('Invalid format');
        }
    }

    public function getPayload()
    {
        return $this->data;
    }

}
