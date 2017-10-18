<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 16.10.2017
 * Time: 11:44
 */

namespace Skytech;
//include 'example.php';


class XMLDataOrderPurchTest extends \PHPUnit_Framework_TestCase
{
  public $purchase;
  public $operation;
public $xmltext = <<< XML
<?xml version='1.0' encoding='UTF-8'?>
<TKKPG>
<Response>
<Operation>CreateOrder</Operation>
<Status>00</Status>
<Order>
<OrderID>828</OrderID>
<SessionID>ECDE79578768ECFBF2897A0F44CC0CEF</SessionID>
<URL>PayGateURL</URL>
</Order>
</Response>
</TKKPG>
XML;
  protected function setUp()
  {
      $order = new Order();
      $this->purchase = new Operation($order);

  }
  public function ReadXMLOperation(){
      $opdata  = new XMLDataOrderPurch($this->purchase);
      $this->purchase = $opdata->getResponseData($this->xmltext);
      $operation = $this->purchase->order->operation;
      $this->assertEquals('CreateOrder', $operation);
  }
  public function CheckURL()
  {
      $opdata  = new XMLDataOrderPurch($this->purchase);
      $this->purchase = $opdata->getResponseData($this->xmltext);
      $url_line = $this->purchase->order->getUrl();
      $this->assertEquals('PayGateURL', $url_line);
  }

}
