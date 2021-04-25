<?php


namespace App\OxfordDictionary\Api;


use App\OxfordDictionary\Clients\HttpClientInterface;

class OxfordDictionaryApi
{
    /**
     * @var \App\OxfordDictionary\Clients\HttpClientInterface
     */
    private $client;

    /**
     * OxfordDictionaryApi constructor.
     * @param \App\OxfordDictionary\Clients\HttpClientInterface $client
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
