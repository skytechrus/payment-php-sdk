<?php

use Skytech\Merchant;

class MerchantTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var Merchant
     */
    protected $merchant;


    /**
     * @dataProvider dataProviderLng
     * @param  $expect
     * @param $lng
     */
    public function testLanguage($expect, $lng)
    {
        if (!$expect) {
            $this->expectException(InvalidArgumentException::class);
            $this->merchant->setLanguage($lng);
        }
        $this->merchant->setLanguage($lng);
        $this->assertEquals($lng, $this->merchant->getLanguage());
    }

    /**
     * @dataProvider dataProviderURL
     * @param $expect
     * @param $url
     */
    public function testUrl($expect, $url)
    {
        if ($expect) {
            $this->assertTrue($this->merchant->validateURL($url));
        } else {
            $this->assertFalse($this->merchant->validateURL($url));
        }
    }

    public function dataProviderLng()
    {
        return [[false, 'ru'],
            [false, 'USA'],
            [false, 810],
            [true, 'EN'],
            [true, 'RU'],
            [true, 'UK']];
    }

    public function dataProviderURL()
    {
        return[
            [true,'123.445.33.4:423'],
            [true,'http://php.net/manual/ru/function.stristr.php'],
            [true,'you-will-pay-for-this.html']];
    }

    protected function _before()
    {
        $this->merchant = new Merchant();
    }

    protected function _after()
    {
    }
}
