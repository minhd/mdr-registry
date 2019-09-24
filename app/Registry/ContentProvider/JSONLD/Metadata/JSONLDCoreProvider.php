<?php


namespace App\Registry\ContentProvider\JSONLD\Metadata;

use App\Registry\ContentProvider\JSONLD\JSONLDMetadataExtractor;

class JSONLDCoreProvider extends JSONLDMetadataExtractor
{
    public function handle()
    {
        return [
            'title' => $this->doc['name'],
            'type' => $this->doc['@type'],
            'url' => $this->doc['url']
        ];
    }
}
