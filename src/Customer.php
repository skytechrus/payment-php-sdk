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

class Customer
{
    public $firstname; /** @var  string */
    public $lastname;  /** @var  string */
    public $middlename; /** @var  string */
    private $emailaddr; /** @var  string */
    public $phone;  /** @var string */
    public $address; /** @var  CustAddress */
    private $ip; /** @var string */
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
        $this->address = htmlentities( $address);
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
     */
    public function setEmailaddr($emailaddr)
    {
        if (!filter_var($emailaddr, FILTER_VALIDATE_EMAIL))
        {
            throw new UnexpectedValueException('Invalid email address');
        }
        $this->emailaddr = $emailaddr;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }
}