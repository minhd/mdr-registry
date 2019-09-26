<?php


namespace App\IGSN;


use App\Registry\DataCiteClient;

class IGSNService
{
    /** @var DataCiteClient */
    private $http;

    /**
     * IGSNService constructor.
     * @param DataCiteClient $http
     */
    public function __construct(DataCiteClient $http)
    {
        $this->http = $http;
    }


    public function mint($url, $xml)
    {
        // TODO is client authenticated
        // TODO validate url and domain
        // TODO construct IGSN string (prefix . uniqid)
        $igsn = 'XXAA1234';
        // TODO replace IGSN string into the xml
        // TODO validate XML

        // status: REQUESTED, MINTED, ACTIVE

        // TODO insert the new IGSN into the database, set status as REQUESTED

        // TODO mint with the DataCiteClient (igsn uses mds software)
        $result = $this->http->mint($igsn, $url, $xml);


        // TODO prepare response

        return $result;
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
