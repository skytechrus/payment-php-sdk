<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 12.10.2017
 * Time: 11:40
 */

namespace Skytech;


class URL_Settings
{
    private $declineurl;
    private $cancelurl;
    private $approveurl;
    public function __construct()
    {
    }
    /**
     * @param mixed $approveurl
     */
    public function setApproveurl($approveurl)
    {
        $this->approveurl = $approveurl;
    }

    /**
     * @param mixed $cancelurl
     */
    public function setCancelurl($cancelurl)
    {
        $this->cancelurl = $cancelurl;
    }

    /**
     * @param mixed $declineurl
     */
    public function setDeclineurl($declineurl)
    {
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