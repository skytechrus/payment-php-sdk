<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.12.2017
 * Time: 15:39
 */

namespace Skytech\Sdk\Response;

/**
 * Class Completion
 * @package Skytech\Response
 */
class Completion extends Response
{
    /**
     * @return string
     */
    public function getTransactionID()
    {
        return $this->getAttributeName("POSResponse", "f", "t");
    }

    /**
     * @return string
     */
    public function getCardType()
    {
        return $this->getAttributeName("POSResponse", "f", "R");
    }

    /**
     * @return string
     */
    public function getApprovalCode()
    {
        return $this->getAttributeName("POSResponse", "f", "F");
    }

    /**
     * @return string
     */
    public function getSequenceNumber()
    {
        return $this->getAttributeName("POSResponse", "f", "h");
    }
}
