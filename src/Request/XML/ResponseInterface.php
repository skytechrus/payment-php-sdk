<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request\XML;

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
