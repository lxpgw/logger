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
use yii\log\Target;

/**
 * ~~~
 * 'log' => [
 *      'traceLevel' => 3,
 *      'targets' => [
 *          [
 *              'class' => LogTarget::class,
 *              'categories' => ['category1'],
 *              'exportInterval' => 1, //send every message
 *              'logVars' => [],
 *          ]
 *      ]
 * ]
 * ~~~.
 *
 * @version 0.0.0
 *
 * @author lichunqaing <light-li@hotmail.com>
 */
class LogTarget extends Target
{
    /**
     * @var string The channel of the message send to.
     */
    public $channel;
    /**
     * @var string The logger title.
     */
    public $title;
    /**
     * @var Pubu
     */
    public $robot;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->robot = Yii::createObject([
            'class' => Pubu::class,
            'remote' => $this->channel,
        ]);
    }

    /**
     * Exports log [[messages]] to a specific destination.
     */
    public function export()
    {
        $this->robot->send($this->title ?: 'Logger', $this->getAttachments());
    }

    /**
     * ~~~
     * [
     *     'title' => 'this is title',
     *     'description' => 'this is description',
     *     'url' => 'http://www.baidu.com',
     *     'color' => 'success'
     * ]
     * ~~~.
     *
     * @return array
     */
    private function getAttachments()
    {
        $attachments = [];
        foreach ($this->messages as $i => $message) {
            $attachment = [
                'title' => $message[2], //category as title
                'description' => htmlspecialchars($this->formatMessage($message)),
                'color' => $this->getLevelColor($message[1]),
            ];
            $attachments[] = $attachment;
        }

        return $attachments;
    }

    /**
     * @param int $level
     *
     * @return string
     */
    private function getLevelColor($level)
    {
        $colors = [
            Logger::LEVEL_ERROR => 'error',
            Logger::LEVEL_WARNING => 'warning',
            Logger::LEVEL_INFO => 'info',
            Logger::LEVEL_PROFILE => 'primary',
            Logger::LEVEL_TRACE => 'muted',
        ];
        if (!isset($colors[$level])) {
            return 'success';
        }

        return $colors[$level];
    }
}
