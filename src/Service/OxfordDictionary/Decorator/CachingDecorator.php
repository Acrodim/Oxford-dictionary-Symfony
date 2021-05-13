<?php

namespace App\Service\OxfordDictionary\Decorator;

use App\Entity\Cache;
use App\Service\OxfordDictionary\Client\HttpClientInterface;
use Doctrine\ORM\EntityManagerInterface;

class CachingDecorator implements HttpClientInterface
{
    private HttpClientInterface $client;
    private EntityManagerInterface $em;

    public function __construct(HttpClientInterface $client, EntityManagerInterface $em)
    {
        $this->client = $client;
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function get(string $uri): ?array
    {
        $uriHash = sha1($uri);

        $cache = $this->em->getRepository(Cache::class)
            ->findOneBy(['uriKey' => $uriHash]);

        if (!$cache) {
            $response = $this->client->get($uri);

            $cache = (new Cache())->setUriKey($uriHash)->setValue($response);
            $this->em->persist($cache);
            $this->em->flush();
        }

        return $cache->getValue();
    }
}
