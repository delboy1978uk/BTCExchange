<?php

namespace Del\Exchange;


interface ExchangeInterface
{
    /**
     * @param null|Config $config
     */
    public function __construct(Config $config);

    /**
     * @param Config $config
     * @return ExchangeInterface
     */
    public function setConfig(Config $config);

    /**
     * @param $uri
     * @param array $params
     * @return mixed
     */
    public function send($uri,array $params = []);

    /**
     * @param $amt
     * @param $price
     * @return mixed
     */
    public function buyOrder($amt,$price);

    /**
     * @param $amt
     * @param $price
     * @return mixed
     */
    public function sellOrder($amt,$price);

    /**
     * @param $orderid
     * @return mixed
     */
    public function cancelOrder($orderid);

    public function getOrders();

    public function getTransactionHistory();

    public function getTicker();

    public function getOrderBook();

    public function setClient();

}