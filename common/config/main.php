<?php
return [
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'bootstrap' => [
        'queue', // The component registers its own console commands
    ],
    'components' => [
        //jwt token
        'apiTokens' => [
            'class'           => \Kakadu\Yii2JwtAuth\ApiTokenService::class,
            'secretKey'       => '', // set in main-local.php or yii-params.domainSecretKey
            'issuer'          => 'you-domain-name', // or yii-params.domain
            'audience'        => ['you-domain-name', 'second-domain-name'], // or yii-params.domain
            'audienceSecrets' => [
                'you-domain-name'    => '', // or yii-params.domainSecretKey
                'second-domain-name' => '', // or yii-params.secondDomainSecretKey
            ],
            'seamlessLogin'   => false,
        ],
        //add redis
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => 'localhost',
            'port' => 6379,
            'database' => 0,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '--',
            'defaultTimeZone' => 'Asia/Shanghai',
            'dateFormat' => 'yy/M/d',
            'datetimeFormat' => 'yy/M/d HH:mm',
        ],
        'config' => [
            'class' => 'abhimanyu\config\components\Config', // Class (Required)
            'db' => 'db',                                 // Database Connection ID (Optional)
            'tableName' => '{{%config}}',                        // Table Name (Optioanl)
            'cacheId' => 'cache',                              // Cache Id. Defaults to NULL (Optional)
            'cacheKey' => 'config.cache',                       // Key identifying the cache value (Required only if cacheId is set)
            'cacheDuration' => 100                                   // Cache Expiration time in seconds. 0 means never expire. Defaults to 0 (Optional)
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'db' => 'db', // DB connection component or its config
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex used to sync queries
        ],
        // 'session' => [
        //     'class' => 'yii\web\DbSession',
        //     // 'db' => 'db',
        //     // 'sessionTable' => 'session',
        //     'timeout'=>24*3600,
        // ],
        'log' => [
            'traceLevel' => 3,
            'targets' => [
                'app' => [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning', 'info'],
                    'logVars' => ['_GET', '_POST', '_SESSION'],
                    'except' => [
                        'api',
                        'yii\base\UserException',
                        'yii\db\*',
                    ],
                ],
                'email' => [
                    'class' => 'yii\log\EmailTarget',
                    'mailer' => 'mailer',
                    'levels' => ['error'],
                    'except' => [
                        'yii\base\UserException',
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:400',
                        'yii\web\HttpException:403',
                        'common\base\*',
                    ],
                    'logVars' => ['_GET', '_POST', '_SESSION'],
                    'message' => [
                        'from' => ['378400622@qq.com'],
                        'to' => ['378400622@qq.com'],
                        'subject' => '错误日志邮件通知',
                    ],
                ],
                'db' => [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['error', 'warning'],
                    'logVars' => ['_GET', '_POST', '_SESSION'],
                    'except' => [
                        'yii\base\UserException',
                        'yii\web\HttpException:404',
                        'yii\web\HttpException:400',
                        'yii\web\HttpException:403',
                        'common\base\*',
                    ],
                ],
            ],
        ],
    ],
];
