<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */


/**
 * Class CustomerTest
 */
class CustomerTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /** @var \Skytech\Customer */
    private $customer;

    /** @dataProvider dataProviderAddress
     * @param $country
     * @param $region
     * @param $city
     * @param $zip
     */
    public function testSetAddress($country, $region, $city, $zip)
    {

        /** @var \Skytech\Sdk\Customer\Address $address */
        $address = \Codeception\Util\Stub::make(\Skytech\Sdk\Customer\Address::class, [
            'getRegion' => $region,
            'getCountry' => $country,
            'getCity' => $city,
            'getZip' => $zip
        ]);
        $this->customer->setAddress($address);
    }

    /**
     * @dataProvider dataProviderPhone
     * @param $phone
     * @param $expect
     */
    public function testSetBadPhone($phone, $expect)
    {
        if (!$expect) {
            $this->expectException(InvalidArgumentException::class);
            $this->customer->setPhone($phone);
        } else {
            $this->customer->setPhone($phone);
            $this->assertEquals($phone, $this->customer->getPhone());
        }
    }

    /** @dataProvider dataProviderIp
     * @param $ip
     * @param $expect
     */
    public function testSetIp($ip, $expect)
    {
        if (!$expect) {
            $this->expectException(InvalidArgumentException::class);
            $this->assertEquals($expect, $this->customer->setIp($ip));
        }
        $this->customer->setIp($ip);
        $this->assertEquals($ip, $this->customer->getIp());
    }

    /** @dataProvider dataProviderBadEmails
     * @param $email
     */
    public function testSetWrongEmailAddress($email)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->customer->setEmail($email);
    }

    /** @dataProvider dataProviderEmails
     * @param $email
     */
    public function testSetEmailAddress($email)
    {
        $this->assertEquals($this->customer->getEmail(), $this->customer->setEmail($email));
    }

    /**
     * @return array
     */
    public function dataProviderBadEmails()
    {
        return [
            ['~t est@test.test'],
            ['~!@#!$@sdfdsf.sdf@test.test'],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderEmails()
    {
        return [
            ['test@test.ru'],
            ['test.test99@test.com'],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderAddress()
    {
        return [
            ['Russia', 'Moscow', 'Moscow', '140140']
        ];
    }

    /**
     * @return array
     */
    public function dataProviderPhone()
    {
        return [
            ['89261234567', true],
            ['8926123456a', false],
            ['+7926123456a', false],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderIp()
    {
        return [
            ['192.168.0.1', true],
            ['8926123456a', false],
            ['asgasdgdas', false]
        ];
    }

    /**
     *
     */
    protected function _before()
    {
        /** @var \Skytech\Sdk\Customer\Address $address */
        $address = \Codeception\Util\Stub::make(\Skytech\Sdk\Customer\Address::class, []);
        $this->customer = new \Skytech\Sdk\Customer($address);
    }

    protected function _after()
    {
    }
}
