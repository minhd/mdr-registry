<?php


namespace App\Registry\ContentProvider\RIFCS;


use App\Registry\ContentProvider\ContentProvider;
use App\Registry\ContentProvider\RIFCS\Metadata\RIFCSCoreProvider;
use App\Registry\ContentProvider\RIFCS\Metadata\RIFCSIdentifierProvider;

class RIFCSContentProvider extends ContentProvider
{
    public function extract($payload)
    {
        $providers = config("registry.schemas.rifcs.metadata");

        $metadata = [];
        foreach ($providers as $key => $provider) {
            $instance = new $provider($payload);
            $value = call_user_func([$instance, 'handle']);
            $metadata[$key] = $value;
            unset($instance);
        }

        return $metadata;
    }
}
