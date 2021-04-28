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
     * @param string $source_lang
     * @param string $word_id
     * @return array
     * @throws ApiException
     */
    public function get(string $source_lang, string $word_id): array
    {
        $uri = sprintf(
            'entries/%s/%s?strictMatch=false',
            $source_lang, $word_id
        );

        return  (new EntriesResultBuilder($this->client->get($uri)))->build();
    }
}

