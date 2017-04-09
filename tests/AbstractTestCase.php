<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\MockHandler as GuzzleMockHandler;
use GuzzleHttp\HandlerStack as GuzzleHandlerStack;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use Rugaard\StatsFC\StatsFC;

/**
 * Class AbstractTestCase.
 *
 * @package StatsFC\Tests
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * StatsFC instance.
     *
     * @var \Rugaard\StatsFC\StatsFC
     */
    protected $statsfc;

    /**
     * Prepare test case.
     *
     * @return void
     */
    public function setUp()
    {
        $this->statsfc = new StatsFC('test');
    }

    /**
     * Call protected/private method of a class.
     *
     * @param  object &$object
     * @param  string $methodName
     * @param  array  $parameters
     * @return mixed
     */
    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Create a Guzzle Client with mocked responses.
     *
     * @param  array $responses
     * @return \GuzzleHttp\Client
     */
    protected function createMockedGuzzleClient(array $responses) : GuzzleClient
    {
        return new GuzzleClient([
            'handler' => GuzzleHandlerStack::create(
                new GuzzleMockHandler($responses)
            ),
        ]);
    }
}