<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

/**
 * Interface ResponseInterface
 *
 * @package Skytech\DataProvider\XML
 */
interface ResponseInterface
{
    /**
     * @param $fieldName
     * @return mixed
     */
    public function get($fieldName);
}
