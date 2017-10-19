<?php


use Skytech\URL_Settings;

class URL_SettingsTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    protected $url_settigs;

    protected function _before()
    {
        $this->url_settigs = new URL_Settings();
    }

    protected function _after()
    {
    }

    /**
     * @dataProvider  providerUrl
     */
    public function testApprovalURL($url,$expect)
    {
      if (!$expect)
      {
          $this->expectException(UnexpectedValueException::class);
          $this->url_settigs->setApproveurl($url);
      }
      $this->url_settigs->setApproveurl($url);
      $this->assertEquals($url,$this->url_settigs->getApproveurl());
    }
    public function providerUrl()
    {
        return [
            ['load from here',false],
            ['load_from_here.php',true],
            ['сайт.рф',true],
            ["http:\\site.ru/en/index.html",false],
            ['http://site.ru/en/index.html',true],
            ['183.49.3.983',true]
        ];
    }
}