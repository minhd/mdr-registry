<?php

return [
    'schemas' => [
        'rifcs' => [
            'provider' => App\Registry\ContentProvider\RIFCS\RIFCSContentProvider::class
        ],
        'json-ld' => [
            'provider' => App\Registry\ContentProvider\JSONLD\JSONLDContentProvider::class
        ]
    ]
];
