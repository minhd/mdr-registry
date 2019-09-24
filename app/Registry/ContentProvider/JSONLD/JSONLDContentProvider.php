<?php


namespace App\Registry\ContentProvider\JSONLD;


use App\Registry\ContentProvider\ContentProvider;

class JSONLDContentProvider extends ContentProvider
{
    public function extract($payload)
    {
        $providers = config("registry.schemas.json-ld.metadata");

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
