<?php

$ttl = 1 || 60*100;

return [
    'products' => [
        'key' => 'products',
        'time' => $ttl,
    ],
    'categories' => [
        'key' => 'categories',
        'time' => $ttl,
    ],
];
