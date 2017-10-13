<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 11:35
 */

namespace Skytech;


class Operation
{
  public $order; /** @var  Order */
  public $card;  /** @var  Card */
  public $customer; /** @var  Customer */
  public $recipient; /** @var  Customer */
  public $transaction; /** @var TransData */
  public $url_settings; /** @var URL_Settings */
    /**
     * @param Order $order
     * @param TransData $transaction
     * @param Customer|null $customer
     * @param Card|null $card
     * @param Customer|null $recipient
     * @param URL_Settings|null $url_Settings
     */
  public function __construct(Order $order,TransData $transaction =null,Customer $customer=null,Card $card=null,Customer $recipient=null,URL_Settings $url_Settings = null)
  {
      $this->order = $order;
      $this->card = $card;
      $this->recipient = $recipient;
      $this->customer = $customer;
      $this->url_settings = $url_Settings;
      $this->transaction = $transaction;
  }

    /**
     * @param Card $card
     */
    public function setCard(Card $card)
    {
        $this->card = $card;
    }

    /**
     * @param Order $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param Customer $recipient
     */
    public function setRecipient(Customer $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @param TransData $transaction
     */
    public function setTransaction(TransData $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * @param URL_Settings $url_settings
     */
    public function setUrlSettings(URL_Settings $url_settings)
    {
        $this->url_settings = $url_settings;
    }


    public function CreateOrderOnPurchase(Operation $operation, $hostname, $port)
    {
        $operation->order->setOperationtype('Purchase');
        $orderdata = new XMLDataOrderPurch($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateOrderOnP2P(Operation $operation, $hostname, $port)
    {
        $operation->order->setOperationtype('P2PTransfer');
        $orderdata = new XMLDataOrderp2p($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateOrderOn3DS (Operation $operation, $hostname, $port)
    {
        $operation->order->setOperationtype('P2PTransfer');
        $orderdata = new XMLDataOrder3DS($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateOrderOnGetStatus (Operation $operation, $hostname, $port)
    {
        $orderdata = new XMLDataOrderGetStatus($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateOrderOnPreAuth (Operation $operation, $hostname, $port)
    {
        $orderdata = new XMLDataOrderPreAuth($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateOrderOnPayment (Operation $operation, $hostname, $port)
    {
        $orderdata = new XMLDataOrderPayment($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateOrderOnQuasiCash (Operation $operation, $hostname, $port)
    {
        $orderdata = new XMLDataOrderQuasiCash($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreatePurchase (Operation $operation, $hostname, $port)
    {
        $orderdata = new XMLDataPurchase($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateRefund(Operation $operation, $hostname, $port)
    {
        $orderdata = new XMLDataRefund($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }
    public function CreateReverse(Operation $operation, $hostname, $port)
    {
        $orderdata = new XMLDataReverse($operation);
        $connector = new Connector($orderdata,$hostname,$port);
        $response = $connector->send_request();
        $operation = $connector->process_response($response);//!!!!!!!!!!!!!!!!
        return $operation;
    }

}