<?php


namespace App\Registry\ContentProvider\JSONLD\Metadata;

use App\Registry\ContentProvider\JSONLD\JSONLDMetadataExtractor;

class JSONLDCoreProvider extends JSONLDMetadataExtractor
{
    public function handle()
    {
        return [
            'type' => $this->doc['@type'],
            'name' => $this->doc['name'],
            'url' => $this->doc['url']
        ];
    }
}
