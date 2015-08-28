<?php

namespace Del;

class BTCExchangeTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var BTCExchange
     */
    protected $btc;

    protected function _before()
    {
        // create a fresh btcexchange class before each test
        $this->btc = new BTCExchange();
    }

    protected function _after()
    {
        // unset the btcexchange class after each test
        unset($this->calc);
    }

    /**
     * Check tests are working
     */
    public function testBlah()
    {
	    $this->assertEquals('Ready to start building tests',$this->btc->blah());
    }


}
