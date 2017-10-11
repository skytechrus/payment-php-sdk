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
   public function sendrequest($hostname,$port)
   {
     $path = '/Exec';
     $content ='';
     $fp = fsockopen($hostname, $port, $errno, $errstr, 30);
     $request_data = $this->orderdata->getRequestData(); //XML For request
     if (!$fp) die('<p>'.$errstr.' ('.$errno.')</p>'); // Проверить установку соединения
       // Заголовок HTTPS-запроса
     $headers = 'POST '.$path." HTTP/1.0\r\n";
     $headers .= 'Host: '.$hostname."\r\n";
     $headers .= "Content-type: application/x-www-form-urlencoded\r\n";
     $headers .= 'Content-Length: '.strlen($request_data)."\r\n\r\n";
     // Отправить HTTPS-запрос серверу
     fwrite($fp, $headers.$request_data);
     // Получаем ответ
     while ( !feof($fp) ){
        $inStr= fgets($fp, 1024);
        // В этом случае необходимо вырезать ответ
        if (substr($inStr,0,7)!=="<TKKPG>") continue;
        //Добавляем оставшися текст в строку ответа
        $content .= $inStr;
        }
     // Закрыть соединение
     fclose($fp);
     return ($content);
   }
   public function process_response($xml)
   {
     $this->orderdata->getResponseData($xml);
   }
}