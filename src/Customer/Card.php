<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.10.2017
 * Time: 13:21
 */

namespace Skytech\Customer;

use InvalidArgumentException;
use function is_numeric;
use LengthException;
use function strlen;
use UnexpectedValueException;

class Card
{
    /**
     * @var string
     */
    private $pan;
    /**
     * @var mixed
     */
    private $expMonth;
    /** @var  mixed */
    private $expYear;
    /** @var  string */
    private $brand;
    /** @var  string */
    private $cardUID;

    public function __construct()
    {
    }

    /**
     * @return string
     */
    public function getPan()
    {
        return $this->pan;
    }

    /**
     * @param string $pan
     */
    public function setPan($pan)
    {
        $this->pan = $pan;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
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
     * @return string
     */
    public function getExpDate()
    {
        return $this->expYear . $this->expMonth;
    }

    /**
     * @return string
     */
    public function getExpMonth()
    {
        return $this->expMonth;
    }

    /**
     * @param string $expMonth
     */
    public function setExpMonth($expMonth)
    {
        if (!is_numeric($expMonth)) {
            throw new InvalidArgumentException('Invalid month');
        }
        if ($expMonth > 12 or $expMonth == 0) {
            throw new UnexpectedValueException('Invalid month');
        }
        $this->expMonth = $expMonth;
    }

    /**
     * @return string
     */
    public function getExpYear()
    {
        return $this->expYear;
    }

    /**
     * @param mixed $expYear
     */
    public function setExpYear($expYear)
    {
        if (!is_numeric($expYear)) {
            throw new InvalidArgumentException('Invalid card expiration year');
        }
        if ($expYear < date("Y") or $expYear > (date("Y") + 10)) {
            throw new UnexpectedValueException('Invalid card expiration year');
        }

        $this->expYear = $expYear;
    }

    /**
     * @param string $pan
     * @return bool
     */
    public function validatePan($pan)
    {
        if (strlen($pan) < 16 or strlen($pan) > 19) {
            throw new LengthException('Invalid pan length');
        }
        if (!is_numeric($pan)) {
            throw new InvalidArgumentException('Invalid type');
        }
        return true;
    }
}
