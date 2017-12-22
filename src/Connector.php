<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use Skytech\Config\Config;
use GuzzleHttp\Client;
use Skytech\Request\DataProvider;
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

    /**
     * @param $url
     * @param $body
     * @return \GuzzleHttp\Message\FutureResponse|\GuzzleHttp\Message\ResponseInterface|\GuzzleHttp\Ring\Future\FutureInterface|null
     */
    private function send($url, $body)
    {
        $caCertFileName = 'CA.crt';
        $client = new Client();
        $options = [
            'body' => $body,
            'verify' => dirname(__DIR__) . DIRECTORY_SEPARATOR . $caCertFileName,
            'cert' => [$this->pathToCertFile, $this->certPassword],
            'config' => [
                'curl' => [
                    CURLOPT_SSL_VERIFYHOST => 2,
                    CURLOPT_SSL_VERIFYPEER => true,
                    CURLOPT_CAINFO =>dirname(__DIR__) . DIRECTORY_SEPARATOR . $caCertFileName
                ]
            ],
            'allow_redirects' => [
                'max' => 5,
                'strict' => true,
                'referer' => true,
                'protocols' => ['https', 'http'],
            ]
        ];

        if (!$this->secureConnectionOnly) {
            $options['protocols'] = ['https', 'http'];
        }

        $response = $client->post($url, $options);

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
     * Set client pem certificate file
     * @param string $pathToCert
     * @param string $password Password for cert file
     * @throws \Exception
     */
    public function setCert($pathToCert, $password)
    {
        $info = new SplFileInfo($pathToCert);
        if(!$info->isFile()){
            throw new \InvalidArgumentException('Cert file not found');
        }
        if (!$info->isReadable()) {
            throw new \Exception('Cert file not readable');
        }
        $this->pathToCertFile = $info->getRealPath(); // ???
        $this->certPassword = $password;
    }

    /**
     * @return string TWPG server url
     */
    private function getUrl()
    {
        if (Config::getPort()) {
            $url = Config::getHostName() . ':' . Config::getPort() . '/exec';
        } else {
            $url = Config::getHostName() . '/exec';
        }

        if (!strpos($url, "://")) {
            $url = 'https://' . $url;
        }

        return $url;
    }
}
