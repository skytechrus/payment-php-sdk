<?php


use Skytech\Config\Config;

class ConfigTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testPortFeature()
    {
        $this->assertEquals('1234', Config::getPort());
        Config::setEnvironment(Config::TEST);
        $this->assertEquals('567', Config::getPort());
    }

    public function testHostNameFeature()
    {
        $this->assertEquals('123.123.12.3', Config::getHostName());
        Config::setEnvironment(Config::TEST);
        $this->assertEquals('456.456.45.6', Config::getHostName());
    }

    // tests

    public function testDataFormat()
    {
        $this->assertEquals('XML', Config::getDataFormat());
    }

    protected function _before()
    {
        Config::setDataFormat(Config::XMLDATA);
        Config::setEnvironment(Config::PROD);
    }

    protected function _after()
    {
    }
}
