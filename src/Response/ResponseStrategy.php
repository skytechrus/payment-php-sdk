<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

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
     * @param $response
     * @throws \Exception
     */
    public function __construct($response)
    {
        $this->loadResponse($response);
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     * @throws \Exception
     */
    private function loadResponse($response)
    {
//        switch ($this->getResponseFormat($response)) {
//            case Config::XML:
                $this->response = new Provider($response->getBody());
//                break;
//            default:
//                throw new \Exception('Invalid format');
//        }
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     * @return string
     * @throws \Exception
     */
    private function getResponseFormat($response)
    {
//        switch ($response->getHeaderLine('Content-Type')) {
//            case 'application/json':
//                return Config::JSON;
//                break;
//            case 'application/xml':
                return Config::XML;
//                break;
//            default:
//                throw new \Exception('Invalid format');
//        }
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
