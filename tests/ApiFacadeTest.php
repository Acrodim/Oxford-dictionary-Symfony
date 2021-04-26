<?php

namespace App\Tests;

use App\Service\OxfordDictionary\ApiFacade;
use App\Service\OxfordDictionary\Clients\HttpClientInterface;
use PHPUnit\Framework\TestCase;

class ApiFacadeTest extends TestCase
{

    /**
     * @test
     */
    public function throw_valid_exception()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $api = new ApiFacade($client);
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Wrong Api');

        $api->translation()->word('cat');
    }

}
