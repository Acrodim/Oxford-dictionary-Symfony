<?php


namespace App\Service\OxfordDictionary\Api;


use App\Service\OxfordDictionary\Clients\HttpClientInterface;

class OxfordDictionaryApi
{
    /**
     * @var \App\Service\OxfordDictionary\Clients\HttpClientInterface
     */
    private $client;

    /**
     * OxfordDictionaryApi constructor.
     * @param \App\Service\OxfordDictionary\Clients\HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function entries($word, $sourceLang = 'en-gb')
    {
        dump($word);
    }
}
