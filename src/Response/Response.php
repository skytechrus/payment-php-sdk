<?php


namespace Skytech\Response;

class Response
{
    /** @var  ResponseStrategy */
    private $response;

    /**
     * Response constructor.
     * @param ResponseStrategy $response
     */
    public function __construct(ResponseStrategy $response)
    {
        $this->response =$response;
    }

    /**
     * @param string $fieldName
     * @return int
     */
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
