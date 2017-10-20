<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 15:01
 */
namespace Skytech;

trait XML_FADA_Data{
    public function makeFada_line($collected_line,$name,$value)
    {
        $fada_line =null;
        if(!empty($value)) {
            if (!empty($collected_line))
            {
                $fada_line ='; ';
            }
            $fada_line .= $name . '=' . $value  ;
        }
        return $fada_line;
    }
    public function makeFada_data(Operation $operation)
    {
        $fada_data = null;
        $fada_data .= $this->makeFada_line($fada_data,'ShippingZipCode', $operation->customer->address->getZip());
        $fada_data .= $this->makeFada_line($fada_data,'ShippingCountry', $operation->customer->address->getCountry());
        $fada_data .= $this->makeFada_line($fada_data,'ShippingState',strtoupper( $operation->customer->address->getRegion()));
        $fada_data .= $this->makeFada_line($fada_data,'ShippingCity', strtoupper( $operation->customer->address->getCity()));
        $fada_data .= $this->makeFada_line($fada_data,'ShippingAddress', $operation->customer->address->addressline );
// $fada_data .= $this->makeFada_line('DeliveryPeriod', null );
        $fada_data .= $this->makeFada_line($fada_data,'Email', $operation->customer->getEmailaddr());
        $fada_data .= $this->makeFada_line($fada_data,'Phone', $operation->customer->getPhone() );
        $fada_data .= $this->makeFada_line($fada_data,'MerchantOrderID', $operation->order->getXid());
        return $fada_data;
    }
}