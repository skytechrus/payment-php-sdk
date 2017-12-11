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
        $this->assertEquals('443', Config::getPort());
    }

    public function testHostNameFeature()
    {
        $this->assertEquals('mpi.skytecrussia.com', Config::getHostName());
    }

    // tests

    public function testDataFormat()
    {
        $this->assertEquals('XML', Config::getDataFormat());
    }

    protected function _before()
    {
        Config::setDataFormat(Config::XML);
    }

    protected function _after()
    {
    }
}
