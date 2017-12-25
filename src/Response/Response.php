<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Response;

/**
 * Class Response
 *
 * @package Skytech\Response
 */
class Response
{
    /** @var  ResponseStrategy */
    private $response;

    /**
     * Response constructor.
     *
     * @param ResponseStrategy $response
     */
    public function __construct(ResponseStrategy $response)
    {
        $this->response = $response;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->getString('Status');
    }

    /**
     * @param string $fieldName
     * @return string
     */
    protected function getString($fieldName)
    {
        return $this->response->get($fieldName);
    }

    /**
     * @return string
     */
    public function getOperation()
    {
        return $this->getString('Operation');
    }

    /**
     * @param $parentNode
     * @param $fieldName
     * @param $attributeValue
     * @return string
     */
    public function getAttributeName($parentNode, $fieldName, $attributeValue)
    {
        return (string)$this->response->getAttributeName($parentNode, $fieldName, $attributeValue);
    }

    /**
     * @param $fieldName
     * @return int
     */
    protected function getInteger($fieldName)
    {
        return $this->response->get($fieldName);
    }
}
