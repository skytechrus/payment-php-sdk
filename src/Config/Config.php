<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Config;

class Config
{
    const XML  = 'XML';
    const JSON = 'JSON';

     /**
     * @var string
     */
    private static $dataFormat;

    private function __construct()
    {
    }

    public static function getDataFormat()
    {
        return self::$dataFormat;
    }

    /**
     * @param string $dataFormat
     */
    public static function setDataFormat($dataFormat)
    {
        self::$dataFormat = $dataFormat;
    }
    public static function getHostName()
    {
        return  IniFile::get('hostname');
    }
    public static function getPort()
    {
        return  IniFile::get('port');
    }
}
