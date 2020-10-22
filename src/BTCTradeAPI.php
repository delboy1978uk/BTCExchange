<?php

namespace Del;

use Del\Exchange\Binance;
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
        $key = $this->config['binance']['key'];
        $secret = $this->config['binance']['secret'];

        return new Binance\API($key, $secret);
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