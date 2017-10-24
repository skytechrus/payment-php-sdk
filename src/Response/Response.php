<?php


namespace Skytech\Response;

use SimpleXMLElement;

class Response
{
    /** @var  SimpleXMLElement */
    private $body;

    public function __construct($responseBody)
    {
        $this->body = new SimpleXMLElement($responseBody);
    }

    protected function getInteger($tagName)
    {
        $tagValue = null;
        if (!empty($this->body->xpath("//" . $tagName)[0])) {
            $tagValue = (int)$this->body->xpath("//" . $tagName)[0];
        }
        return $tagValue;
    }

    /**
     * @param string $tagName
     * @return string
     */
    protected function getString($tagName)
    {
        $tagValue = '';
        if (!empty($this->body->xpath("//" . $tagName)[0])) {
            $tagValue = (string)$this->body->xpath("//" . $tagName)[0];
        }
        return $tagValue;
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
