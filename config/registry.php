<?php

return [
    'schemas' => [
        'rifcs' => [
            'provider' => App\Registry\ContentProvider\RIFCS\RIFCSContentProvider::class,
            'metadata' => [
                'core' => App\Registry\ContentProvider\RIFCS\Metadata\RIFCSCoreProvider::class,
                'identifiers' => App\Registry\ContentProvider\RIFCS\Metadata\RIFCSIdentifierProvider::class
            ]
        ],
        'json-ld' => [
            'provider' => App\Registry\ContentProvider\JSONLD\JSONLDContentProvider::class,
            'metadata' => [
                'core' => App\Registry\ContentProvider\JSONLD\Metadata\JSONLDCoreProvider::class,
            ]
        ],
        'igsn' => [
            'provider' => null,
            'metadata' => []
        ]
    ],
    'status' => [
        'current' => 'CURRENT',
        'draft' => 'DRAFT',
        'superceded' => 'SUPERCEDED'
    ]
];
