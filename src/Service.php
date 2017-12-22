<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

/**
 * Class Service
 *
 * @package Skytech
 */
class Service extends \Sabre\Xml\Service
{
    /**
     * Generates an XML document in one go.
     *
     * The $rootElement must be specified in clark notation.
     * The value must be a string, an array or an object implementing
     * XmlSerializable. Basically, anything that's supported by the Writer
     * object.
     *
     * $contextUri can be used to specify a sort of 'root' of the PHP application,
     * in case the xml document is used as a http response.
     *
     * This allows an implementor to easily create URI's relative to the root
     * of the domain.
     *
     * @param string $rootElementName
     * @param string|array|XmlSerializable $value
     * @param string|null $contextUri
     * @return string
     */
    public function write($rootElementName, $value, $contextUri = null)
    {
        $w = $this->getWriter();
        $w->openMemory();
        $w->contextUri = $contextUri;
        $w->setIndent(true);
        $w->startDocument('1.0', 'UTF-8');
        $w->writeElement($rootElementName, $value);
        return $w->outputMemory();
    }

}
