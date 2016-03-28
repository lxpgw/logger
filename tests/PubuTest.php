<?php

namespace light\logger;

use lxpgw\logger\Pubu;

class SkeletonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testInstance()
    {
        $instance = new Pubu();
    }

    //public function testSendBadUrl()
    //{
    //    //$instance = new Pubu([
    //    //    'remote' => 'http://not-exists.com'
    //    //]);
    //    //$instance->send('test');
    //    $this->markTestIncomplete('此测试尚未实现');
    //}

    public function testSendDefaultText()
    {
        $instance = new Pubu([
            'remote' => REMOTE
        ]);
        $instance->send();
    }
}
