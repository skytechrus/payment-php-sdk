<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

//use Skytech\Sdk\Card;

use Skytech\Sdk\Customer\Card;

/**
 * Class CardTest
 */
class CardTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var Card
     */
    private $card;

    /**
     * @dataProvider providerPan
     * @param string $pan
     */
    public function testOKPan($pan)
    {
        $this->assertTrue($this->card->validatePan($pan));
    }
    /**
     * @dataProvider providerWrongPanType
     * @param string $pan
     */
    public function testWrongPanTYpe($pan)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->validatePan($pan);
    }

    // tests

    /**
     * @dataProvider providerWrongCardLength
     * @param string $pan
     */
    public function testWrongPanLength($pan)
    {
        $this->expectException(LengthException::class);
        $this->card->validatePan($pan);
    }

    /**
     * @dataProvider providerMonth
     * @param string $alfa
     * @param mixed $month
     */
    public function testMonthNO($alfa, $month)
    {
        if ($alfa) {
            $this->expectException(InvalidArgumentException::class);
            $this->card->setExpireMonth($month);
        }
        $this->expectException(UnexpectedValueException::class);
        $this->card->setExpireMonth($month);
    }

    /**
     * @dataProvider  providerYear
     * @param mixed $year
     */
    public function testYearNo($year)
    {
        $this->expectException(UnexpectedValueException::class);
        $this->card->setExpireYear($year);
    }

    /**
     * @dataProvider  providerLetters
     * @param mixed $month
     */
    public function testLettersInMonth($month)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->setExpireMonth($month);
    }

    /**
     * @dataProvider  providerLetters
     * @param mixed $year
     */
    public function testLettersInYear($year)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->setExpireYear($year);
    }

    /**
     * @return array
     */
    public function providerWrongPanType()
    {
        return [
            ['123456789098765432H'],
            ['435779876543098H'],
            ['dddddddddddddddd']
        ];
    }

    /**
     * @return array
     */
    public function providerWrongCardLength()
    {
        return [
            ['12345678909876543219'],
            ['412345678909876543217777'],
            ['41455'],
            ['']
        ];
    }

    /**
     * @return array
     */
    public function providerPan()
    {
        return [
            ['1234567890987654321'],
            ['4123456789098765421'],
            ['4149887855555555'],
            ['4357798765430987'],
            [1234567890123445]
        ];
    }

    /**
     * @return array
     */
    public function providerMonth()
    {
        return [
            [false, '13'],
            [false, '0'],
            [false, 77],
            [true, 'ф']
        ];
    }

    /**
     * @return array
     */
    public function providerLetters()
    {
        return [
            ['h'],
            ['t44']
        ];
    }

    /**
     * @return array
     */
    public function providerYear()
    {
        return [
            ['2013'],
            ['0'],
            [77],
            ['2089']
        ];
    }

    protected function _before()
    {
        $this->card = new Skytech\Sdk\Customer\Card();
    }

    protected function _after()
    {
    }
}
