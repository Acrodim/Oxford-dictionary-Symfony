<?php

namespace App\Service\OxfordDictionary;

use App\Service\OxfordDictionary\Apis\EntriesApi;
use App\Service\OxfordDictionary\Client\HttpClientInterface;

/**
 * @method EntriesApi entries
 */
class ApiFacade
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $className = sprintf('App\OxfordDictionary\\Api\\%sApi', ucfirst($name));

        if (!class_exists($className)) {
            throw new \BadMethodCallException('Wrong Api');
        }

        return new $className($this->client, ...$arguments);
    }
}
