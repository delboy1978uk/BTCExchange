<?php
/**
 * User: delboy1978uk
 * Date: 09/10/15
 * Time: 17:30
 */

namespace Del;

use Codeception\TestCase\Test;
use Del\Exchange\BtcE;
use Del\Exchange\Config;

class BtcETest extends Test
{
    /**
     * @var BtcE
     */
    protected $api;

    protected function _before()
    {
        if(!$this->api) {
            $config = require('tests/unit/settings.php');
            $config = new Config($config['btce']);
            $this->api = new BtcE($config);
        }

    }

    protected function _after()
    {
        sleep(1);
    }

    public function testGetInfo()
    {
        $info = $this->api->getInfo();
        $this->assertContains('funds', $info);
        $this->assertContains('rights', $info);
        $this->assertContains('transaction_count', $info);
        $this->assertContains('open_orders', $info);
        $this->assertContains('server_time', $info);

        $funds = $info['funds'];
        $this->assertContains('usd', $funds);
        $this->assertContains('btc', $funds);
        $this->assertContains('ltc', $funds);
    }

    public function testBuyOrder()
    {
        $this->setExpectedException('Exception', 'Price per BTC must be greater than 0.1 USD.');
        $this->api->buyOrder(1,0.0001);
    }

    public function testSellOrder()
    {
        $this->setExpectedException('Exception', 'Price per BTC must be less 3200 USD.');
        $this->api->sellOrder(1,1000000);
    }

    public function testGetOrders()
    {
        $this->setExpectedException('Exception', 'no orders');
        $this->api->getOrders();
    }

    public function testCancelOrder()
    {
        $this->setExpectedException('Exception', 'bad status'); // not our order to cancel
        $this->api->cancelOrder(123);
    }

    public function testGetTransactionHistory()
    {
        $this->setExpectedException('Exception', 'no transactions');
        $this->api->getTransactionHistory();
    }

    public function testGetTradeHistory()
    {
        $this->setExpectedException('Exception', 'no trades');
        $this->api->getTradeHistory();
    }


    public function testGetTicker()
    {
        $this->api->getInfo();
        $this->api->getInfo(); // these two lines for complete code coverage
        $tick = $this->api->getTicker();
        $this->assertNotEmpty($tick);
        $this->assertNotEmpty($tick['btc_usd']);
    }
}