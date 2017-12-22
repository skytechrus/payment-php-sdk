<?php


use Skytech\Config\Config;
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
    public function testPortFeature($portExp)
    {
        $port = Config::get('port');
        $this->assertEquals($portExp, $port);
    }

    /**
     * @dataProvider providerHostName
     * @param $hostExp
     */
    public function testHostName($hostExp)
    {
        $hostName = Config::get('hostname');
        $this->assertEquals($hostExp, $hostName);
    }

    /**
     * @dataProvider providerErrHostName
     * @param $value
     * @param $hostExp
     */
    public function testUnKnownData($value,$hostExp)
    {
        $this->expectException(UnexpectedValueException::class);
        $this->assertEquals($hostExp, Config::get($value));
    }
    public function providerData()
    {
        return [[ '9009']];
    }
    public function providerHostName()
    {
        return [[ 'mpi.skytecrussia.com']];
    }
    public function providerErrHostName()
    {
        return [[ 'HostName','123.123.12.3'],
            [ 'Host','456.456.45.6'],
            ['hostnae','456.456.45.6']];
    }
}