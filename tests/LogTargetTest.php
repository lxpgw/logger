<?php

/*
 * This file is part of the lxpgw/logger.
 *
 * (c) lichunqiang <light-li@hotmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace lxpgw\logger;

use Yii;
use yii\log\Logger;

class LogTargetTest extends \PHPUnit_Framework_TestCase
{
    public function testSenderViaLogger()
    {
        $logger = Yii::createObject([
            'class' => LogTarget::class,
            'channel' => REMOTE,
        ]);
        $logger->messages = [
            ['Message body', Logger::LEVEL_ERROR, 'category', microtime(true), []],
        ];
        $logger->export();
    }
}
