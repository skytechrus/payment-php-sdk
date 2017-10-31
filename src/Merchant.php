<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use Respect\Validation\Validator as v;

/**
 * Class Merchant
 *
 * @package Skytech
 */
class Merchant
{
    /**
     * @var
     */
    private $language;
    /**
     * @var
     */
    private $merchantId;
    /**
     * @var
     */
    private $approveUrl;
    /**
     * @var
     */
    private $cancelUrl;
    /**
     * @var
     */
    private $declineUrl;

    /**
     * @return mixed
     */
    public function getApproveUrl()
    {
        return $this->approveUrl;
    }

    /**
     * @param mixed $approveUrl
     */
    public function setApproveUrl($approveUrl)
    {
        $this->approveUrl = $approveUrl;
    }

    /**
     * @return mixed
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * @param mixed $cancelUrl
     */
    public function setCancelUrl($cancelUrl)
    {

        $this->cancelUrl = $cancelUrl;
    }

    /**
     * @return mixed
     */
    public function getDeclineUrl()
    {
        return $this->declineUrl;
    }

    /**
     * @param mixed $declineUrl
     */
    public function setDeclineUrl($declineUrl)
    {
        $this->declineUrl = $declineUrl;
    }

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
        if (!empty($language)) {
            /*if (!ctype_upper($language)) {
                throw new \InvalidArgumentException('Language not in RFC 1766 format');
            }*/
            $language = strtolower($language);
//            $iso = new ISO639();
            if (!v::languageCode()->validate($language)) {
                throw new \InvalidArgumentException('Language not in RFC 1766 format');
            }
        }
        $this->language = $language;
    }

    /**
     * @param $url
     * @return bool
     */
    public function validateURL($url)
    {
        if (stristr($url, '//')===false) {
            $url = 'https://'.$url;
        }
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid url');
        }
        return true;
    }
    /**
     * @return mixed
     */
    public function getId()
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
