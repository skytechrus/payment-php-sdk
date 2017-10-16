<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 15:01
 */
namespace Skytech;

trait XML_FADA_Data{
    public function makeFada_line($name,$value)
    {
        $fada_line =null;
        if(!is_null($value)) {
            $fada_line = $name . '=' . $value . ';';
        }
        return $fada_line;
    }
    public function makeFada_data(Operation $operation)
    {
        $fada_data = null;
        $fada_data .= $this->makeFada_line('ShippingCountry', $operation->customer->address->getCountry());
        $fada_data .= $this->makeFada_line('ShippingCity', $operation->customer->address->getCountry());
        $fada_data .= $this->makeFada_line('ShippingState', $operation->customer->address->getRegion());
        $fada_data .= $this->makeFada_line('ShippingZipCode', $operation->customer->address->getZip());
        $fada_data .= $this->makeFada_line('ShippingAddress', $operation->customer->address->addressline );
// $fada_data .= $this->makeFada_line('DeliveryPeriod', null );
        $fada_data .= $this->makeFada_line('Phone', $operation->customer->getPhone() );
        $fada_data .= $this->makeFada_line('Email', $operation->customer->getEmailaddr() );
        $fada_data .= $this->makeFada_line('MerchantOrderID', $operation->order->getXid());
        return $fada_data;
    }
}