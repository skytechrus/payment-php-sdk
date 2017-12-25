<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Config\Config;
use Skytech\Sdk\Config\IniFile;

/**
 * Class IniFileTest
 */
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

    /**
     * @return array
     */
    public function providerData()
    {
        return [[ '9009']];
    }

    /**
     * @return array
     */
    public function providerHostName()
    {
        return [[ 'mpi.skytecrussia.com']];
    }

    /**
     * @return array
     */
    public function providerErrHostName()
    {
        return [[ 'HostName','123.123.12.3'],
            [ 'Host','456.456.45.6'],
            ['hostnae','456.456.45.6']];
    }
}