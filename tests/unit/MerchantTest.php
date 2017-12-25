<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Merchant;

/**
 * Class MerchantTest
 */
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

    /**
     * @return array
     */
    public function dataProviderLng()
    {
        return [[true, 'ru'],
            [false, 'USA'],
            [false, 810],
            [true, 'en'],
            [true, 'ru'],
            [true, 'uk']];
    }

    /**
     * @return array
     */
    public function dataProviderURL()
    {
        return[
            [true,'http://123.445.33.4:423'],
            [true,'http://php.net/manual/ru/function.stristr.php'],
            [true,'http://example.com']];
    }

    protected function _before()
    {
        $this->merchant = new Merchant();
    }

    protected function _after()
    {
    }
}
