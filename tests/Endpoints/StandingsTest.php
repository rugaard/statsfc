<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Standing;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class StandingsTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class StandingsTest extends AbstractTestCase
{
    /**
     * Test standings endpoint.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testStandingsEndpoint()
    {
        // Get all seasons
        $result = $this->statsfc->standings();
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(2, $result->count());
        $this->assertInstanceOf(Standing::class, $result->first());
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
                    'competition' => [
                        'id' => 1,
                        'name' => 'Premier League',
                        'key' => 'EPL',
                        'region' => 'England',
                    ],
                    'round' => [
                        'id' => 2,
                        'name' => 'Premier League',
                        'start' => '2016-08-15',
                        'end' => '2017-04-28',
                    ],
                    'team' => [
                        'id' => 3,
                        'name' => 'Liverpool',
                        'shortName' => 'Liverpool',
                    ],
                    'position' => 1,
                    'played' => 38,
                    'wins' => 26,
                    'draws' => 9,
                    'losses' => 3,
                    'for' => 73,
                    'against' => 32,
                    'difference' => 41,
                    'points' => 87,
                    'info' => 'top1',
                    'notes' => null,
                ], [
                    'competition' => [
                        'id' => 1,
                        'name' => 'Premier League',
                        'key' => 'EPL',
                        'region' => 'England',
                    ],
                    'round' => [
                        'id' => 2,
                        'name' => 'Premier League',
                        'start' => '2016-08-15',
                        'end' => '2017-04-28',
                    ],
                    'team' => [
                        'id' => 4,
                        'name' => 'Arsenal',
                        'shortName' => 'Arsenal',
                    ],
                    'position' => 2,
                    'played' => 38,
                    'wins' => 20,
                    'draws' => 13,
                    'losses' => 5,
                    'for' => 68,
                    'against' => 72,
                    'difference' => -4,
                    'points' => 73,
                    'info' => 'top2',
                    'notes' => null,
                ],
            ]
        ]);
    }
}