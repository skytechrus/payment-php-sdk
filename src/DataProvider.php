<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.10.2017
 * Time: 15:34
 */

namespace Skytech;


abstract class DataProvider
{
   protected $operation;
   abstract public function getRequestData();
   abstract public function getResponseData($response);
}