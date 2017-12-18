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
        switch ($this->getResponseFormat($response)) {
            case Config::XML:
                $this->response = new Provider($response->getBody());
                break;
            default:
                throw new \Exception('Invalid format ' . $this->getResponseFormat($response));
        }
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     * @return string
     * @throws \Exception
     */
    private function getResponseFormat($response)
    {
        $header = $response->getHeader('Content-Type');
        $header = stristr($header, ';', true);
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
}
