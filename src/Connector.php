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
use Skytech\DataProvider\DataProvider;

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
                $response = $client->request('POST', $url, ['body' => $this->orderdata,'allow_redirects' => [
                    'max'             => 5,        // allow at most 5 redirects.
                    'strict'          => true,      // use "strict" RFC compliant redirects.
                    'referer'         => false,      // do not add a Referer header
                    'protocols'       => ['https','http'], // only allow https URLs
                    //'on_redirect'     => $onRedirect,
                    'track_redirects' => true
                ] ]);
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

        return ($content);
    }
}
