<?php


class MerchantTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @dataProvider dataProvider */
    public function testSomeFeature($a)
    {
        $this->assertEquals($a, $this->order->getId());
    }

    public function dataProvider()
    {
        return [
            [64],
            [65],
            [66],
            [67],
            [68],
        ];

    }

    protected function _before()
    {
    }

    protected function _after()
    {
    }
}
