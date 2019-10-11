<?php

return [

    'admin_user_email' => env('SPLIT_ADMIN_USER_EMAIL'),
    'nano' => [
        'node_uri' => env('SPLIT_NANO_NODE_URI', '127.0.0.1:7076'),
        'seed' => env('SPLIT_NANO_SEED', null),
        'representative' => env('SPLIT_NANO_REPRESENTATIVE', null),
    ],

];
