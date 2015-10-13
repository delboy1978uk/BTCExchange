<?php
/**
 * User: delboy1978uk
 * Date: 14/08/15
 * Time: 15:56
 */

namespace Del;

use Del\Exchange\BtcE;
use Del\Exchange\Config;


class BTCTradeAPI
{
    /** @var array */
    private $config;

    public function __construct(array $config)
    {
        $this->setConfig($config);
    }

    /**
     * @return string
     */
    public function getBtcEExchange()
    {
        $config = new Config($this->config['btce']);
        return new BtcE($config);
    }

    /**
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }


}