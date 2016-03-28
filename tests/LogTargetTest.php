<?php

namespace lxpgw\logger;

use Yii;
use yii\console\Application;
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
            ['Message body', Logger::LEVEL_ERROR, 'category', microtime(true), []]
        ];
        $logger->export();
    }
}

