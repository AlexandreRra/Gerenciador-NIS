<?php

namespace App\Http;

class Request
{

    /**
     * Http method for request
     * @var string
     */
    private $httpMethod;

    /**
     * Page URI
     * @var string
     */
    private $uri;

    /**
     * URL parameters ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Variables received from POST ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * Request header
     * @var array
     */
    private $headers = [];

    /**
     * Initiate the class and define values
     */
    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders();
        $this->httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    /**
     * Return HTTP method from request
     * @return string
     */
    public function getHttpMetod()
    {
        return  $this->httpMethod;
    }

    /**
     * Return URI from request
     * @return string
     */
    public function getUri()
    {
        return  $this->uri;
    }

    /**
     * Return Headers from request
     * @return array
     */
    public function getHeaders()
    {
        return  $this->headers;
    }

    /**
     * Return URL params from request
     * @return array
     */
    public function getQueryParams()
    {
        return  $this->queryParams;
    }

    /**
     * Return POST variables from request
     * @return array
     */
    public function getPostVars()
    {
        return  $this->postVars;
    }
}
