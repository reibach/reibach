<?php

'controllerMap' => [
    'batch' => [
        'class' => 'schmunk42\giiant\commands\BatchController',
        'overwrite' => true,
        'modelNamespace' => 'app\\modules\\crud\\models',
        'crudTidyOutput' => true,
    ]
],
