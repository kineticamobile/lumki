<?php

return [
    "prefix" => 'lumki',
    "middleware" => ['web','auth:sanctum','can:manage users']
];
