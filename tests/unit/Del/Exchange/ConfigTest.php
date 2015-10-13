<?php

namespace Del;

use Codeception\TestCase\Test;
use Del\Exchange\Config;

class ConfigTest extends Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Config
     */
    protected $config;

    protected function _before()
    {
        $config = [
            'btce' => [
                'key' => 'blah',
                'secret' => 'blah',
            ],
        ];
        $this->config = new Config($config['btce']);
    }

    protected function _after()
    {
        unset($this->api);
    }

    /**
     * Check tests are working
     */
    public function testGetKeyAndSecret()
    {
        $this->assertEquals('blah',$this->config->getKey());
        $this->assertEquals('blah',$this->config->getSecret());
    }

    /**
     * Check tests are working
     */
    public function testThrowsExceptionWhenRubbishDataProvided()
    {
	    $this->setExpectedException('InvalidArgumentException');
        new Config([]);
    }


}
