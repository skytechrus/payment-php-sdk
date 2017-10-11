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
    public $firstname;
    public $lastname;
    public $middlename;
    private $emailaddr;
    public $phone;
    public $address;
    private $ip;
    public function __construct(CustAddress $address)
    {
        $this->address = $address;
    }
    /**
     * @param mixed $address
     */
    public function setAddress(CustAddress $address)
    {
        $this->address = htmlentities( $address);
    }
    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmailaddr()
    {
        return $this->emailaddr;
    }

    /**
     * @param mixed $emailaddr
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