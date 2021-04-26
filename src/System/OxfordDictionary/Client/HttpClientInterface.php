<?php

namespace App\System\OxfordDictionary\Client;

use App\System\OxfordDictionary\Exceptions\ApiHttpClientException;

interface HttpClientInterface
{
    /**
     * @param string $uri
     * @return array|null
     * @throws ApiHttpClientException
     */
    public function get(string $uri): ?array;
}