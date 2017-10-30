<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Author: Sergey Ivanov.
 * Author: Elena Arevkina.
 */

namespace Skytech;

use function htmlentities;
use Respect\Validation\Validator as v;

/**
 * Class Order
 *
 * @package Skytech
 */
class Order
{
    /**
     * @var int unique order id generated by TWEC PG
     */
    private $orderId;
    /**
     * @var int unique order id  generated by merchant
     */
    private $xId;
    /**
     * @var \DateTime Order date
     */
    private $orderDate;
    /**
     * @var int Amount in the currency of transaction
     */
    private $amount;
    /**
     * @var int Currency code
     */
    private $currency;
    /**
     * @var string Текстовое описание заказа, которое будет отображено клинету при выполнении платежа
     */
    private $description;
    /**
     * @var string
     */
    private $orderStatus;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        if (!v::numeric()->positive()->validate($amount)) {
            throw new \InvalidArgumentException('Amount is not numeric');
        }
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set currency
     *
     * @param mixed $currency Currency code in ISO 4217 numeric-3
     */
    public function setCurrency($currency)
    {
        if (!v::numeric()->length(3, 3)->positive()->validate($currency)) {
            throw new \InvalidArgumentException('Currency not in ISO 4217 numeric-3 format');
        }
        $this->currency = (int)$currency;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = htmlentities($description);
    }

    /**
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime $orderDate
     */
    public function setOrderDate(\DateTime $orderDate)
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @param mixed $orderId
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
    }

    /**
     * @return mixed
     */
    public function getXId()
    {
        return $this->xId;
    }

    /**
     * @param mixed $xId
     */
    public function setXId($xId)
    {
        $this->xId = $xId;
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @param mixed $orderStatus
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    public function getOperationType()
    {
    }
}
