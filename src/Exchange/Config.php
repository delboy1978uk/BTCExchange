<?php
/**
 * User: delboy1978uk
 * Date: 10/09/15
 * Time: 15:47
 */

namespace Del\Exchange;


use InvalidArgumentException;

class Config
{
    private $key;
    private $secret;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        if(!isset($config['key']) || !isset($config['secret'])) {
            throw new InvalidArgumentException('Array does not contain both key and secret.');
        }
        $this->key = $config['key'];
        $this->secret = $config['secret'];
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }


}