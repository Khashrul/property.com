<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '1jcWrIkkOfotGOFJBYaJbgFep5CuODML',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Admin',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
//            'viewPath' => '@app/mail',
            'useFileTransport' => false,
//            'transport' => [
//                'class' => 'Swift_SmtpTransport',
//                'host' => 'localhost',
//                'username' => 'username',
//                'password' => 'password',
//                'port' => '587',
//                'encryption' => 'tls',
//            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning','trace'],
                    'logFile' => '@runtime/logs/404.log',
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'contact-us' => 'site/contactus',
                'submit-property' => 'property/submitproperty',
                'update-property/<property_id>' => 'property/updateproperty',
                'agency-details/<agency_id>' => 'site/agencydetails',
                'agencies-listing' => 'site/agencieslisting',
                'search-result' => 'site/searchproperty',
                'my-offer' => 'profile/myoffer',
                'my-profile' => 'profile/myprofile',
                'payment-selection' => 'profile/selectpayment',
//                'order-management'=>'profile/OrderManagement',
                'payment-processor'=>'profile/paymentprocessor',
                'subscription-upgrade'=>'profile/upgradesubscription',
                'transaction-status'=>'profile/transactionstatus',
                'transaction-failure'=>'profile/transactionfailure',
                'transaction-cancel'=>'profile/transactioncancel',
                'reset-password'=>'site/resetpassword',
                'filter-grid'=>'site/filtergridproperty',
                'filter-list'=>'site/filterlistproperty',
                'price-plan'=>'site/priceplan',
                'success'=>'profile/success',
                'terms-&-conditions'=>'site/termsandconditions',
                '<property_type:(apartment|house|commercial|land)>' => 'site/listinggridproperty',
                '<property_type>/list' => 'site/listinglistproperty',
                '<property_type:(apartment|house|commercial|land)>/<property_alias>' => 'site/propertydetails',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    /*$config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',*/
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    //];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
