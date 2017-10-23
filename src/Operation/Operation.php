<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 11:35
 */

namespace Skytech\Operation;


use Skytech\Customer;
use Skytech\Customer\Card;
use Skytech\Merchant;
use Skytech\Order;
use Skytech\TransData;

class Operation
{
    /** @var  Order */
    public $order;
    /** @var  Card */
    public $card;
    /** @var  Customer */
    public $customer;
    /** @var  Customer */
    public $recipient;
    /** @var TransData */
    public $transaction;
    /** @var Merchant */
    public $merchant;

    /**
     * Operation constructor.
     *
     * @param Order $order
     * @param Customer|null $customer
     * @param Merchant|null $merchant
     * @param TransData|null $transaction
     * @param Card|null $card
     * @param Customer|null $recipient
     */
    public function __construct(
        Order $order,
        Customer $customer = null,
        Merchant $merchant = null,
        TransData $transaction = null,
        Card $card = null,
        Customer $recipient = null
    ) {
        $this->order = $order;
        $this->card = $card;
        $this->recipient = $recipient;
        $this->customer = $customer;
        $this->merchant = $merchant;
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
     * @param Merchant $merchant
     */
    public function setMerchant(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

}
