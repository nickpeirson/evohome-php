<?php
namespace Nickpeirson\Evohome;

interface RequestInterface
{
    /**
     * An array of headers for the request
     *
     * @return array
     */
    public function getHeaders();

    /**
     * An array of options for the request
     *
     * @return array
     */
    public function getOptions();

    /**
     * The HTTP method to use when sending the request
     *
     * return string
     */
    public function getMethod();

    /**
     * The path to the API endpoint
     *
     * @return string
     */
    public function getPath();
}