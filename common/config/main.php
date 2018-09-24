<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'pt-br',
    'language' => 'pt-br',
    'timeZone' => 'America/Manaus',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd/MM/yyyy',
            'locale' => 'pt-BR',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'R$',
            'nullDisplay' => '',
		],
    ],
];
