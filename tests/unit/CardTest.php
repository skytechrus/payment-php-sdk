<?php


//use Skytech\Card;

class CardTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    private $card;

    protected function _before()
    {
        $this->card = new Skytech\Customer\Card();
    }

    protected function _after()
    {
    }

    // tests
    /**
    * @dataProvider providerPan
    */
    public function testOKPan($pan)
    {

        $this->assertTrue( $this->card->validatePan($pan));

    }
    /**
     * @dataProvider providerwrongPanType
     */
    public function testWrongPanTYpe($pan)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->validatePan($pan);

    }
    /**
     * @dataProvider providerwrongCardLength
     */
    public function testwrongPanLenth($pan)
    {
        $this->expectException(LengthException::class);
        $this->card->validatePan($pan);
    }
    /**
     * @dataProvider providerMonth
     */
     public function testMonthNO($alfa,$month)
    {
        if ($alfa) {
            $this->expectException(InvalidArgumentException::class);
            $this->card->setExpmonth($month);
        }
        $this->expectException(UnexpectedValueException::class);
        $this->card->setExpmonth($month);
    }

    /**
     * @dataProvider  providerYear
     */
    public function testYearNo($year)
    {
        $this->expectException(UnexpectedValueException::class);
        $this->card->setExpyear($year);
    }
    /**
     * @dataProvider  providerletters
     */
    public function testLettersInMonth($month)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->setExpmonth($month);
    }
    /**
     * @dataProvider  providerletters
     */
    public function testLettersInYear($year)
    {
        $this->expectException(InvalidArgumentException::class);
        $this->card->setExpyear($year);
    }
    public function providerwrongPanType()
    {
         return [
        ['123456789098765432H'],
        ['435779876543098H'],
        ['dddddddddddddddd']
        ];
    }
    public function providerwrongCardLength()
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
          [false,'13'],
          [false,'0'],
            [false,77],
            [true,'ф']
        ];
    }
    public function providerletters()
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
}
