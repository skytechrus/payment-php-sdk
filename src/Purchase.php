<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 03.10.2017
 * Time: 12:50
 */

namespace Skytech;
include 'example.php';


class Purchase
{
    private $MerId; /** Merchant Id */
    private $Version; /** Version No */
    private $Status_code;
    private $Status_Description;
    private $Orderid;
    private $SessionId;
    private $Language; /** Interface language (EN, RU, UK, ..) */
    private $TransDateTime;
    private $VisualAmount;  /**   Operation amount for customer*/
    private $PurchaseAmount; /** Operation amount*/
    private $Currency;   /** Operation currency (840, 810 )*/
    private $Description; /** Operation desciption */
    private $CustomerId;  /** */
    private $FirstName;
    private $LastName;
    private $MiddleName;
    private $EmailAddr;
    private $Country;
    private $City;
    private $Address;
    private $Phone;
    private $ZIP;
    private $Brand;
    private $Name;
    private $ThreeDSStatus;
    //
    private $PAN;
    private $ExpMonth;
    private $ExpYear;
    private $FEE;
    private $TransactionType;
    private $AprovalCode;
    private $ApprovalCodeStr;
    private $ThreeDSVerification;
    private $RezultOperation;
    private $ResponceCode;
    private $ResponceDescription;
    private $Responce;
    private $AccFee;
    private $MerchantTranId;
    private $Responce_f;
    private $xid;
    private $CalculatedCAVV;
    private $RRN;
    private $RRN2;
    private $HEXCAVV;
    /**
     * Purchase constructor.
     */
    public function __construct()
    {
        $this->Language = $_POST["language"];
        $this->Orderid = $_POST["orderid"];
        $this->Brand = $_POST["brand"];
        $this->PurchaseAmount = $_POST["amount"];
        $this->Description = $_POST["description"];
        $this->Currency = $_POST["currency"];


    }
    public function SetStatus($Stat)
    {
        $this->Status_code = $Stat;
    }
    public function SetMerchantId($MerchantId)
    {
        $this->MerId = $MerchantId;
    }
    public function GetAuthorisationData($xmlresponce)
    {
        $AuthResp = new SimpleXMLElement($xmlresponce);
        $this->$ResponceCode = $AuthResp->message->ResponseCode ;
        $this->$ResponceDescription = $AuthResp->message->ResponseDescription;
        $this->$Approvalcode = $AuthResp->message->ApprovalCode;
        $this->$ApprovalCodeStr = $AuthResp->message->ApprovalCodeScr;
        $this->$ThreeDSVerification = $AuthResp->message->ThreeDSVerificaion;
        $this->$ThreeDSStatus = $AuthResp->message->ThreeDSStatus;
    }
    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        echo "__set, property - {$name} is not exists \n";
    }
    public function __get($name)
    {
        // TODO: Implement __get() method.
        echo "__get, property - {$name} is not exists \n";
    }

}

