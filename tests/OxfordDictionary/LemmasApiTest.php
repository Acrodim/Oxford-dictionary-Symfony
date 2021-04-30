<?php

namespace App\Tests\OxfordDictionary;

use App\Service\OxfordDictionary\Apis\LemmasApi;
use App\Service\OxfordDictionary\Client\HttpClientInterface;
use App\Service\OxfordDictionary\Exceptions\ApiException;
use PHPUnit\Framework\TestCase;

class LemmasApiTest extends TestCase
{
    const SUCCESS_RESPONSE = <<<'SUCCESS_RESPONSE'
    {
      "metadata": {
        "provider": "Oxford University Press"
      },
      "results": [
        {
          "id": "aces",
          "language": "en",
          "lexicalEntries": [
            {
              "inflectionOf": [
                {
                  "id": "ace",
                  "text": "ace"
                }
              ],
              "language": "en",
              "lexicalCategory": {
                "id": "noun",
                "text": "Noun"
              },
              "text": "aces"
            },
            {
              "inflectionOf": [
                {
                  "id": "ace",
                  "text": "ace"
                }
              ],
              "language": "en",
              "lexicalCategory": {
                "id": "verb",
                "text": "Verb"
              },
              "text": "aces"
            }
          ],
          "word": "aces"
        }
      ]
    }
    SUCCESS_RESPONSE;


    const ERROR_RESPONSE = <<<'ERROR_RESPONSE'
    {
        "error": "No lemma was found in dictionary 'en' for the inflected form 'acesааа'"
    }
    ERROR_RESPONSE;


    /**
     * @test
     */
    public function we_can_perform_the_lexical_entries()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects($this->once())->method('get')->willReturn(json_decode(self::SUCCESS_RESPONSE, true));
        $api = new LemmasApi($client);
        $results = $api->get('en', 'aces');
        $this->assertIsArray($results);
    }

    /**
     * @test
     */
    public function we_can_not_found_a_entries()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->expects($this->once())->method('get')->willReturn(json_decode(self::ERROR_RESPONSE, true));
        $api = new LemmasApi($client);
        $results = $api->get('en', 'acesааа');
        $this->assertIsArray($results);
    }

    /**
     * @test
     */
    public function we_throw_valid_exception()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willThrowException(
            $this->createMock(ApiException::class)
        );
        $api = new LemmasApi($client);
        $this->expectException(ApiException::class);
        $api->get('en', 'test');
    }
}

