<?php

return [

    'api' => [
        'base_url' => "https://joinposter.com/api/",
        'token' => env('POSTER_AUTH_TOKEN'),
        'routes' => [
            'menu' => [
                'getCategories' => [
                    'url' => 'menu.getCategories',
                    'method' => 'GET',
                ],
                'getCategory' => [
                    'url' => 'menu.getCategory',
                    'method' => 'GET',
                ],
                'getIngredients' => [
                    'url' => 'menu.getIngredients',
                    'method' => 'GET',
                ],
                'getProducts' => [
                    'url' => 'menu.getProducts',
                    'method' => 'GET',
                ],
                'getProduct' => [
                    'url' => 'menu.getProduct',
                    'method' => 'GET',
                ],
            ],
            'spots' => [
                'getTableHallTables' => [
                    'url' => 'spots.getTableHallTables',
                    'method' => 'GET',
                ],
            ],
            'incomingOrders' => [
                'createIncomingOrder' => [
                    'url' => 'incomingOrders.createIncomingOrder',
                    'method' => 'POST',
                ],
            ]
        ]
    ],

    'classes' => [
        [
            'i' => \App\Poster\Menu\IRCategory::class, // interface => i
            'c' => \App\Poster\Menu\RCategory::class, // class => c
        ],
        [
            'i' => \App\Poster\Spot\IRSpot::class, // interface => i
            'c' => \App\Poster\Spot\RSpot::class, // class => c
        ],
        [
            'i' => \App\Poster\Menu\IRProduct::class, // interface => i
            'c' => \App\Poster\Menu\RProduct::class, // class => c
        ],
        [
            'i' => \App\Poster\IncomingOrder\IIncOrder::class, // interface => i
            'c' => \App\Poster\IncomingOrder\IncOrder::class, // class => c
        ],
    ]

];
