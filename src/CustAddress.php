<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.10.2017
 * Time: 13:00
 */

namespace Skytech;


use InvalidArgumentException;
use function is_numeric;
use League\ISO3166\ISO3166;
use OutOfBoundsException;
use function preg_match;
use UnexpectedValueException;
use League;


class CustAddress
{
    private $country; /** @var  mixed */
    private $region;
    private $city;
    public $addressline;
    private $zip;

    public function __construct()
    {
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region)
    {
        if (!preg_match("/^[a-z]+[a-z\s\-]*$/i",$region ))
        {
            throw new UnexpectedValueException('Only latin letters can be used in region name');
        }
        $this->region = $region;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
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
        if(!is_numeric($country) )
        {
            throw new InvalidArgumentException('Invalid ISO country code');
        }
       // $data = (new ISO3166)->numeric((string)$country);
        $iso = (new ISO3166())->all() ;
         if ( array_key_exists($country,$iso ))
        {
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
        if (!preg_match("/^[a-z]+[a-z\d\s\-]*$/i",$city))   //(!preg_match("/^[a-z0-9\s\-]*[a-z]{1}$/i",$city ))
        {
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
     * @param mixed $addressline
     */
    public function setAddressline($addressline)
    {
        echo $addressline.' '.preg_match("/^[a-z]+[a-z\d\s\-\/]*$/i",$addressline)."\n";
        echo preg_match("/^[a-z]+[a-z0-9\s\-\/,_]*$/i",$addressline)."\n";
        if (!preg_match("/^[a-z]+[a-z\d\s\-\/,_.]*$/i",$addressline))   //(!preg_match("/^[a-z0-9\s\-]*[a-z]{1}$/i",$city ))
        {
            throw new UnexpectedValueException('Only latin letters and numbers can be used in address line');
        }
        $this->addressline = $addressline;
    }

    /**
     * @return mixed
     */
    public function getAddressline()
    {
        return $this->addressline;
    }
    /**
     * @param mixed $zip
     */
    public function setZip($zip)
    {
        if(!is_numeric($zip) )
        {
            throw new InvalidArgumentException('Invalid postal index argument type');
        }
        $this->zip = $zip;
    }

}