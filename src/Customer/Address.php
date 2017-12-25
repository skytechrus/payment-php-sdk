<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Customer;

use InvalidArgumentException;
use League;
use League\ISO3166\ISO3166;
use OutOfBoundsException;
use UnexpectedValueException;
use function is_numeric;
use function preg_match;

/**
 * Class Address
 *
 * @package Skytech\Customer
 */
class Address
{
    /**
     * @var
     */
    public $addressline;
    /**
     * @var
     */
    private $country;
    /** @var  mixed */
    private $region;
    /**
     * @var
     */
    private $city;
    /**
     * @var
     */
    private $zip;

    /**
     * Address constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        if (!preg_match("/^[a-z]+[a-z\s\-]*$/i", $region)) {
            throw new UnexpectedValueException('Only latin letters can be used in region name');
        }
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        if (!is_numeric($country)) {
            throw new InvalidArgumentException('Invalid ISO country code');
        }
        // $data = (new ISO3166)->numeric((string)$country);
        $iso = (new ISO3166())->all();
        if (array_key_exists($country, $iso)) {
            throw new OutOfBoundsException('Invalid ISO country code ');
        }
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        if (!preg_match("/^[a-z]+[a-z\d\s\-]*$/i", $city)) {
            throw new UnexpectedValueException('Only latin letters can be used in city name');
        }
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        if (!is_numeric($zip)) {
            throw new InvalidArgumentException('Invalid postal index argument type');
        }
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getAddressline()
    {
        return $this->addressline;
    }

    /**
     * @param mixed $addressline
     */
    public function setAddressline($addressline)
    {
        if (!preg_match("/^[a-z]+[a-z\d\s\-\/,_.]*$/i", $addressline)) {
            throw new UnexpectedValueException('Only latin letters and numbers can be used in address line');
        }
        $this->addressline = $addressline;
    }
}
