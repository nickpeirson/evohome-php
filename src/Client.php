<?php
namespace Nickpeirson\Evohome;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Stream;
use Psr\Http\Message\StreamInterface;

class Client
{
    const URL = 'https://tccna.honeywell.com/';

    protected $debug = true;
    protected $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public static function init()
    {
        return new static(
            new HttpClient(array(
                'base_uri' => static::URL,
                'headers' => array(
                    'Accept' => 'application/json, application/xml, text/json, text/x-json, text/javascript, text/xml'
                )
            ))
        );
    }

    public function sendRequest(RequestInterface $request)
    {
        $client = $this->httpClient;

        try {
            $request = $client->request(
                $request->getMethod(),
                $request->getPath(),
                $request->getOptions()
            );

            $response = $request->getBody();
        } catch (ConnectException $e) {
            throw $e;
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        if (!$response instanceof Stream) {
            throw new \Exception($response->getReasonPhrase(), $response->getStatusCode());
        }

        return $this->parseResponse($response);
    }

    protected function parseResponse(StreamInterface $response)
    {
        $decodedResponse = json_decode($response->getContents());
        return $decodedResponse;
    }
}