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
    public function getBinanceExchange()
    {
        $config = new Config($this->config['binance']);

        return new Binance($config);
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