<?php
return [
	'language' => 'de_DE',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	 'components' => [
		'i18n' => [
			  'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
			],
		],
	],
];	
