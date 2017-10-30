<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Response;

/**
 * Interface ResponseInterface
 *
 * @package Skytech\Response
 */
interface ResponseInterface
{
    /**
     * @param $fieldName
     * @return mixed
     */
    public function get($fieldName);
}
