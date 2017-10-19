<?php


use Skytech\CustAddress;
use Skytech\Customer;
use Skytech\Operation;
use Skytech\Order;

class XML_FADA_DataTest extends \Codeception\Test\Unit
{
    use Skytech\XML_FADA_Data;
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $operation;


    protected function _before()
    {
        $order = new Order();
        $cusaddress = new CustAddress();
        $customer = new Customer($cusaddress);
        $this->operation = new Operation($order);
        $this->operation->setCustomer($customer);

    }

    protected function _after()
    {
    }

    /**
     * @dataProvider providerFADAData
     * @param $zip
     * @param $country
     * @param $region
     * @param $city
     * @param $addressline
     * @param $phone
     * @param $mail
     */
    public function testFada($zip,$country,$region,$city,$addressline,$phone,$mail,$tranid,$expect_fada)
    {
        if (!empty($zip))
        {
            $this->operation->customer->address->setZip($zip);
        }
        if (!empty($country))
        {
            $this->operation->customer->address->setCountry($country) ;
        }
        if (!empty($region))
        {
            $this->operation->customer->address->setRegion($region);
        }
        if (!empty($city))
        {
            $this->operation->customer->address->setCity($city)  ;
        }
        if (!empty($addressline))
        {
            $this->operation->customer->address->addressline = $addressline;
        }
        if (!empty($phone))
        {
            $this->operation->customer->setPhone($phone)  ;
        }
        if (!empty($mail))
        {
            $this->operation->customer->setEmailaddr($mail);
        }
        if (!empty($tranid))
        {
            $this->operation->order->setXid($tranid);
        }
        $fada_line = $this->makeFada_data($this->operation);

        $this->assertEquals($expect_fada,$fada_line);

    }
    public function providerFADAData()
    {
        return [
            [null,null,null,null,null,'89261234567','an@mail.ru',null,'Email=an@mail.ru; Phone=89261234567'],
            [null,null,null,null,null,'89261234567','an@mail.ru',8474,'Email=an@mail.ru; Phone=89261234567; MerchantOrderID=8474'],
            [123456,643,'Moscow','Moscow','Lenina 47','89261234567','an@mail.ru',null,
                'ShippingZipCode=123456; ShippingCountry=643; ShippingState=MOSCOW; ShippingCity=MOSCOW; ShippingAddress=Lenina 47; Email=an@mail.ru; Phone=89261234567']
        ];
    }
}