<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

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
     * @param $fieldName
     * @return int
     */
    protected function getInteger($fieldName)
    {
        return $this->response->get($fieldName);
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
    public function getStatus()
    {
        return $this->getString('Status');
    }

    /**
     * @return string
     */
    public function getOperation()
    {
        return $this->getString('Operation');
    }
}
