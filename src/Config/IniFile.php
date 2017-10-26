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
    public function __construct()
    {
    }

    /**
     * @param $root
     * @param $value
     * @return mixed
     */
    public static function get($root, $value)
    {
        $array = include 'config_ini.php';
        if (empty($array[$root][$value])) {
            throw new UnexpectedValueException('Unknown settings');
        }
        return $array[$root][$value];
    }
}
