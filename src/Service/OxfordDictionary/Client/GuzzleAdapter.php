<?php

namespace App\Service\OxfordDictionary\Client;

use App\Service\OxfordDictionary\Exceptions\ApiHttpClientException;
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
    private string $app_id;
    private string $app_key;
    private string $base_uri;

    /**
     * @param Client $client
     * @param string $app_id
     * @param string $app_key
     * @param string $base_uri
     */
    public function __construct(Client $client, $app_id, $app_key, $base_uri = 'https://od-api.oxforddictionaries.com')
    {
        $this->client = $client;
        $this->app_id = $app_id;
        $this->app_key = $app_key;
        $this->base_uri = $base_uri;
    }

    /**
     * @inheritDoc
     * @param string $base_uri
     * @return array|null
     */
    public function get(string $base_uri): ?array
    {
        try {
            return json_decode($this->client->get($base_uri)->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new ApiHttpClientException($e->getMessage(), $e->getCode());
        }
    }
}
