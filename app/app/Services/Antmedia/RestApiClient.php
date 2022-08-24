<?php

namespace App\Services\Antmedia;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Log;

class RestApiClient
{
    protected Client $client;

    public function __construct(array $options = [])
    {
        $this->client = new Client(array_merge([
            'timeout' => 30,
            'base_uri' => config('app.antmedia_api_url'),
            'http_errors' => false,
            'headers' => ['Content-Type' => 'application/json'],
        ], $options));
    }

    /**
     * @param string $uri
     * @param array $options
     * @param string $method
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBody(string $uri, array $options = [], string $method = 'GET')
    {
        return $this->client->request($method, $uri, $options)->getBody();
    }

    /**
     * @param $uri
     * @param $options
     * @param $method
     * @return mixed
     * @throws \Exception
     */
    public function getBodyJsonDecode($uri, $options = [], $method = 'GET')
    {
        try {
            $body = $this->getBody($uri, $options, $method);
        } catch (\Throwable $e) {
            Log::error('Service response exception: ' . $e->getMessage());
            throw new \Exception('Service response exception: ' . $e->getMessage(), $e->getCode(), $e);
        }

        try {
            return $this->data = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (\Exception $e) {
            $message = "json_decode throw exception : " . $e->getMessage() . ". Income data - " . serialize($body);
            Log::error($message);
            throw new \Exception($message, $e->getCode(), $e);
        }
    }
}
