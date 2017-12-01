<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response\XML;

use SimpleXMLElement;
use Skytech\Response\ResponseInterface;

/**
 * Class Response
 *
 * @package Skytech\Response\XML
 */
class Provider implements ResponseInterface
{
    /**
     * @var SimpleXMLElement
     */
    private $xml;

    /**
     * Response constructor.
     *
     * @param $responseBody
     */
    public function __construct($responseBody)
    {
        try {
            $this->xml = new SimpleXMLElement($responseBody);
        } catch (\Exception $e) {
            var_dump($responseBody);
        }
    }

    /**
     * @param $fieldName
     * @return null|string
     */
    public function get($fieldName)
    {

        if (!empty($this->xml->xpath("//" . $fieldName)[0])) {
            $tagValue = (string)$this->xml->xpath("//" . $fieldName)[0];
            return $tagValue;
        }
        return null;
    }
}
