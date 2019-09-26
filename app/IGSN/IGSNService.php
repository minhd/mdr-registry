<?php


namespace App\IGSN;


use App\IGSN\Models\IGSNClient;
use App\Registry\DataCiteClient;
use App\Registry\ImportManager;

class IGSNService
{
    /** @var DataCiteClient */
    private $http;

    /** @var IGSNClient */
    private $client;

    /**
     * IGSNService constructor.
     * @param DataCiteClient $http
     * @param IGSNClient|null $client
     */
    public function __construct(DataCiteClient $http, IGSNClient $client = null)
    {
        $this->http = $http;
        $this->client = $client;
    }

    public function mint($url, $xml)
    {
        // TODO is client authenticated


        // TODO validate url and domain
        // TODO construct IGSN string (prefix . uniqid)
        $igsn = $this->getIdentifierValue();

        // TODO replace IGSN string into the xml
        // TODO validate XML

        // status: REQUESTED, MINTED, ACTIVE

        // TODO insert the new IGSN into the database, set status as REQUESTED
        // new record -> new version
        $manager = new ImportManager();
        $manager->import([
            'data_source_id' => $this->client->datasource->id,
            'payload' => [
                'schema' => 'igsn',
                'data' => [
                    'type' => 'plain',
                    'content' => $xml
                ]
            ]
        ]);

        // TODO mint with the DataCiteClient (igsn uses mds software)
        $result = $this->http->mint($igsn, $url, $xml);


        // TODO prepare response

        return $result;
    }

    public function getIdentifierValue()
    {
        $activePrefix = $this->client->active_prefix->prefix;
        // todo check null

        $random = uniqid();

        return $activePrefix . $random;
    }

    /**
     * @return DataCiteClient
     */
    public function getHttp(): DataCiteClient
    {
        return $this->http;
    }

    /**
     * @param DataCiteClient $http
     *
     * @return IGSNService
     */
    public function setHttp(DataCiteClient $http)
    {
        $this->http = $http;

        return $this;
    }
}
