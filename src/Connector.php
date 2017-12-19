<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use Skytech\Config\Config;
use GuzzleHttp\Client;
use Skytech\DataProvider\DataProvider;
use SplFileInfo;

/**
 * Class Connector
 *
 * @package Skytech
 */
class Connector
{
    /**
     * @var DataProvider
     */
    public $orderdata;
    /**
     * @var
     */
    private $pathToCertFile;
    /**
     * @var
     */
    private $certPassword;
    /**
     * @var bool
     */
    private $secureConnectionOnly = true;

    /**
     * Connector constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Response\ResponseStrategy
     * @throws \Exception
     */
    public function sendRequest()
    {
        $url = $this->getUrl();
        $body = $this->orderdata;
        return $this->getResponse($url, $body);
    }

    public function send($url, $body, $query = null, $method = 'post', $cert = true)
    {
        $client = new Client();
        $verbose = fopen('php://temp', 'w+');
        $options = [
            'body' => $body,
            'config' => [
                'curl' => [
                    CURLOPT_STDERR => $verbose
                ]
            ],
            'allow_redirects' => [
                'max' => 5,
                'strict' => true,
                'referer' => true,
                'protocols' => ['https', 'http'],
            ]
        ];

        if($cert) {
            $options['config']['curl'] = [
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_CAINFO, 'E:\Payment_plugins\Opencart\dist\CA.crt'
            ];
            $options['verify'] = 'E:\Payment_plugins\Opencart\dist\CA.crt';
        }

        if($query){
            $options['query'] = $query;
        }

        if (!$this->secureConnectionOnly){
            $options['protocols'] = ['https', 'http'];
        }

        if($this->pathToCertFile && $cert) {
            var_dump('PAAAAAAAAAAAAAAAAAAAAAAAAATH');
            $options['cert'] = [$this->pathToCertFile, $this->certPassword];
        }


        if (strtolower($method) == 'get') {
//            $response = $client->get($url, $options);
            var_dump($options);
//            var_dump(get_resources());
            $options['query'] = $query;
            $response = $client->get($url, $options);
        } else {
            $response = $client->post($url, $options);
        }
//        var_dump($verbose); //TODO delete

//        var_dump($response->getBody()->getContents()); // TODO delete

//        return new Response\ResponseStrategy($response);
        return $response;

    }

    /**
     * @param $url
     * @param $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function getResponse($url, $body)
    {
        $response = $this->send($url, $body);
        return new Response\ResponseStrategy($response);
    }

    /**
     *
     */
    public function setUnsecuredConnection()
    {
        $this->secureConnectionOnly = false;
    }

    /**
     * @param $pathToCert
     * @throws \Exception
     */
    public function setCert($pathToCert, $password)
    {
        $info = new SplFileInfo($pathToCert);
        if(!$info->isFile()){
            throw new \InvalidArgumentException('Cert file not found');
        }
        if(!$info->isReadable()){
            throw new \Exception('Cert file not readable');
        }
        $this->pathToCertFile = $info->getRealPath();
        $this->certPassword = $password;
    }

    /**
     * @return string
     */
    private function getUrl()
    {
        $url = Config::getHostName().':'. Config::getPort().'/exec';
//        $url = Config::getHostName().'/exec';
        if (!strpos($url, "://")) {
            $url = 'https://' . $url;
        }
        return $url;
    }
}
