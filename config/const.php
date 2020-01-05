<?php
return [
    'file' => [
        'image' => [
            'dowload' => [
                'limit' => 10000000
            ]
        ]
    ],
    'env' => [
        'web_domain'                       => env('WEB_DOMAIN'),
        'tr_domain'                        => env('TR_DOMAIN'),
        'wr_domain'                        => env('WR_DOMAIN'),
        'auth_api_domain'                  => env('AUTH_API_DOMAIN'),
        'auth_api_version'                 => env('AUTH_API_VERSION'),
        'auth_api_http_schema'             => env('AUTH_API_HTTP_SCHEMA'),
    ],
    'paginate' => [
        'default_loading_column' => 20,
    ],
    'admin' => [
        'show_count' => 30
    ],
    
];
