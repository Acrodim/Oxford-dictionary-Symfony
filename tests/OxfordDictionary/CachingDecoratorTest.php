<?php

namespace App\Tests\OxfordDictionary;

use App\Entity\Cache;
use App\Repository\CacheRepository;
use App\Service\OxfordDictionary\Client\HttpClientInterface;
use App\Service\OxfordDictionary\Decorator\CachingDecorator;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class CachingDecoratorTest extends TestCase {

    private const URI = '/api/v2/entries/en-us/word?fields=regions&strictMatch=false';

    private const HASH = 'd27d05a5a9098e7102bf6d39e34d683bd5c18a53';

    private const RESPONSE = <<<'RESPONSE'
{"id":"word","word":"word","results":[{"id":"word","type":"headword","word":"word","language":"en-us","lexicalEntries":[{"text":"word","language":"en-us","lexicalCategory":{"id":"noun","text":"Noun"}},{"text":"word","language":"en-us","lexicalCategory":{"id":"verb","text":"Verb"}},{"text":"word","language":"en-us","lexicalCategory":{"id":"interjection","text":"Interjection"}}]}],"metadata":{"schema":"RetrieveEntry","provider":"Oxford University Press","operation":"retrieve"}}
RESPONSE;

    public function testGet()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);

        $cacheRepositoryMock = $this->getMockBuilder(CacheRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $entityManager->expects($this->once())
            ->method('getRepository')
            ->willReturn($cacheRepositoryMock);

        $cacheEntity = $this->createMock(Cache::class);

        $cacheEntity->expects($this->once())
            ->method('getValue')
            ->willReturn(json_decode(self::RESPONSE, true));

        $cacheRepositoryMock->expects($this->once())
            ->method('findOneBy')
            ->with(['uriKey' => self::HASH])
            ->willReturn($cacheEntity);

        $decorator = new CachingDecorator($client, $entityManager);
        $result = $decorator->get(self::URI);
        $this->assertIsArray($result);
    }
}
