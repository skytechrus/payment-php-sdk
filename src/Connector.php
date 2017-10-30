<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 10.10.2017
 * Time: 16:27
 */

namespace Skytech;

use Skytech\Config\Config;
use GuzzleHttp\Client;
use Skytech\DataProvider\DataProvider;

/**
 * Class Connector
 *
 * @package Skytech
 */
class Connector
{
    public $orderdata;

    /**
     * Connector constructor.
     *
     * @param DataProvider $dataProvider
     */
    public function __construct(DataProvider $dataProvider)
    {
        $this->orderdata = $dataProvider;
    }

    /**
     * @return Response\ResponseStrategy
     * @throws \Exception
     */
    public function sendRequest()
    {
        $url = $this->getUrl();
        switch (Config::getDataFormat()) {
            case Config::XML:
                return $this->getResponse($url, $this->orderdata);
            case Config::JSON:
                return $this->getResponse($url, $this->orderdata);
            default:
                throw new \Exception('Invalid format');
        }
    }

    /**
     * @param $url
     * @param $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function getResponse($url, $body)
    {
        $client = new Client();
        $response = $client->request('POST', $url, [
            'body' => $body,
            'allow_redirects' => [
                'max' => 5,        // allow at most 5 redirects.
                'strict' => true,      // use "strict" RFC compliant redirects.
                'referer' => false,      // do not add a Referer header
                'protocols' => ['https', 'http'], // only allow https URLs
                //'on_redirect'     => $onRedirect,
                'track_redirects' => true
            ]
        ]);
        return new Response\ResponseStrategy($response);
    }

    /**
     * @return string
     */
    private function getUrl()
    {
        $url = Config::getHostName() . ':' . Config::getPort();
        if (!strpos($url, "://")) {
            $url = 'https://' . $url;
        }
        return $url;
    }
}
