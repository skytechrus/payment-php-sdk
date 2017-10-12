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

  public function __construct(Order $order,TransData $transaction,Customer $customer=null,Card $card=null,Customer $recipient=null,URL_Settings $url_Settings)
  {
      $this->order = $order;
      $this->card = $card;
      $this->recipient = $recipient;
      $this->customer = $customer;
      $this->url_settings = $url_Settings;
      $this->transaction= $transaction;
  }
}