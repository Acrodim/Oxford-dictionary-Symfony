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

    public function __construct(string $baseUri, string $appId, string $appKey)
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
            'headers' => [
                'app_id' => $appId,
                'app_key' => $appKey
            ]
        ]);
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
