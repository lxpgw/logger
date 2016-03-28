Logger
========
[![Build Status](https://img.shields.io/travis/lichunqiang/logger.svg?style=flat-square)](http://travis-ci.org/lichunqiang/logger)
[![version](https://img.shields.io/packagist/v/lxpgw/logger.svg?style=flat-square)](https://packagist.org/packages/lxpgw/logger)
[![Download](https://img.shields.io/packagist/dt/lxpgw/logger.svg?style=flat-square)](https://packagist.org/packages/lxpgw/logger)
[![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/lichunqiang/logger.svg?style=flat-square)](https://scrutinizer-ci.com/g/lichunqiang/logger)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/lichunqiang/logger.svg?style=flat-square)](https://scrutinizer-ci.com/g/lichunqiang/logger)
[![Contact](https://img.shields.io/badge/weibo-@chunqiang-blue.svg?style=flat-square)](http://weibo.com/chunqiang)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist lxpgw/logger "~1.0.0"
```

or add

```
"lxpgw/logger": "~1.0.0"
```

to the require section of your `composer.json` file.

Usage
-----

### send message directly

```
$pubu = new \lxpgw\logger\Pubu(['remote' => 'your pubu.im service url']);
$logger->send('Hello');

//with attachments
$pubu->send('Hello', [
    ['title' => 'This is title', 'description' => 'This is description.']
]);
```

### with the `log` component

```
[
    'log' => [
        'targets' => [
            'class' => \lxpgw\logger\LogTarget,
            'chanel' => 'the pubu.im service url', // Config the channel you want send to.
            'exportInterval' => 1, //send per message directly
            'logVars' => [],
        ]
    ]
]
```



Tests
-----

```
$ composer test
```

Change Log
----------

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

License
-------
[![MIT](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE)

