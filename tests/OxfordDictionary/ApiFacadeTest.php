<?php

namespace App\Tests\OxfordDictionary;

use App\System\OxfordDictionary\ApiFacade;
use App\System\OxfordDictionary\Client\HttpClientInterface;
use PHPUnit\Framework\TestCase;

class ApiFacadeTest extends TestCase
{

    /**
     * @test
     */
    public function throwValidExceptionTest()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $api = new ApiFacade($client);
        $this->expectException(\BadMethodCallException::class);
        $this->expectExceptionMessage('Wrong Api');

        $api->translation()->word('cat');
    }

}
