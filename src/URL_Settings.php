<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 11:40
 */

namespace Skytech;


use UnexpectedValueException;

class URL_Settings
{
    private $declineurl;
    private $cancelurl;
    private $approveurl;
    public function __construct($approveurl=null,$cancelurl=null,$declineurl=null)
    {
        $this->approveurl = $approveurl;
        $this->cancelurl = $cancelurl;
        $this->declineurl = $declineurl;
    }
    /**
     * @param mixed $approveurl
     */
    public function setApproveurl($approveurl)
    {
        $url = $approveurl;
        if (!strstr($url,"://"))
        {
            $url="http://".$url;
        }
        if (!filter_var($url, FILTER_VALIDATE_URL))
        {
            throw new UnexpectedValueException('Invalid url');
        }
        $this->approveurl = $approveurl;
    }

    /**
     * @param mixed $cancelurl
     */
    public function setCancelurl($cancelurl)
    {
        $url = $cancelurl;
        if (!strstr($url,"://"))
        {
            $url="http://".$url;
        }
        if (!filter_var($url, FILTER_VALIDATE_URL))
        {
            throw new UnexpectedValueException('Invalid url');
        }
        $this->cancelurl = $cancelurl;
    }

    /**
     * @param mixed $declineurl
     */
    public function setDeclineurl($declineurl)
    {
        $url = $declineurl;
        if (!strstr($url,"://"))
        {
            $url="http://".$url;
        }
        if (!filter_var($url, FILTER_VALIDATE_URL))
        {
            throw new UnexpectedValueException('Invalid url');
        }
        $this->declineurl = $declineurl;
    }

    /**
     * @return mixed
     */
    public function getApproveurl()
    {
        return $this->approveurl;
    }

    /**
     * @return mixed
     */
    public function getDeclineurl()
    {
        return $this->declineurl;
    }

    /**
     * @return mixed
     */
    public function getCancelurl()
    {
        return $this->cancelurl;
    }

}