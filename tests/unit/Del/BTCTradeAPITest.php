<?php

namespace Del;

use Codeception\TestCase\Test;

class BTCTradeApiTest extends Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var BTCTradeApi
     */
    protected $api;

    /**
     * @var array
     */
    protected $config;

    protected function _before()
    {
        $this->config = [
            'btce' => [
                'key' => 'blah',
                'secret' => 'blah',
            ],
        ];
        $this->api = new BTCTradeAPI($this->config);
    }

    protected function _after()
    {
        unset($this->config);
        unset($this->api);
    }

    /**
     * Check tests are working
     */
    public function testGetAndSetConfig()
    {
        $array = [
            'btce' => [
                'key' => 'blah',
                'secret' => 'blah',
            ],
        ];
        $this->api->setConfig($array);
        $this->assertEquals('blah',$this->api->getConfig()['btce']['key']);
    }

    /**
     * Check tests are working
     */
    public function testGetBtcEExchange()
    {
	    $this->assertInstanceOf('Del\Exchange\BtcE',$this->api->getBtcEExchange());
    }


}
