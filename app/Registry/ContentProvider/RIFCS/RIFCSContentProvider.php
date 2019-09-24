<?php


namespace App\Registry\ContentProvider\RIFCS;


use App\Registry\ContentProvider\ContentProvider;

class RIFCSContentProvider extends ContentProvider
{
    public function extract($payload)
    {
        return [
            'title' => 'something'
        ];
    }
}
