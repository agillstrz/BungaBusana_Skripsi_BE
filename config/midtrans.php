<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),

    'payment_options' => [
        'finish_redirect_url' =>  'https://chat.openai.com', // Replace with your desired redirect URL after payment completion
    ],
];