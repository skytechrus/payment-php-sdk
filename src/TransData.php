<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.10.2017
 * Time: 13:12
 */

namespace Skytech;


class TransData
{
    public $rezultoperation;
    public $responcecode;
    public $responcedescription;
    public $responce;
    public $approvalcode; /** @var  transaction approval code */
    public $approvalcodestr; /** @var  transaction approval responce */
    public $threedsverification;
    public $transid;    /** @var transaction id */
    public function __construct()
    {
    }
}