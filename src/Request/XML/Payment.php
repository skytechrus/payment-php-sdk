<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 22.12.2017
 * Time: 13:25
 */

namespace Skytech\Request\XML;

use Skytech\Operation\Operation;
use Skytech\OrderPayment;
use Skytech\Request\DataProvider;
use Skytech\Service;
use function str_replace;

/**
 * Class Payment
 * @package Skytech\Request\XML
 */
class Payment extends DataProvider
{

    public function __construct(Operation $operation)
    {
        parent::__construct($operation);
    }

    /**
     * @return mixed|string
     */
    public function getRequestData()
    {
        $service = new Service();
        $requestBody = array();
        $requestBody["Request"] = array();
        $requestBody["Request"]["Operation"] = "CreateOrder";
        $requestBody["Request"]["Language"] = "";
        $requestBody["Request"]["Order"] = array();
        $requestBody["Request"]["Order"]["OrderType"] = "Payment";
        $requestBody["Request"]["Order"]["Merchant"] = $this->operation->merchant->getId();
        $requestBody["Request"]["Order"]["Amount"] = $this->operation->order->getAmount();
        $requestBody["Request"]["Order"]["Currency"] = $this->operation->order->getCurrency();
        $requestBody["Request"]["Order"]["Description"] = $this->operation->order->getDescription();
        $requestBody["Request"]["Order"]["ApproveURL"] = $this->operation->merchant->getApproveUrl();
        $requestBody["Request"]["Order"]["CancelURL"] = $this->operation->merchant->getCancelUrl();
        $requestBody["Request"]["Order"]["DeclineURL"] = $this->operation->merchant->getDeclineUrl();
        if (!empty($this->operation->customer->getEmail())) {
            $requestBody["Request"]["Order"]["email"] = $this->operation->customer->getEmail();
        }
        if (!empty($this->operation->customer->getPhone())) {
            $requestBody["Request"]["Order"]["phone"] = $this->operation->customer->getPhone();
        }
        $requestBody["Request"]["Order"]["AddParams"] = array();
        $requestBody["Request"]["Order"]["AddParams"] = $this->getAddParams($this->operation->order);

        $xml = $service->write("TKKPG", $requestBody);

        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }

    public function getAddParams(OrderPayment $orderExt)
    {
        $addParams = array();
        $addParams["VendorID"] = $orderExt->getVendorId();
        $addPaymentParams = $orderExt->getPaymentParams();
        $addPaymentParams = str_replace("/", "\/", $addPaymentParams);
        $addPaymentParams = str_replace("\\", "\\\\", $addPaymentParams);
        if (!empty($addPaymentParams)) {
            $addParamList = "";
            foreach ($addPaymentParams as $paramData) {
                if (!empty($addParamList)) {
                    $addParamList .= "/";
                }
                $addParamList .= $paramData;
            }
            $addParams["PaymentParams"] = $addParamList;
        }
        return $addParams;
    }
}
