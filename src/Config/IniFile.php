<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 25.10.2017
 * Time: 15:50
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
