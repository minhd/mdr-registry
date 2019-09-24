<?php


namespace App\Registry\ContentProvider\RIFCS\Metadata;


use App\Registry\ContentProvider\RIFCS\RIFCSMetadataExtractor;
use SimpleXMLElement;

class RIFCSCoreProvider extends RIFCSMetadataExtractor
{
    public function handle()
    {
        $class = $this->class;
        $key = (string) $this->simpleXML->xpath('//ro:registryObject/ro:key')[0];
        $type = (string) $this->simpleXML->xpath("//ro:registryObject//ro:$class")[0]['type'];
        $group = (string) $this->simpleXML->xpath("//ro:registryObject")[0]['group'];

        return [
            'key' => $key,
            'class' => $this->class,
            'type' => $type,
            'group' => $group
        ];
    }
}
