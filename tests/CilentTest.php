<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use Rugaard\StatsFC\Exceptions\InvalidResponseBodyException;
use Rugaard\StatsFC\Exceptions\InvalidUrlException;
use Rugaard\StatsFC\Exceptions\RequestFailedException;
use Rugaard\StatsFC\Exceptions\ServiceUnavailableException;
use Rugaard\StatsFC\Exceptions\TooManyRequestsException;
use Rugaard\StatsFC\Exceptions\UnauthorizedException;
use Rugaard\StatsFC\StatsFC;

/**
 * Class ClientTest.
 *
 * @package StatsFC\Tests
 */
class ClientTest extends AbstractTestCase
{
    /**
     * Test exception [InvalidUrlException].
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testInvalidUrlException()
    {
        $this->expectException(InvalidUrlException::class);
        $this->statsfc->setBaseUrl('no-protocol.com')->request('/');
    }

    /**
     * Test exception [InvalidResponseBodyException].
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testInvalidResponseBodyException()
    {
        $this->statsfc->setClient($this->createMockedGuzzleClient([
            new GuzzleResponse(200, [], '[\'response-is-not-json-encoded\' => true]'),
        ]));

        $this->expectException(InvalidResponseBodyException::class);
        $this->statsfc->request('/');
    }

    /**
     * Test exception [UnauthorizedException].
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testUnauthorizedException()
    {
        $this->statsfc->setClient($this->createMockedGuzzleClient([
            new GuzzleResponse(401, [], json_encode([
                'error' => [
                    'message' => 'API key not provided',
                    'statusCode' => 401
                ]
            ])),
        ]));

        $this->expectException(UnauthorizedException::class);
        $this->statsfc->request('/');
    }

    /**
     * Test exception [TooManyRequestsException].
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testTooManyRequestsException()
    {
        $this->statsfc->setClient($this->createMockedGuzzleClient([
            new GuzzleResponse(429, [], json_encode([
                'error' => [
                    'message' => 'Rate limit exceeded',
                    'statusCode' => 429
                ]
            ])),
        ]));

        $this->expectException(TooManyRequestsException::class);
        $this->statsfc->request('/');
    }

    /**
     * Test exception [ServiceUnavailableException].
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testServiceUnavailableException()
    {
        $this->statsfc->setClient($this->createMockedGuzzleClient([
            new GuzzleResponse(503, [], json_encode([
                'error' => [
                    'message' => 'Down for maintenance. We\'ll be right back',
                    'statusCode' => 503
                ]
            ])),
        ]));

        $this->expectException(ServiceUnavailableException::class);
        $this->statsfc->request('/');
    }

    /**
     * Test exception [RequestFailedException].
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testExceptionOnFailedRequest()
    {
        $this->statsfc->setClient($this->createMockedGuzzleClient([
            new GuzzleRequestException('Error communicating with server', new GuzzleRequest('GET', '127.0.0.1')),
        ]));
        $this->expectException(RequestFailedException::class);
        $this->statsfc->request('/');
    }

    /**
     * Test setter/getter of base URL.
     *
     * @return void
     */
    public function testBaseUrl()
    {
        // Set base URL
        $result = $this->statsfc->setBaseUrl('http://example.com');
        $this->assertInstanceOf(StatsFC::class, $result);

        // Get base URL
        $baseUrl = $this->statsfc->getBaseUrl();
        $this->assertEquals('http://example.com', $baseUrl);
    }

    /**
     * Test setter/getter of version.
     *
     * @return void
     */
    public function testVersion()
    {
        // Set version
        $result = $this->statsfc->setVersion('v2');
        $this->assertInstanceOf(StatsFC::class, $result);

        // Get version
        $version = $this->statsfc->getVersion();
        $this->assertEquals('v2', $version);
    }

    /**
     * Test setter/getter of API key.
     *
     * @return void
     */
    public function testApiKey()
    {
        // Set API key
        $result = $this->statsfc->setApiKey('this-is-an-api-key');
        $this->assertInstanceOf(StatsFC::class, $result);

        // Get API key
        $apiKey = $this->statsfc->getApiKey();
        $this->assertEquals('this-is-an-api-key', $apiKey);
    }

    /**
     * Test setter/getter of client.
     *
     * @return void
     */
    public function testClient()
    {
        // Set client
        $result = $this->statsfc->setClient(new GuzzleClient);
        $this->assertInstanceOf(StatsFC::class, $result);

        // Get client
        $client = $this->statsfc->getClient();
        $this->assertInstanceOf(GuzzleClient::class, $client);
    }
}