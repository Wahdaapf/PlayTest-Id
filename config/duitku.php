<?php

return [
    'merchant_code' => env('DUITKU_MERCHANT_CODE'),
    'api_key' => env('DUITKU_API_KEY'),
    'mode' => env('DUITKU_MODE', 'sandbox'),

    'base_url' => env('DUITKU_MODE') === 'production'
        ? 'https://passport.duitku.com'
        : 'https://sandbox.duitku.com',
];