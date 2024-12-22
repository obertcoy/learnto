<?php

return [
    'credentials' => [
        'path' =>  env('FIREBASE_CREDENTIALS'),
    ],
    'storage' => [
        'bucket' => env('FIREBASE_STORAGE_BUCKET'),
    ]
];

