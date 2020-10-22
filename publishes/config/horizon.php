<?php

return [
'environments' => [
    'production' => [

        // ...

        'event-sourcing-supervisor-1' => [
            'connection' => 'redis',
            'queue' => [env('EVENT_PROJECTOR_QUEUE_NAME')],
            'balance' => 'simple',
            'processes' => 1,
            'tries' => 3,
        ],
    ],

    'local' => [

        // ...

        'event-sourcing-supervisor-1' => [
            'connection' => 'redis',
            'queue' => [env('EVENT_PROJECTOR_QUEUE_NAME')],
            'balance' => 'simple',
            'processes' => 1,
            'tries' => 3,
        ],
    ],
],
];