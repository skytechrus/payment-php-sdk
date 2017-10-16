<?php


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

        /** @var \Skytech\CustAddress $address */
        $address = \Codeception\Util\Stub::make(\Skytech\CustAddress::class, [
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
        $this->customer->setEmailaddr($email);
    }

    /** @dataProvider dataProviderEmails
     * @param $email
     */
    public function testSetEmailAddress($email)
    {
        $this->assertEquals($this->customer->getEmailaddr(), $this->customer->setEmailaddr($email));
    }

    public function dataProviderBadEmails()
    {
        return [
            ['~t est@test.test'],
            ['~!@#!$@sdfdsf.sdf@test.test'],
        ];
    }

    public function dataProviderEmails()
    {
        return [
            ['test@test.ru'],
            ['test.test99@test.com'],
        ];
    }

    public function dataProviderAddress()
    {
        return [
            ['Russia', 'Moscow', 'Moscow', '140140']
        ];
    }

    public function dataProviderPhone()
    {
        return [
            ['89261234567', true],
            ['8926123456a', false],
            ['+7926123456a', false],
        ];
    }

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
        /** @var \Skytech\CustAddress $address */
        $address = \Codeception\Util\Stub::make(\Skytech\CustAddress::class, []);
        $this->customer = new \Skytech\Customer($address);
    }

    protected function _after()
    {
    }
}