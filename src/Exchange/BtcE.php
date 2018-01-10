<?php

namespace Del\Exchange;

use GuzzleHttp\Client;

class BtcE extends ExchangeAbstract
{
    private $nonce = false;


    /**
     * @param $uri
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function send($uri, array $params = [])
    {
        if(!$this->nonce) {

            $nonce = explode(' ', microtime());
            $this->nonce = + $nonce[1].($nonce[0] * 1000000);
            $this->nonce = substr($this->nonce,5);

            $this->nonce = explode(' ', microtime())[1];
//            $this->nonce = (int) 10000 * microtime(true);
        } else {
            $this->nonce ++ ;
        }


        $params['nonce'] = $this->nonce;
        $params['method'] = $uri;

        // generate the POST data string
        $post_data = http_build_query($params, '', '&');
        $sign = hash_hmac('sha512', $post_data, $this->config->getSecret());



        $headers = [
            'Sign: '.$sign,
            'Key: '.$this->config->getKey(),
        ];


        static $ch = null;
        if (is_null($ch)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; BTCE PHP client; '.php_uname('s').'; PHP/'.phpversion().')');
        }
        curl_setopt($ch, CURLOPT_URL, 'https://wex.nz/tapi/');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        // run the query
        $res = curl_exec($ch);
        if ($res === false) throw new \Exception('Could not get reply: '.curl_error($ch));
        $dec = json_decode($res, true);
        if (!$dec) throw new \Exception('Invalid data received, please make sure connection is working and requested API exists');
        if($dec['success'] == 0) {
            throw new \Exception($dec['error']);
        }
        return $dec['return'];

    }

    /**
     *
     */
    public function setClient()
    {
        $this->client = new Client(['base_uri' => 'https://wex.nz/tapi/']);
    }

    /**
     * @param $btc
     * @param $price
     * @return mixed
     * @throws \Exception
     */
    public function buyOrder($btc, $price)
    {
        return $this->send('Trade',[
            'pair' => 'btc_usd',
            'type' => 'buy',
            'rate' => $price,
            'amount' => $btc
        ]);
    }

    /**
     * @param $btc
     * @param $price
     * @return mixed
     * @throws \Exception
     */
    public function sellOrder($btc, $price)
    {
        return $this->send('Trade',[
            'pair' => 'btc_usd',
            'type' => 'sell',
            'rate' => $price,
            'amount' => $btc
        ]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getInfo()
    {
        return $this->send('getInfo');
    }

    /**
     * @return mixed
     */
    public function getTicker()
    {
        return json_decode($this->client->get('https://wex.nz/api/3/ticker/btc_usd')->getBody()->getContents(), true);
    }


    /**
     * @return array
     */
    public function getOrderBook($pair = 'btc_usd')
    {
        return json_decode($this->client->get('https://wex.nz/api/3/depth/' . $pair)->getBody()->getContents(), true);
    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public function getOrders()
    {
        return $this->send('ActiveOrders',[
            'pair' => 'btc_usd'
        ]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTransactionHistory()
    {
        return $this->send('TransHistory',[]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTradeHistory()
    {
        return $this->send('TradeHistory',[]);
    }


    /**
     * @param $order_id
     * @return mixed
     * @throws \Exception
     */
    public function cancelOrder($order_id)
    {
        return $this->send('CancelOrder',[
            'order_id' => $order_id
        ]);
    }


}