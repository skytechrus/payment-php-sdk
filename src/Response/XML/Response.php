<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 27.10.2017
 * Time: 14:33
 */

namespace Skytech\Response\XML;

use SimpleXMLElement;
use Skytech\Response\iResponse;

class Response implements iResponse
{
    /**
     * @var SimpleXMLElement
     */
    private $xml;

    /**
     * Response constructor.
     * @param $responseBody
     */
    public function __construct($responseBody)
    {
        $this->xml = new SimpleXMLElement($responseBody);
    }

    /**
     * @param string $fieldName
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
