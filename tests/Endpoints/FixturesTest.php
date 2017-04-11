<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Fixture;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class FixturesTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class FixturesTest extends AbstractTestCase
{
    /**
     * Test fixtures endpoint.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testFixturesEndpoint()
    {
        // Get all top scorers
        $result = $this->statsfc->fixtures([
            'team' => 'Liverpool',
        ]);
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(2, $result->count());
        $this->assertInstanceOf(Fixture::class, $result->first());
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
                    'timestamp' => '2017-04-11T20:25:00+0000',
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
                    'teams' => [
                        'home' => [
                            'id' => 3,
                            'name' => 'Liverpool',
                            'shortName' => 'Liverpool',
                        ],
                        'away' => [
                            'id' => 4,
                            'name' => 'Manchester United',
                            'shortName' => 'Man. Utd.',
                        ]
                    ],
                    'players' => [
                        'home' => [],
                        'away' => [],
                    ],
                    'score' => null,
                    'currentState' => [
                        'id' => 5,
                        'key' => 'FX',
                        'name' => 'Fixture',
                    ],
                    'venue' => [
                        'id' => 6,
                        'name' => 'Anfield Road',
                        'capacity' => 54074,
                    ],
                    'events' => [
                        'cards' => [],
                        'goals' => [],
                        'states' => [],
                        'substitutions' => [],
                    ],
                ],
                [
                    'id' => 2,
                    'timestamp' => '2017-04-11T20:25:00+0000',
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
                    'teams' => [
                        'home' => [
                            'id' => 4,
                            'name' => 'Manchester United',
                            'shortName' => 'Man Utd.',
                        ],
                        'away' => [
                            'id' => 3,
                            'name' => 'Liverpool',
                            'shortName' => 'Liverpool',
                        ],
                    ],
                    'players' => [
                        'home' => [],
                        'away' => [],
                    ],
                    'score' => null,
                    'currentState' => [
                        'id' => 7,
                        'key' => 'FX',
                        'name' => 'Fixture',
                    ],
                    'venue' => [
                        'id' => 8,
                        'name' => 'Old Trafford',
                        'capacity' => 75635,
                    ],
                    'events' => [
                        'cards' => [],
                        'goals' => [],
                        'states' => [],
                        'substitutions' => [],
                    ],
                ],
            ]
        ]);
    }
}