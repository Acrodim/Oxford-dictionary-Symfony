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
     * @param $source_lang
     * @param $word_id
     * @return array
     */
    public function get($source_lang, $word_id): array
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
