<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 10.10.2017
 * Time: 16:27
 */

namespace Skytech;


class Connector
{  private $orderdata;

   public function __construct(DataProvider $dataProvider)
   {
      $this->orderdata = $dataProvider;
   }
   public function sendrequest()
   {

   }
   public function processresponce()
   {

   }
}