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
   private $hostname;
   private $port;
   public function __construct(DataProvider $dataProvider,$hostname,$port)
   {
      $this->orderdata = $dataProvider;
      $this->hostname  = $hostname;
      $this->port      = $port;
   }
   public function send_request()
   {
     $path = '/Exec';
     $content ='';
     $fp = fsockopen($this->hostname, $this->port, $errno, $errstr, 30);
     $request_data = $this->orderdata->getRequestData(); //XML For request
     if (!$fp) die('<p>'.$errstr.' ('.$errno.')</p>'); // Проверить установку соединения
       // Заголовок HTTPS-запроса
     $headers = 'POST '.$path." HTTP/1.0\r\n";
     $headers .= 'Host: '.$this->hostname."\r\n";
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
   public function process_response($response)
   {
     $this->orderdata->getResponseData($response);
   }
}