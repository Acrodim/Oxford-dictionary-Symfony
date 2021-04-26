<?php

namespace App\System\OxfordDictionary\Client;

use App\System\OxfordDictionary\Exceptions\ApiHttpClientException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * @codeCoverageIgnore
 */
class GuzzleAdapter implements HttpClientInterface
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * GuzzleAdapter constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @inheritDoc
     * @param string $uri
     * @return array|null
     */
    public function get(string $uri): ?array
    {
        try {
            return json_decode($this->client->get($uri)->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new ApiHttpClientException($e->getMessage(), $e->getCode());
        }
    }
}