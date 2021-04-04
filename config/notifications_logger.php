<?php

return [
    'system_mapping' => [
        'subject_system' => [
            '/Hello, ([a-z]*)/i' => 'my-system-1',
        ],
    ],
    'routes' => [
        'api' => [
            'prefix' => '',
            'middleware' => [],
        ],
    ],
];
