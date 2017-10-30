<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

/**
 * Interface Response
 *
 * @package Skytech\DataProvider\XML
 */
interface Response
{
    /**
     * @param $fieldName
     * @return mixed
     */
    public function get($fieldName);
}
