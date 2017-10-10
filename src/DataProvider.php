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
   protected $order;
   public function __construct(Order $order)
   {
       $this->order = $order;
   }
   public function getRequestData()
   {}

}