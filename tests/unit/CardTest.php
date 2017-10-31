<?php

//use Skytech\Card;

use Skytech\Customer\Card;

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
            $this->card->setExpMonth($month);
        }
        $this->expectException(UnexpectedValueException::class);
        $this->card->setExpMonth($month);
    }

    /**
     * @dataProvider  providerYear
     * @param mixed $year
     */
    public function testYearNo($year)
    {
        $this->expectException(UnexpectedValueException::class);
        $this->card->setExpYear($year);
    }

    /**
     * @dataProvider  providerLetters
     * @param mixed $month
     */
    public function testLettersInMonth($month)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->setExpMonth($month);
    }

    /**
     * @dataProvider  providerLetters
     * @param mixed $year
     */
    public function testLettersInYear($year)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->setExpYear($year);
    }

    public function providerWrongPanType()
    {
        return [
            ['123456789098765432H'],
            ['435779876543098H'],
            ['dddddddddddddddd']
        ];
    }

    public function providerWrongCardLength()
    {
        return [
            ['12345678909876543219'],
            ['412345678909876543217777'],
            ['41455'],
            ['']
        ];
    }

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

    public function providerMonth()
    {
        return [
            [false, '13'],
            [false, '0'],
            [false, 77],
            [true, 'ф']
        ];
    }

    public function providerLetters()
    {
        return [
            ['h'],
            ['t44']
        ];
    }

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
        $this->card = new Skytech\Customer\Card();
    }

    protected function _after()
    {
    }
}
