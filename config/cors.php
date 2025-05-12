<?php
return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // thêm endpoint nếu cần
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // hoặc ['http://localhost:3000'] nếu chỉ cho phép React
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
