<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.10.2017
 * Time: 13:21
 */

namespace Skytech;


use function is_int;
use UnexpectedValueException;

class Card
{
    private $pan;
    private $expmonth;
    private $expyear;
    private $brand;
    private $cardUID;

public function __construct()
{
}

    /**
     * @param mixed $pan
     */
    public function setPan($pan)
    {
        $this->pan = $pan;
    }

    /**
     * @return mixed
     */
    public function getPan()
    {
        return $this->pan;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string card Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @return mixed
     */
    public function getCardUID()
    {
        return $this->cardUID;
    }

    /**
     * @param mixed $cardUID
     */
    public function setCardUID($cardUID)
    {
        $this->cardUID = $cardUID;
    }
    /**
     * @param int $expmonth
     */
    public function setExpmonth($expmonth)
    {
        if ($expmonth >12 or !is_int($expmonth))
        {
            throw new UnexpectedValueException('Invalid month');
        }
        $this->expmonth = $expmonth;
    }
    public function getExpDate()
    {
        return $this->expyear.$this->expmonth;
    }
    /**
     * @return int card expiration month
     */
    public function getExpmonth()
    {
        return $this->expmonth;
    }

    /**
     * @param integer $expyear
     */
    public function setExpyear($expyear)
    {
        if (!is_int($expyear))
        {
            throw new UnexpectedValueException('Invalid card expiration year');
        }
        $this->expyear = $expyear;
    }

    /**
     * @return int card expiration year
     */
    public function getExpyear()
    {
        return $this->expyear;
    }
}