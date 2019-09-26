<?php


namespace App\Registry;


interface DataCiteClient
{
    /**
     * DataCiteClient constructor.
     * @param $username
     * @param $password
     */
    public function __construct($username, $password);

    /**
     * get the URL content of a DOI by ID
     * @param $identifier
     * @return mixed
     */
    public function get($identifier);

    /**
     * get the Metadata of a DOI by ID
     * @param $identifier
     * @return mixed
     */
    public function getMetadata($identifier);

    /**
     * @param $identifier
     * @param $url
     * @param bool $metadata
     * @return mixed
     */
    public function mint($identifier, $url, $metadata = false);

    /**
     * Update XML
     * @param bool|false $metadata
     * @return mixed
     */
    public function update($metadata = false);

    /**
     * UpdateURL
     * @param $identifier
     * @param string $url , string $identifier
     * @return bool
     */
    public function updateURL($identifier, $url);

    ///Don't have an activate function...updating the xml activates a deactivated doi...
    public function activate($metadata = false);

    public function deActivate($identifier);

    /**
     * @return string
     */
    public function getDataciteUrl();

    /**
     * @param string $dataciteUrl
     * @return $this
     */
    public function setDataciteUrl($dataciteUrl);

    public function getResponse();

    /**
     * @return array
     */
    public function getMessages();

    /**
     * @return array
     */
    public function getErrors();

    /**
     * @return bool
     */
    public function hasError();
}
