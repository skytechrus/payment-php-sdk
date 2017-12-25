<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Config\Config;

/**
 * Class ConfigTest
 */
class ConfigTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testPortFeature()
    {
        $this->assertEquals('9009', Config::getPort());
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
