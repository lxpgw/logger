<?php

namespace lxpgw\logger;

use Yii;
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
 * @author lichunqaing <light-li@hotmail.com>
 */
class Pubu extends Object
{
    /**
     * @var string The target remote url send message to.
     */
    public $remote;

    /**
     * @param null|string $text
     * @param array $attachments
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
     * @param array $attachments
     *
     * @return array
     */
    private function getPayload($text, $attachments)
    {
        if ($text == null) {
            $text = Yii::$app->name;
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

