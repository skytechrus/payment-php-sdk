<?php
/**
 * Created by PhpStorm.
 * User: msvbe
 * Date: 20.10.2017
 * Time: 16:23
 */

namespace Skytech;


class Merchant
{
    private $language;
    private $merchantId;
    private $urlApprove;
    private $urlCancel;
    private $urlDecline;

    /**
     * Merchant constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @param mixed $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

}
