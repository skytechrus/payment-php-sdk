<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response\XML;

use SimpleXMLElement;
use Skytech\Response\ResponseInterface;

class Response implements ResponseInterface
{
    private $xml;

    public function __construct($responseBody)
    {
        $this->xml = new SimpleXMLElement($responseBody);
    }

    public function get($fieldName)
    {

        if (!empty($this->xml->xpath("//" . $fieldName)[0])) {
            $tagValue = (string)$this->xml->xpath("//" . $fieldName)[0];
            return $tagValue;
        }
        return null;
    }
}
