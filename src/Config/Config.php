<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Config;

use UnexpectedValueException;

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
    public static $root = 'PROD';

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
        return self::get('format');
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
        return self::get('hostname');
    }

    /**
     * @return mixed
     */
    public static function getPort()
    {
        return self::get('port');
    }

    /**
     * @param string $value
     * @return mixed
     */
    public static function get($value)
    {
        $array = include 'config_ini.php';
        if (array_key_exists($value, $array) && $value != 'testing') {
            return $array[$value];
        }
        if ((bool)$array['testing']) {
            self::$root = 'TEST';
        }
        if (empty($array[self::$root][$value])) {
            throw new UnexpectedValueException('Unknown settings');
        }
        return $array[self::$root][$value];
    }
}
