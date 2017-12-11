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
    private $pathToCertFile;
    private $certPassword;
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

    /**
     * @param $url
     * @param $body
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function getResponse($url, $body)
    {
        $client = new Client();
        $options = [
            'body' => $body,
            'allow_redirects' => [
                'max' => 5,
                'strict' => true,
                'referer' => true,
                'protocols' => ['https'],
            ]
        ];

        if (!$this->secureConnectionOnly){
            $options['protocols'] = ['https', 'http'];
        }

        if($this->pathToCertFile) {
            $options['cert'] = [$this->pathToCertFile, $this->certPassword];
        }

        $response = $client->post($url, $options);
        return new Response\ResponseStrategy($response);
    }

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
        $url = Config::getHostName() . ':' . Config::getPort();
        if (!strpos($url, "://")) {
            $url = 'https://' . $url;
        }
        return $url;
    }
}
