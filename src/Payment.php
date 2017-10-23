<?php


namespace Skytech;


use Skytech\Operation\OperationType;

class Payment
{
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

    public function purchase()
    {
        $response = $this->send(OperationType::PURCHASE);
        return new Response((string)$response->getBody());
    }

    /**
     * @param $operationType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function send($operationType)
    {
        $client = new \GuzzleHttp\Client();
        $data = $this->payload($operationType);
        $response = $client->request('POST', Config::getHost(), ['body' => $data]);
        return $response;
    }

    private function payload($operationType)
    {
        $data = new \Skytech\Data($operationType, $this->operation);
        return $data->getPayload();
    }
}
