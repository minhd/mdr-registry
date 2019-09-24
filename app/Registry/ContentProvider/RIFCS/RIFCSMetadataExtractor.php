<?php


namespace App\Registry\ContentProvider\RIFCS;


use Exception;
use SimpleXMLElement;

abstract class RIFCSMetadataExtractor
{
    // normally the rifcs for a single record
    protected $content;

    // important to store this, because of specific rifcs xpath
    protected $class;

    /** @var SimpleXMLElement */
    protected $simpleXML;

    /**
     * RIFCSMetadataExtractor constructor.
     * @param $payload
     */
    public function __construct($payload)
    {
        $this->content = $payload;
        $this->getSimpleXML();
        $this->determineClass();
    }

    abstract public function handle();

    /**
     * Building the simple XML for use across other providers
     *
     * TODO Refactor
     * @return SimpleXMLElement
     */
    private function getSimpleXML()
    {
        libxml_use_internal_errors(true);
        $xml = $this->content;

        if (!defined('LIBXML_PARSEHUGE')) {
            $xml = simplexml_load_string($xml, 'SimpleXMLElement');
        } else {
            $xml = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_PARSEHUGE);
        }

        if ($xml === false) {
            $exception_message = "Could not parse Registry Object XML";
            foreach (libxml_get_errors() as $error) {
                $exception_message .= "    " . $error->message;
            }
            libxml_use_internal_errors(false);
            throw new Exception($exception_message);
        }

        $xml->registerXPathNamespace("ro", "http://ands.org.au/standards/rif-cs/registryObjects");

        $this->simpleXML = $xml;

        return $this->simpleXML;
    }

    /**
     * Determine the class of the record
     *
     * @return mixed|null
     */
    private function determineClass()
    {
        $classes = ['collection', 'party', 'service', 'activity'];
        $class = null;
        foreach ($classes as $try) {
            $element = $this->simpleXML->xpath('//ro:registryObject/ro:' . $try);
            if ($element) {
                $class = $try;
            }
        }

        $this->class = $class;
        return $class;
    }
}
