<?php

/*
 * This file is part of the lxpgw/logger.
 *
 * (c) lichunqiang <light-li@hotmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace light\logger;

use lxpgw\logger\Pubu;

class PubuTest extends \PHPUnit_Framework_TestCase
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
            'remote' => REMOTE,
        ]);
        $instance->send();
    }
}
