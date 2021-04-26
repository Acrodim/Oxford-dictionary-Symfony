<?php

namespace App\Service\OxfordDictionary\Client;

use App\Service\OxfordDictionary\Exceptions\ApiHttpClientException;

interface HttpClientInterface
{
    /**
     * @param string $uri
     * @return array|null
     * @throws ApiHttpClientException
     */
    public function get(string $uri): ?array;
}
