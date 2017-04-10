<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\State;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class StatesTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class StatesTest extends AbstractTestCase
{
    /**
     * Test seasons endpoint.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testStatesEndpoint()
    {
        // Get all seasons
        $result = $this->statsfc->states();
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($result->count(), 2);
        $this->assertInstanceOf(State::class, $result->first());
    }

    /**
     * Get a mocked response for testing purposes.
     *
     * @return string
     */
    protected function getMockedResponse() : string
    {
        return json_encode([
            'data' => [
                [
                    'id' => 1,
                    'key' => 'HT',
                    'name' => 'Half-Time',
                ],
                [
                    'id' => 2,
                    'key' => 'FT',
                    'name' => 'Full-Time',
                ],
            ]
        ]);
    }
}