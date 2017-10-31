<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Config;

/**
 * Class Config
 *
 * @package Skytech\Config
 */
class Config
{
    /**
     * @const XML Xml format constant
     */
    const XML  = 'XML';
    /**
     * @const JSON Json format constant
     */
    const JSON = 'JSON';

    /**
     * @var string
     */
    private static $dataFormat;

    /**
     * Config constructor.
     */
    private function __construct()
    {
    }

    /**
     * @return string
     */
    public static function getDataFormat()
    {
        return IniFile::get('format');
    }

    /**
     * @param string $dataFormat
     * @deprecated
     */
    public static function setDataFormat($dataFormat)
    {
        self::$dataFormat = $dataFormat;
    }

    /**
     * @return mixed
     */
    public static function getHostName()
    {
        return  IniFile::get('hostname');
    }

    /**
     * @return mixed
     */
    public static function getPort()
    {
        return  IniFile::get('port');
    }
}
