<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 27.10.2017
 * Time: 14:31
 */

namespace Skytech\Response;

use Skytech\Config\Config;
use Skytech\Response\XML\Response;

class ResponseStrategy implements iResponse
{
    /**
     * @var  \Skytech\Response\ResponseStrategy;
     */
    private $response;

    /**
     * ResponseStrategy constructor.
     * @param $response
     * @throws \Exception
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->loadResponse($response);
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     * @throws \Exception
     */
    private function loadResponse(\GuzzleHttp\Psr7\Response $response)
    {
        switch ($this->getResponseFormat($response)) {
            case Config::XML:
                $this->response = new Response($response->getBody());
                break;
            default:
                throw new \Exception('Invalid format');
        }
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     * @return string
     * @throws \Exception
     */
    private function getResponseFormat(\GuzzleHttp\Psr7\Response $response)
    {
        switch ($response->getHeaderLine('Content-Type')) {
            case 'application/json':
                return Config::JSON;
                break;
            case 'application/xml':
                return Config::XML;
                break;
            default:
                throw new \Exception('Invalid format');
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
