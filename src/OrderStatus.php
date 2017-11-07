<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 02.11.2017
 * Time: 16:51
 */

namespace Skytech;

use Skytech\Operation\OperationType;

class OrderStatus
{
    /**
     * @var Operation\Operation
     */
    private $operation;

    /**
     * OrderStatus constructor.
     * @param Order $order
     * @param Merchant $merchant
     * @param Customer $customer
     */
    public function __construct(Order $order, Merchant $merchant, Customer $customer)
    {
        $this->operation = new Operation\Operation($order, $customer, $merchant);
    }

    /**
     * @return Response\OrderStatus
     * @throws \Exception
     */
    public function getOrderStatus()
    {
        $response = $this->send(OperationType::ORDERSTATUS);
        return new Response\OrderStatus($response);
    }

    /**
     * @param $operationType
     * @return Response\ResponseStrategy
     * @throws \Exception
     */
    public function send($operationType)
    {
        $data = $this->orderStatusLoad($operationType);
        $connector = new Connector($data);
        return $connector->sendRequest();
    }

    /**
     * @param $operationType
     * @return mixed
     */
    public function orderStatusLoad($operationType)
    {
        $data = new DataProvider\DataProviderStrategy($operationType, $this->operation);
        return $data->getPayload();
    }
}
