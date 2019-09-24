<?php


namespace App\Registry\ContentProvider\RIFCS\Metadata;


use App\Registry\ContentProvider\RIFCS\RIFCSMetadataExtractor;

class RIFCSIdentifierProvider extends RIFCSMetadataExtractor
{
    public function handle()
    {
        $identifiers = [];
        foreach ($this->simpleXML->xpath("ro:registryObject/ro:{$this->class}/ro:identifier") AS $identifier) {
            $value = trim((string)$identifier);
            if ($value == "") {
                continue;
            }
            $type = trim((string)$identifier['type']);
            $identifiers[] = ['type' => $type, 'value' => $value];
        }
        return $identifiers;
    }
}
