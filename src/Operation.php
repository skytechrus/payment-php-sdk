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
     * @param URL_Settings $url_Settings
     * @param Customer $customer
     * @param string $hostname
     * @param int $port
     */
 /*   public function CreateOrderOnPurchase(URL_Settings $url_Settings,Customer $customer, $hostname, $port)
  {
      $this->url_settings = $url_Settings;
      $this->customer  = $customer;
      $orderdata = new XMLDataOrderPurch($this);
      $connector = new Connector($orderdata,$hostname,$port);
      $response = $connector->send_request();
      $connector->process_response($response);//!!!!!!!!!!!!!!!!

  }*/


}