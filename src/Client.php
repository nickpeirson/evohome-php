<?php
namespace Nickpeirson\Evohome;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\RequestInterface as HttpRequestInterface;

class Client
{
    const URL = 'https://rs.alarmnet.com:443/TotalConnectComfort/';

    protected $debug = true;
    protected $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public static function init()
    {
        return new static(
            new HttpClient([
                    'base_url' => static::URL,
                    'headers' => [
                        'Accept' => 'application/json, application/xml, text/json, text/x-json, text/javascript, text/xml'
                    ]
                ]
            )
        );
    }

    public function sendRequest(RequestInterface $request)
    {
        $client = $this->httpClient;
        $request = $client->createRequest(
            $request->getMethod(),
            $request->getPath(),
            $request->getOptions()
        );
        $this->outputRequest($request);
        try {
            $response = $client->send($request);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }
        $this->outputResponse($response);
        return $this->parseResponse($response);
    }

    protected function outputRequest($request)
    {
        $this->output($request, '>');
    }

    protected function outputResponse($response)
    {
        $this->output($response, '<');
    }

    protected function output($message, $prefix = '')
    {
        if (!$this->debug)
        {
            return;
        }
        $message = explode("\n", (string)$message);
        $message = array_map(function ($line) use ($prefix){
            return $prefix.' '.$line;
        }, $message);
        echo implode("\n", $message).PHP_EOL;
    }

    protected function parseResponse(ResponseInterface $response)
    {
        $decodedResponse = json_decode($response->getBody());
        return $decodedResponse;
    }
}