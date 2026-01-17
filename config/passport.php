<?php

return [

    'guard' => 'api', // ⬅️ แก้ด้วย (สำคัญ)

    'private_key' => null,
    'public_key'  => null,

    'connection' => env('PASSPORT_CONNECTION'),

];
