<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.10.2017
 * Time: 12:50
 */

namespace Skytech;


use function filter_var;
use function htmlentities;
use UnexpectedValueException;

/**
 * Class Customer
 * @package Skytech
 */
class Customer
{
    /**
     * @var string
     */
    public $firstname;
    /**
     * @var string
     */
    public $lastname;
    /**
     * @var string
     */
    public $middlename;
    /**
     * @var string
     */
    private $emailaddr;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var CustAddress
     */
    public $address;
    /**
     * @var string
     */
    private $ip;
    /**
     * Customer constructor.
     * @param CustAddress $address
     */
    public function __construct(CustAddress $address)
    {
        $this->address = $address;
    }

    /**
     * @param CustAddress $address
     */
    public function setAddress(CustAddress $address)
    {
        $this->address = $address;
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
    public function getEmailaddr()
    {
        return $this->emailaddr;
    }

    /**
     * @param string $emailaddr
     * @covers Customer::setEmailaddr()
     */
    public function setEmailaddr($emailaddr)
    {
        if (!filter_var($emailaddr, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address');
        }
        $this->emailaddr = $emailaddr;
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