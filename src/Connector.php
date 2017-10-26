<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 10.10.2017
 * Time: 16:27
 */

namespace Skytech;

use RuntimeException;
use Skytech\Config\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Connector
{
    public $orderdata;

    public function __construct(DataProvider $dataProvider)
    {
        $this->orderdata = $dataProvider;
    }

    public function sendRequest()
    {
        //$path = '/Exec';
        $content = '';
        $client = new Client();
        $url = Config::getHostName().':'.Config::getPort();
        if (!strpos($url, "://")) {
            $url = 'https://'.$url;
        }

        try {
            if (Config::getDataFormat() == Config::XMLDATA) {
                $response = $client->request('POST', $url, ['body' => $this->orderdata,'allow_redirects' => false]);
                $content = (string)$response->getBody();
            } elseif (Config::getDataFormat() == Config::JSON) {
                $response = $client->request('POST', $url, ['json' => $this->orderdata,'allow_redirects' =>[
                    'max'             => 5,        // allow at most 5 redirects.
                    'strict'          => true,      // use "strict" RFC compliant redirects.
                    'referer'         => false,      // do not add a Referer header
                    'protocols'       => ['https','http'], // only allow https URLs
                    //'on_redirect'     => $onRedirect,
                    'track_redirects' => true
                ]
                ]);
                $content = (string)$response->getBody();
            }
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                throw new RuntimeException('Get Response for Request Exception:' . $e->getMessage());
            }
            throw new RuntimeException('Request Exception:' . $e->getMessage());
        }


        /*
        $fp = fsockopen(Config::getHostName(), Config::getPort(), $errno, $errstr, 30);
        $request_data = $this->orderdata->getRequestData(); //XML For request
        if (!$fp) die('<p>'.$errstr.' ('.$errno.')</p>'); // Проверить установку соединения
          // Заголовок HTTPS-запроса
        $headers = 'POST '.$path." HTTP/1.0\r\n";
        $headers .= 'Host: '.Config::getHostName()."\r\n";
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
        */
        return ($content);
    }
}
