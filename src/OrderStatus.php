<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 02.11.2017
 * Time: 16:51
 */

namespace Skytech;

use Skytech\Operation\OperationType;

/**
 * Class OrderStatus
 *
 * @package Skytech
 */
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
    public function perform()
    {
        $response = $this->send(OperationType::ORDERSTATUS);
        return new Response\OrderStatus($response);
    }

    /**
     * @param $operationType
     * @return Response\ResponseStrategy
     * @throws \Exception
     */
    private function send($operationType)
    {
        $data = $this->loadOrderStatus($operationType);
        $connector = new Connector($data);
        return $connector->sendRequest();
    }

    /**
     * @param $operationType
     * @return mixed
     */
    private function loadOrderStatus($operationType)
    {
        $data = new Request\DataProviderStrategy($operationType, $this->operation);
        return $data->getPayload();
    }
}
