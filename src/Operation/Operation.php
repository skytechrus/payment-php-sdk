<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Operation;

use Skytech\Customer;
use Skytech\Customer\Card;
use Skytech\Merchant;
use Skytech\Order;
use Respect\Validation\Validator as v;

/**
 * Class Operation
 *
 * @package Skytech\Operation
 */
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
    /** @var Merchant $merchant */
    public $merchant;
    private $refundAmount;
    private $refundCurrency;

    /**
     * Operation constructor.
     *
     * @param Order $order
     * @param Customer|null $customer
     * @param Merchant|null $merchant
     * @param Card|null $card
     * @param Customer|null $recipient
     */
    public function __construct(
        Order $order,
        Customer $customer = null,
        Merchant $merchant = null,
        Card $card = null,
        Customer $recipient = null
    ) {
        $this->order = $order;
        $this->card = $card;
        $this->recipient = $recipient;
        $this->customer = $customer;
        $this->merchant = $merchant;
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
     * @param Merchant $merchant
     */
    public function setMerchant(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }

    /**
     * @param $amount
     */
    public function setRefundAmount($amount)
    {
        if (!v::numeric()->positive()->validate($amount)) {
            throw new \InvalidArgumentException("Amount is not numeric");
        }
        $amount *= 100;
        $this->refundAmount = $amount;
    }

    /**
     * @param $currency
     */
    public function setRefundCurrency($currency)
    {
        if (!v::numeric()->length(3, 3)->positive()->validate($currency)) {
            throw new \InvalidArgumentException('Currency not in ISO 4217 numeric-3 format');
        }
        $this->refundCurrency = (int)$currency;
    }

    public function getRefundAmount()
    {
        return $this->refundAmount;
    }

    public function getRefundCurrency()
    {
        return $this->refundCurrency;
    }
}
