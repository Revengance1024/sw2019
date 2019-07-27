<?php

use Sw\DatabaseInterface;
use Sw\TestDatabase;

require __DIR__ . '/vendor/autoload.php';

$connection = new \Sw\RealDatabase();

$disc = new \Sw\Product\DiskProduct($connection);
$disc->setData(
    'disk-4',
    'DVD Disk',
    12.12,
    [
        'memory' => '700',
        'formFactor' => 'Small'
    ]
);
$disc->save();

$disc2 = new \Sw\Product\DiskProduct($connection);
$disc2->load('disk-4');
var_dump($disc2);


