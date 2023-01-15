<?php

namespace App\Http;

class Response
{

    /**
     * HTTP status code
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Response header
     * @var array
     */
    private $headers = [];

    /**
     * Content type being returned
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Response content
     * @var mixed
     */
    private $content;

    /**
     * Initiate the class and define values
     * @param integer $httpCode
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    /**
     * Change the content type of Response
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Add a register in Response header
     * @param string $key
     * @param string $value
     */
    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Send headers to browser
     */
    private function sendHeaders()
    {
        // Status
        http_response_code($this->httpCode);


        // Send headers
        foreach ($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    /**
     * Send Response to user
     */
    public function sendResponse()
    {

        // Send headers
        $this->sendHeaders();



        // Print content
        switch ($this->contentType) {

            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}
