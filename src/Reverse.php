<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 01.11.2017
 * Time: 16:56
 */

namespace Skytech;

use Skytech\DataProvider\DataProviderStrategy;
use Skytech\Operation\OperationType;

class Reverse
{
    /**
     * @var Operation\Operation
     */
    private $operation;

    /**
     * Reverse constructor.
     * @param Order $order
     * @param Merchant $merchant
     * @param Customer $customer
     */
    public function __construct(Order $order, Merchant $merchant, Customer $customer)
    {
        $this->operation = new Operation\Operation($order, $customer, $merchant);
    }

    /**
     * @return Response\Reverse
     * @throws \Exception
     */
    public function reverse()
    {
        $response = $this->send(OperationType::REVERSE);
        return new Response\Reverse($response);
    }
    /**
     * @param $operationType
     * @return Response\ResponseStrategy
     * @throws \Exception
     */
    private function send($operationType)
    {
        $data = $this->payload($operationType);
        $connector = new Connector($data);
        return $connector->sendRequest();
    }
    /**
     * @param $operationType
     * @return mixed
     */
    private function payload($operationType)
    {
        $data = new DataProviderStrategy($operationType, $this->operation);
        return $data->getPayload();
    }
}
