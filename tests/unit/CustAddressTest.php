<?php


use Skytech\CustAddress;

class CustAddressTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $custAddress;

    protected function _before()
    {
        $this->custAddress =new CustAddress();
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider providerZip
     */
    public function testZip($zipcode,$expect)
    {
        if (!$expect)
        {
            $this->expectException(InvalidArgumentException::class);
            $this->custAddress->setZip($zipcode);
        }
        $this->custAddress->setZip($zipcode);
        $this->assertEquals($zipcode, $this->custAddress->getZip());
    }

    /**
     * @dataProvider providerCountry
     */
    public function testCountryCode($alfa,$country,$expect)
    {
        if ($alfa){
            $this->expectException(InvalidArgumentException::class);
            $this->custAddress->setCountry($country);
        }
        if (!$expect) {
            $this->expectException(OutOfBoundsException::class);
            $this->custAddress->setCountry($country);
        }
        $this->custAddress->setCountry($country);
        $this->assertEquals($country, $this->custAddress->getCountry());
    }

    /**
     * @dataProvider  providerCity
     */
    public function testCityName($city,$expect)
    {
        if (!$expect)
        {
            $this->expectException(UnexpectedValueException::class);
            $this->custAddress->setCity($city);
        }
        $this->custAddress->setCity($city);
        $this->assertEquals($city,$this->custAddress->getCity());
    }

    /**
     * @dataProvider  providerRegion
     */
    public function testRegion($region,$expect)
    {
        if (!$expect)
        {
            $this->expectException(UnexpectedValueException::class);
            $this->custAddress->setRegion($region);
        }
        $this->custAddress->setRegion($region);
        $this->assertEquals($region,$this->custAddress->getRegion());
    }

    /**
     * @dataProvider provideAddress
     */
    public function testAddress($addressline,$expect)
    {
        if (!$expect)
        {
            $this->expectException(UnexpectedValueException::class);
            $this->custAddress->setAddressline($addressline);
        }
        $this->custAddress->setAddressline($addressline);
        $this->assertEquals($addressline, $this->custAddress->getAddressline());
    }
    public function providerCountry()
    {
        return [
            [false,840  ,true],
            [false,643  ,true],
            [false,'810'  ,true],
            [false,3   ,false],
            [false,'93' ,false ],
            [true,'RU',false]
        ];
    }
    public function providerCity()
    {
        return [
            ['Moscow',true],
            ['389',false],
            ['Bogatie-Goriy',true],
            ['Chelaybinsk 5',true],
            ['Velikie Luky',true],
            ['Velikiy Zlatoust Uralskiy 7',true]
        ];
    }
    public function providerRegion()
    {
        return [
            ['Moscow',true],
            ['Sankt-Penerburg',true],
            ['Чебялинская обл',false],
            ['Cheliabinskaya oblast 4',false],
            ['Evreiskaya Avtonomnaya oblast',true],
            ['hу',false]
        ];
    }
    public function providerZip()
    {
        return [
            [999,true],
            ['098876',true],
            ['000-000',false],
            ['j',false]
        ];
    }
    public function provideAddress()
    {
        return [
            ['Lenina 68/4, kv 47',true],
            ['Lomonosova 12/a',true],
            ['Карла маркса 56',false],
            ['Truda 11,7-a,ofice 7.1',true],
            ['Kulibuta %',false],
            ['Truda ул',false]
        ];
    }
}