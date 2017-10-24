<?php


class XMLDataPurchaseTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $operation;
    protected $xml_Purchase;

    protected function _before()
    {
        $order = new Skytech\Order();
        $transaction = new Skytech\TransData();
        $card = new Skytech\Customer\Card();
        $customeradds = new Skytech\Customer\Address();
        $customer = new Skytech\Customer($customeradds);
        $this->operation = new Skytech\Operation\Operation($order);
        $this->operation->setTransaction($transaction);
        $this->operation->setCard($card);
        $this->operation->setCustomer($customer);
        $this->xml_Purchase = new Skytech\DataProvider\XML\XMLDataPurchase($this->operation);

    }

    protected function _after()
    {
    }

    public function loadFileData($fileName)
    {
        $xml = simplexml_load_file($fileName);
        return $xml->asXML();
    }

    /**
     * @dataProvider providerResponse
     * @param $fileName
     * @param $operationName
     */
    public function testOperation($fileName, $operationName)
    {
        $xmlResponse = $this->loadFileData($fileName);
        $this->operation = $this->xml_Purchase->getResponseData($xmlResponse);
        $this->assertEquals($operationName, $this->operation->order->operation);
    }

    /**
     * @dataProvider providerforMaker
     */
    public function testgetRequestData($fileName, $currency, $value, $merchant, $orderid, $sessionId, $pan, $expmonth, $expyear)
    {
        // '810','22333','uber','12344','4321456776541234','09','2021'

        $this->operation->order->setMerchantid($merchant);
        $this->operation->order->setOrderid($orderid);
        $this->operation->order->setSessionid($sessionId);
        $this->operation->order->setCurrency($currency);
        $this->operation->order->setAmount($value);
        $this->operation->card->setPan($pan);
        $this->operation->card->setExpmonth($expmonth);
        $this->operation->card->setExpyear($expyear);
        $xmlrequest = $this->xml_Purchase->getRequestData();
        $xml = new SimpleXMLElement($xmlrequest);
        $this->assertEquals($merchant, $xml->xpath('//Merchant')[0]);
        $xml->asXML('c:\tmp\xml\TestResp.xml');
        $this->assertXmlFileEqualsXmlFile($fileName, 'c:\tmp\xml\TestResp.xml');

    }

    /**
     * @dataProvider providerStatus
     * @param $fileName
     * @param $operationName
     */
    public function testStatus($fileName, $status)
    {
        $xmlResponse = $this->loadFileData($fileName);
        $this->operation = $this->xml_Purchase->getResponseData($xmlResponse);
        $this->assertEquals($status, $this->operation->order->getStatus());
    }

    /**
     * @dataProvider providerApproval
     * @param $fileName
     * @param $approval
     * @param $approvalsrt
     * @param $pan
     */
    public function testApprovaldata($fileName, $approval, $approvalsrt, $pan)
    {
        $xmlResponse = $this->loadFileData($fileName);
        $this->operation = $this->xml_Purchase->getResponseData($xmlResponse);
        $this->assertEquals($approval, $this->operation->transaction->approvalcode);
        $this->assertEquals($approvalsrt, $this->operation->transaction->approvalcodestr);
        $this->assertEquals($pan, $this->operation->card->getPan());
    }

    public function providerResponse()
    {
        return [
            ['c:\tmp\xml\ResponsePurch1.xml', 'Purchase'],
            ['c:\tmp\xml\ResponsePurch2.xml', 'Purchase'],
            ['c:\tmp\xml\ResponsePurch3.xml', 'Purchase']
        ];
    }

    public function providerStatus()
    {
        return [
            ['c:\tmp\xml\ResponsePurch1.xml', '00'],
            ['c:\tmp\xml\ResponsePurch3.xml', '30']
        ];
    }

    public function providerApproval()
    {
        return [
            ['c:\tmp\xml\ResponsePurch1.xml', '473499 A', '473499', 'XXXXXXXXXX1903'],
            ['c:\tmp\xml\ResponsePurch2.xml', '473494 A', '473494', 'XXXXXXXXXX1905']
        ];
    }

    public function providerforMaker()
    {
        return [
            ['c:\tmp\xml\MyResponce1.xml', '810', '22333', 'uber', '12344', '9875444', '4321456776541234', '09', '2021']

        ];
    }
}
