<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Author: Sergey Ivanov.
 * Author: Elena Arevkina.
 */

namespace Skytech\DataProvider\XML;

use Skytech\Operation\Operation;

/**
 * Trait FadaData
 *
 * @package Skytech\DataProvider\XML
 */
trait FadaData
{
    /**
     * @param Operation $operation
     * @return null|string
     */
    public function makeFadaData(Operation $operation)
    {
        $fadaData = null;
        $fadaData .= $this->makeFadaLine($fadaData, 'ShippingZipCode', $operation->customer->address->getZip());
        $fadaData .= $this->makeFadaLine($fadaData, 'ShippingCountry', $operation->customer->address->getCountry());
        $fadaData .= $this->makeFadaLine($fadaData, 'ShippingState',
            strtoupper($operation->customer->address->getRegion()));
        $fadaData .= $this->makeFadaLine($fadaData, 'ShippingCity',
            strtoupper($operation->customer->address->getCity()));
        $fadaData .= $this->makeFadaLine($fadaData, 'ShippingAddress', $operation->customer->address->addressline);
        $fadaData .= $this->makeFadaLine($fadaData, 'Email', $operation->customer->getEmailaddr());
        $fadaData .= $this->makeFadaLine($fadaData, 'Phone', $operation->customer->getPhone());
        $fadaData .= $this->makeFadaLine($fadaData, 'MerchantOrderID', $operation->order->getXid());
        return $fadaData;
    }

    /**
     * @param $collectedLine
     * @param $name
     * @param $value
     * @return null|string
     */
    public function makeFadaLine($collectedLine, $name, $value)
    {
        $fadaLine = null;
        if (!empty($value)) {
            if (!empty($collectedLine)) {
                $fadaLine = '; ';
            }
            $fadaLine .= $name . '=' . $value;
        }
        return $fadaLine;
    }
}
