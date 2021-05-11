<?php

namespace App\Service\OxfordDictionary\Apis;

use App\Service\OxfordDictionary\Builders\EntriesResultBuilder;
use App\Service\OxfordDictionary\Client\HttpClientInterface;
use App\Service\OxfordDictionary\Exceptions\ApiException;

class EntriesApi
{
    private HttpClientInterface $client;

    /**
     * EntriesApi constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param  string  $wordId
     * @param  string  $sourceLang
     * @return array
     * @throws ApiException
     */
    public function get(string $wordId, string $sourceLang): array
    {
        $uri = "/api/v2/entries/$sourceLang/$wordId";

        $response = $this->client->get($uri);
        $resultBuilder = new EntriesResultBuilder($response);

        return $resultBuilder->build();
    }
}

