<?php


namespace App\Registry\ContentProvider\JSONLD;


use App\Registry\ContentProvider\ContentProvider;

class JSONLDContentProvider extends ContentProvider
{
    public function extract($payload)
    {
        return [
            'title' => 'something'
        ];
    }
}
