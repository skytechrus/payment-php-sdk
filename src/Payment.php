<?php


namespace Skytech;


use Skytech\Operation\OperationType;

/**
 * Class Payment
 *
 * @package Skytech
 */
class Payment
{
    /**
     * @var Operation\Operation
     */
    private $operation;

    /**
     * Payment constructor.
     *
     * @param $order
     * @param $merchant
     * @param $customer
     */
    public function __construct(Order $order, Merchant $merchant, Customer $customer)
    {
        $this->operation = new Operation\Operation($order, $customer, $merchant);
    }

    /**
     * @return Response
     */
    public function purchase()
    {
        $response = $this->send(OperationType::PURCHASE);
//        return new Response((string)$response->getBody());
//        return $response->getBody();
        return $response;
    }

    /**
     * @param $operationType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function send($operationType)
    {
        $client = new \GuzzleHttp\Client();
        $data = $this->payload($operationType);
//        $response = $client->request('POST', Config::getHost(), ['body' => $data]);
//        return $response;
        return $data;
    }

    /**
     * @param $operationType
     * @return mixed
     */
    private function payload($operationType)
    {
        $data = new \Skytech\DataProvider\DataProviderStrategy($operationType, $this->operation);
        return $data->getPayload();
    }
}
