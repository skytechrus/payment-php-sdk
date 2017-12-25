<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Operation;

/**
 * Class OperationType
 *
 * @package Skytech\Operation
 */
class OperationType
{
    /**
     *
     */
    const PURCHASE = "Purchase";
    const REVERSE = "Reverse";
    const REFUND = "Refund";
    const ORDERSTATUS = "OrderStatus";
    const ORDER_INFORMATION = "OrderInformation";
    const ORDER_PREAUTHORISATION = "PreAuthorisation";
    const COMPLETION = "Completion";
    const PAYMENT = "Payment";
}
