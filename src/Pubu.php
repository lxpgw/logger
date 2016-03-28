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

use yii\base\InvalidConfigException;
use yii\base\Object;
use yii\helpers\Json;

/**
 * Pubu.im adapter.
 *
 * ~~~~
 * $pubu = new Pubu(['remote' => 'http://service.pubu.im/dsad']);
 * $pubu->send('This is test');
 * ~~~
 *
 * @version 0.0.0
 *
 * @author lichunqaing <light-li@hotmail.com>
 */
class Pubu extends Object
{
    /**
     * @var string The target remote url send message to.
     */
    public $remote;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if (is_null($this->remote)) {
            throw new InvalidConfigException('$remote must be set.');
        }
    }

    /**
     * @param null|string $text
     * @param array       $attachments
     *
     * @return string
     */
    public function send($text = null, $attachments = [])
    {
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type:application/json',
                'content' => Json::encode($this->getPayload($text, $attachments)),
            ],
        ]);

        return file_get_contents($this->remote, false, $context);
    }

    /**
     * @param string $text
     * @param array  $attachments
     *
     * @return array
     */
    private function getPayload($text, $attachments)
    {
        if ($text == null) {
            $text = __CLASS__ . '::' . date('Y-m-d H:i');
        }
        $payload = [
            'text' => $text,
            'attachments' => $attachments,
            //'displayUser' => [
            //    'name' => 'FUckaer',
            //    'avatarUrl' => 'https://dn-facecdn.qbox.me/assets/1602030042/img/logo-sm.png'
            //]
        ];

        return $payload;
    }
}
