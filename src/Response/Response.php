<?php

namespace Skytech\Response;

class Response
{
    /** @var  ResponseStrategy */
    private $response;

    public function __construct(ResponseStrategy $response)
    {
        $this->response =$response;
    }

    protected function getInteger($fieldName)
    {
        return (int)$this->response->get($fieldName);
    }

    /**
     * @param string $fieldName
     * @return string
     */
    protected function getString($fieldName)
    {
        return (string)$this->response->get($fieldName);
    }

    public function getStatus()
    {
        return $this->getString('Status');
    }

    public function getOperation()
    {
        return $this->getString('Operation');
    }
}
