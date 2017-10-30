<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Config;

use UnexpectedValueException;

class IniFile
{
    private static $root = 'PROD';

    public function __construct()
    {
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function get($value)
    {
        $array = include 'config_ini.php';
        if ((bool)$array['testing']) {
            self::$root = 'TEST';
        }
        if (empty($array[self::$root][$value])) {
            throw new UnexpectedValueException('Unknown settings');
        }
        return $array[self::$root][$value];
    }
}
