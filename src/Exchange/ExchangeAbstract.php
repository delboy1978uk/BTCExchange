<?php

namespace Del\Exchange;

use GuzzleHttp\Client;

abstract class ExchangeAbstract implements ExchangeInterface
{
    /** @var Config $config */
    protected $config;

    /** @var Client  */
    protected $client;

    /**
     * @param null|Config $config
     */
    public function __construct(Config $config)
    {
        $this->setConfig($config);
        $this->setClient();
    }

    abstract public function setClient();

    /**
     * @param Config $config
     * @return ExchangeInterface
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * @param $amt
     * @param $price
     * @return mixed
     */
    abstract public function buyOrder($amt, $price);

    /**
     * @param $amt
     * @param $price
     * @return mixed
     */
    abstract public function sellOrder($amt, $price);

    /**
     * @param $orderid
     * @return mixed
     */
    abstract public function cancelOrder($orderid);

    abstract public function getOrders();

    abstract public function getTransactionHistory();

    abstract public function getTicker();

    abstract public function send($uri, array $params = []);

}