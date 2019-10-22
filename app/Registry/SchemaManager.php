<?php


namespace App\Registry;

class SchemaManager
{
    public static function supports($schema) : bool
    {
        $schemas = array_keys(config('registry.schemas'));

        return in_array($schema, $schemas);
    }

    // TODO detect schema from payload

    /**
     * @param $schema
     * @return mixed
     * @throws \Exception
     */
    public static function provider($schema)
    {
        if (!self::supports($schema)) {
            throw new \Exception("Schema $schema is not supported!");
        }

        $providerClass = config("registry.schemas.$schema.provider");
        if (!$providerClass) {
            throw new \Exception("Provider for the schema $schema is not defined");
        }
        $provider = new $providerClass;
        return $provider;
    }

}
