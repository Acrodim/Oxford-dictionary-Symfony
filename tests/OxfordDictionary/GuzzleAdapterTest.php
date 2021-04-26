<?php

namespace App\Tests\OxfordDictionary;

use App\System\OxfordDictionary\Client\GuzzleAdapter;
use App\System\OxfordDictionary\Exceptions\ApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use ReflectionClass;
use ReflectionException;

class GuzzleAdapterTest extends TestCase
{
    /**
     * @test
     * @dataProvider requestDataProvider
     *
     * @param $method
     * @param  array  $data
     * @throws ReflectionException
     */
    public function we_can_make_request($method, array $data)
    {
        $client = new GuzzleAdapter();

        $guzzleMock = $this->createMock(Client::class);
        $guzzleMock->expects($this->once())->method($method)->willReturnCallback(function () {
            $response = $this->createMock(ResponseInterface::class);
            $response->method('getBody')->willReturnCallback(function () {
                $stream = $this->createMock(StreamInterface::class);
                $stream->method('getContents')->willReturn('');

                return $stream;
            });

            return $response;
        });
        $this->setProperty($client, 'client', $guzzleMock);

        $this->assertNull($client->$method(...$data));
    }

    /**
     * @param $object
     * @param $property
     * @param $value
     * @throws ReflectionException
     */
    private static function setProperty($object, $property, $value)
    {
        $reflectedClass = new ReflectionClass($object);
        $reflection = $reflectedClass->getProperty($property);
        $reflection->setAccessible(true);
        $reflection->setValue($object, $value);
    }

    /**
     * @return array
     */
    public function requestDataProvider()
    {
        return [
            ['get', ['uri']]
        ];
    }

    /**
     * @test
     * @dataProvider exceptionDataProvider
     *
     * @param $method
     * @param  array  $data
     * @param $expected
     * @throws ReflectionException
     */
    public function we_can_handle_exception($method, array $data, $expected)
    {
        $client = new GuzzleAdapter();

        $guzzleMock = $this->createMock(Client::class);
        $guzzleMock->method($method)->willThrowException($this->createMock(GuzzleException::class));
        $this->setProperty($client, 'client', $guzzleMock);

        $this->expectException($expected);

        $client->$method(...$data);
    }

    /**
     * @return array
     */
    public function exceptionDataProvider()
    {
        return [
            ['get', ['uri'], ApiException::class]
        ];
    }
}