<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Response\XML;

use SimpleXMLElement;
use Skytech\Sdk\Response\ResponseInterface;

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

    /**
     * @param $parentNode
     * @param $fieldName
     * @param $attributeValue
     * @return null
     */
    public function getAttributeName($parentNode, $fieldName, $attributeValue)
    {
        $path = $parentNode . "/" . $fieldName . "[@name ='" . $attributeValue . "']" . "/@value";
        $attribute = (string)$this->xml->xpath("//" . $path)[0];
        return $attribute;
    }
}
