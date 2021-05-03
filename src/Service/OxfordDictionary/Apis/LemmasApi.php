<?php

namespace App\Service\OxfordDictionary\Apis;

use App\Service\OxfordDictionary\Builders\LemmasGetResultsBuilder;
use App\Service\OxfordDictionary\Client\HttpClientInterface;

class LemmasApi
{
    private  HttpClientInterface $client;

    /**
     * LemmasApi constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface  $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $word_id
     * @param string $source_lang
     * @return array
     */
    public function get(string $word_id, string $source_lang = "en"): array
    {
        $uri = sprintf(
            '/lemmas/%s/%s',
            $source_lang,
            $word_id
        );

        $response = $this->client->get($uri);

        $resultBuilder  = new LemmasGetResultsBuilder($response);

        return $resultBuilder->build();
    }
}

