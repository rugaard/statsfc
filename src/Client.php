<?php
declare(strict_types=1);

namespace Rugaard\StatsFC;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\RequestException as GuzzleRequestException;
use Prophecy\Promise\PromiseInterface;
use Rugaard\StatsFC\Exceptions\InvalidResponseBodyException;
use Rugaard\StatsFC\Exceptions\InvalidUrlException;
use Rugaard\StatsFC\Exceptions\RequestFailedException;
use Rugaard\StatsFC\Exceptions\ServiceUnavailableException;
use Rugaard\StatsFC\Exceptions\TooManyRequestsException;
use Rugaard\StatsFC\Exceptions\UnauthorizedException;

/**
 * Class Client.
 *
 * @package Rugaard\StatsFC
 */
class Client
{
    /**
     * Base URL of API.
     *
     * @var string
     */
    protected $baseUrl = 'https://dugout.statsfc.com/api';

    /**
     * API version.
     *
     * @var string
     */
    protected $version = 'v1';

    /**
     * API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Client constructor.
     *
     * @param  string $apiKey
     */
    public function __construct(string $apiKey)
    {
        // Set API key.
        $this->setApiKey($apiKey);

        // Initiate default Client
        $this->client = new GuzzleClient([
            'headers' => [
                'X-StatsFC-Key' => $apiKey
            ]
        ]);
    }

    /**
     * Fire request.
     *
     * @param  string $endpoint
     * @param  array  $parameters
     * @return mixed
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function request(string $endpoint, array $parameters = [])
    {
        // Generate full URL.
        $url = sprintf('%s/%s/%s', $this->getBaseUrl(), $this->getVersion(), $endpoint);

        // Add query parameters to URL.
        if (!empty($parameters)) {
            $url .= '?' . http_build_query($parameters);
        }

        // Validate URL.
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException(sprintf('Invalid URL: %s', $url), 412);
        }

        try {
            // Fire request.
            $response = $this->client->get($url);

            // Decode response body.
            $body = json_decode((string) $response->getBody());

            // Handle potential decoding errors.
            if (json_last_error() != JSON_ERROR_NONE) {
                throw new InvalidResponseBodyException(sprintf('Could not decode response body: %s', json_last_error_msg()), 400);
            }

            return $body;
        } catch (GuzzleRequestException $e) {
            // Get status code of exception
            $statusCode = $e->getResponse() && !($e->getResponse() instanceof PromiseInterface) ? $e->getResponse()->getStatusCode() : 0;

            // Handle response errors.
            switch ($statusCode) {
                case 401:
                    $body = json_decode((string) $e->getResponse()->getBody());
                    throw new UnauthorizedException($body->error->message, $body->error->statusCode);
                    break;
                case 429:
                    $body = json_decode((string) $e->getResponse()->getBody());
                    throw new TooManyRequestsException($body->error->message, $body->error->statusCode);
                    break;
                case 503:
                    $body = json_decode((string) $e->getResponse()->getBody());
                    throw new ServiceUnavailableException($body->error->message, $body->error->statusCode);
                    break;
                default:
                    throw new RequestFailedException(sprintf('Request failed: %s', $e->getMessage()), 400, $e);
            }
        }
    }

    /**
     * Set base URL.
     *
     * @param  string $baseUrl
     * @return \Rugaard\StatsFC\Client
     */
    public function setBaseUrl(string $baseUrl) : Client
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    /**
     * Get base URL.
     *
     * @return string
     */
    public function getBaseUrl() : string
    {
        return $this->baseUrl;
    }

    /**
     * Set API version.
     *
     * @param string $version
     * @return \Rugaard\StatsFC\Client
     */
    public function setVersion(string $version) : Client
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Get API version.
     *
     * @return string
     */
    public function getVersion() : string
    {
        return $this->version;
    }

    /**
     * Set API key.
     *
     * @param  string $apiKey
     * @return \Rugaard\StatsFC\Client
     */
    public function setApiKey(string $apiKey) : Client
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * Get API key.
     *
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->apiKey;
    }

    /**
     * Set Client instance.
     *
     * @param  \GuzzleHttp\ClientInterface $client
     * @return \Rugaard\StatsFC\Client
     */
    public function setClient(GuzzleClientInterface $client) : Client
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Get Client instance.
     *
     * @return \GuzzleHttp\ClientInterface
     */
    public function getClient() : GuzzleClientInterface
    {
        return $this->client;
    }
}