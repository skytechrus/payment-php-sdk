<?php


use Skytech\Config\IniFile;

class IniFileTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider providerData
     * @param $environment
     * @param $portExp
     */
    public function testPortFeature($environment, $portExp)
    {
        $port = IniFile::get($environment, 'port');
        $this->assertEquals($portExp, $port);
    }

    /**
     * @dataProvider providerHostName
     * @param $environment
     * @param $hostExp
     */
    public function testHostName($environment,$hostExp)
    {
        $hostName = IniFile::get($environment, 'hostname');
        $this->assertEquals($hostExp, $hostName);
    }

    /**
     * @dataProvider providerErrHostName
     * @param $environment
     * @param $value
     * @param $hostExp
     */
    public function testUnKnownData($environment,$value,$hostExp)
    {
        $this->expectException(UnexpectedValueException::class);
        $this->assertEquals($hostExp, IniFile::get($environment, $value));
    }
    public function providerData()
    {
        return [['PROD','1234'],
            ['TEST','567']];
    }
    public function providerHostName()
    {
        return [['PROD','123.123.12.3'],
            ['TEST','456.456.45.6']];
    }
    public function providerErrHostName()
    {
        return [['PROD','HostName','123.123.12.3'],
            ['TEST','Host','456.456.45.6'],
            ['test','hostname','456.456.45.6']];
    }
}