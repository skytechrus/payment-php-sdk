<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use Skytech\Customer\Address;

/**
 * Class Customer
 * @package Skytech
 */
class Customer
{
    /**
     * @var string
     */
    public $firstName;
    /**
     * @var string
     */
    public $lastName;
    /**
     * @var string
     */
    public $middleName;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var Address
     */
    public $address;
    /**
     * @var string
     */
    private $ip;
    /**
     * @var string
     */
    private $sessionId;

    /**
     * Customer constructor.
     *
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        if (!$this->validatePhone($phone)) {
            throw new \InvalidArgumentException('Invalid phone number: ' . $phone);
        }
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @covers Customer::setEmail()
     */
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }
        $this->email = $email;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        if (!$this->validateIp($ip)) {
            throw new \InvalidArgumentException('Invalid ip address');
        }
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param $ip
     * @return bool
     */
    private function validateIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        }
        return false;
    }

    /**
     * @param $phone
     * @return int
     */
    private function validatePhone($phone)
    {
        return preg_match('/^((\+7|7|8)+([0-9]){10})$/', $phone);
    }
}
