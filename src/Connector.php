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

class Connector
{
    /**
     * @var DataProvider
     */
    public $orderdata;

    /**
     * Connector constructor.
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
        $client = new Client();
        $url = Config::getHostName() . ':' . Config::getPort();
        if (!strpos($url, "://")) {
            $url = 'https://' . $url;
        }
        switch (Config::getDataFormat()) {
            case Config::XML:
                $response = $client->request('POST', $url, ['body' => $this->orderdata, 'allow_redirects' => [
                    'max' => 5,        // allow at most 5 redirects.
                    'strict' => true,      // use "strict" RFC compliant redirects.
                    'referer' => false,      // do not add a Referer header
                    'protocols' => ['https', 'http'], // only allow https URLs
                    //'on_redirect'     => $onRedirect,
                    'track_redirects' => true]]);
                return new Response\ResponseStrategy($response);
            case Config::JSON:
                $response = $client->request('POST', $url, ['json' => $this->orderdata, 'allow_redirects' => [
                    'max' => 5,        // allow at most 5 redirects.
                    'strict' => true,      // use "strict" RFC compliant redirects.
                    'referer' => false,      // do not add a Referer header
                    'protocols' => ['https', 'http'], // only allow https URLs
                    //'on_redirect'     => $onRedirect,
                    'track_redirects' => true]]);
                return new Response\ResponseStrategy($response);
            default:
                throw new \Exception('Invalid format');
        }
    }
}
