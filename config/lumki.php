<?php

return [
    "prefix" => 'lumki',
    "middleware" => ['web','auth:sanctum','can:manage users'],
    'custom_fields' => [
        // [
        //     'type' => 'text',
        //     'name' => 'username',
        //     'label' => 'Username',
        //     'placeholder' => 'Username',
        // ],
    ]
];
