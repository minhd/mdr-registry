<?php


namespace App\Registry\ContentProvider\JSONLD;


abstract class JSONLDMetadataExtractor
{
    // json-ld string for a single record
    protected $content;

    // json array document
    protected $doc = null;

    /**
     * JSONLDMetadataExtractor constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;

        $this->doc = json_decode($content, true);
    }


    abstract public function handle();
}
