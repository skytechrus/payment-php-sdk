<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

use function GuzzleHttp\Psr7\stream_for;
use GuzzleHttp\Stream\Stream;
use Skytech\Config\Config;
use Skytech\Response\XML\Provider;

/**
 * Class ResponseStrategy
 *
 * @package Skytech\Response
 */
class ResponseStrategy implements ResponseInterface
{
    /**
     * @var  \Skytech\Response\ResponseStrategy
     */
    private $response;

    /**
     * ResponseStrategy constructor.
     * @param \GuzzleHttp\Message\Response|null|string $response
     * @throws \Exception
     */
    public function __construct($response)
    {
        $this->loadResponse($response);
    }

    /**
     * @param \GuzzleHttp\Message\Response|null|string $response
     * @throws \Exception
     */
    private function loadResponse($response)
    {
//        var_dump($response);
        if(is_string($response)){
//            var_dump('STRINGGGGGG');
            $response_temp = new \GuzzleHttp\Message\Response(200);
            $response_temp->setHeader('Content-Type', 'text/xml');
//            $response_temp->setHeader('Content-Language', 'en-US');
            $response_temp->setBody(Stream::factory($response));
//            var_dump($response_temp);
            $response = $response_temp;
        } else {
//            var_dump('NOTSTRING');
        }
        switch ($this->getResponseFormat($response)) {
            case Config::XML:
                $this->response = new Provider($response->getBody());
                break;
            default:
                throw new \Exception('Invalid format ' . $this->getResponseFormat($response));
        }
    }

    /**
     * @param \GuzzleHttp\Message\Response|null|string $response
     * @return string
     * @throws \Exception
     */
    private function getResponseFormat($response)
    {
        $header = $response->getHeader('Content-Type');
        if (strpos($header, ";")) {
            $header = stristr($header, ';', true);
        }
        switch ($header) {
            case 'application/json':
                return Config::JSON;
                break;
            case 'application/xml':
                return Config::XML;
                break;
            case 'text/xml':
                return Config::XML;
                break;
            default:
                throw new \Exception('Invalid format ' . $response->getHeader('Content-Type'));
        }
    }

    /**
     * @param string $fieldName
     * @return mixed
     */
    public function get($fieldName)
    {
        return $this->response->get($fieldName);
    }

    /**
     * @param $parentNode
     * @param $fieldName
     * @param $attributeValue
     * @return mixed
     */
    public function getAttributeName($parentNode, $fieldName, $attributeValue)
    {
        return $this->response->getAttributeName($parentNode, $fieldName, $attributeValue);
    }
}
