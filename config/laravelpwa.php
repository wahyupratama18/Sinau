<?php

return [
    'name' => env('APP_NAME', 'LaravelPWA'),
    'manifest' => [
        'name' => env('APP_NAME', 'My PWA App'),
        'short_name' => 'Pinter',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#487eb0',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'blue',
        'icons' => [
            '72x72' => [
                'path' => '/storage/logos/just-icon/72/BLUE.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/storage/logos/just-icon/96/BLUE.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/storage/logos/just-icon/128/BLUE.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/storage/logos/just-icon/144/BLUE.png',
                'purpose' => 'any'
            ],
            /* '152x152' => [
                'path' => '/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
                'purpose' => 'any'
            ], */
        ],
        'splash' => [
            '36x72' => '/storage/logos/reel/72/blue-no-shadow.png',
            '48x96' => '/storage/logos/reel/96/blue-no-shadow.png',
            '64x129' => '/storage/logos/reel/128/blue-no-shadow.png',
            '72x145' => '/storage/logos/reel/144/blue-no-shadow.png',
            /* '1242x2208' => '/images/icons/splash-1242x2208.png',
            '1242x2688' => '/images/icons/splash-1242x2688.png',
            '1536x2048' => '/images/icons/splash-1536x2048.png',
            '1668x2224' => '/images/icons/splash-1668x2224.png',
            '1668x2388' => '/images/icons/splash-1668x2388.png',
            '2048x2732' => '/images/icons/splash-2048x2732.png', */
        ],
        'shortcuts' => [
            /* [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ] */
        ],
        'custom' => []
    ]
];
