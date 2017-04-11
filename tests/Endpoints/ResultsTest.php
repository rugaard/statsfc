<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Result;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class ResultsTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class ResultsTest extends AbstractTestCase
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
    public function testResultsEndpoint()
    {
        // Get all top scorers
        $result = $this->statsfc->results([
            'team' => 'Liverpool',
        ]);
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(1, $result->count());
        $this->assertInstanceOf(Result::class, $result->first());
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
                            'name' => 'Arsenal',
                            'shortName' => 'Arsenal',
                        ],
                    ],
                    'players' => [
                        'home' => [
                            [
                                'id' => 10,
                                'number' => 5,
                                'name' => 'Daniel Agger',
                                'shortName' => 'Agger',
                                'position' => 'DF',
                                'role' => 'starting'
                            ], [
                                'id' => 11,
                                'number' => 8,
                                'name' => 'Steven Gerrard',
                                'shortName' => 'Gerrard',
                                'position' => 'MF',
                                'role' => 'starting'
                            ],
                        ],
                        'away' => [
                            [
                                'id' => 12,
                                'number' => 8,
                                'name' => 'Aaron Ramsey',
                                'shortName' => 'Ramsey',
                                'position' => 'MF',
                                'role' => 'starting'
                            ], [
                                'id' => 13,
                                'number' => 52,
                                'name' => 'Niklas Bendtner',
                                'shortName' => 'Bendtner',
                                'position' => 'FW',
                                'role' => 'starting'
                            ],
                        ],
                    ],
                    'score' => [
                        4,
                        3
                    ],
                    'currentState' => [
                        'id' => 5,
                        'key' => 'FT',
                        'name' => 'Full-Time',
                    ],
                    'venue' => [
                        'id' => 6,
                        'name' => 'Anfield Road',
                        'capacity' => 54074,
                    ],
                    'events' => [
                        'cards' => [
                            [
                                'id' => 20,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '25\'',
                                'type' => 'card',
                                'subType' => 'first-yellow',
                                'team' => [
                                    'id' => 3,
                                    'name' => 'Liverpool',
                                    'shortName' => 'Liverpool',
                                ],
                                'player' => [
                                    'id' => 9,
                                    'name' => 'Adam Lallana',
                                    'shortName' => 'Lallana',
                                    'position' => 'MF',
                                ],
                            ],
                        ],
                        'goals' => [
                            [
                                'id' => 25,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '29\'',
                                'type' => 'goal',
                                'subType' => null,
                                'team' => [
                                    'id' => 3,
                                    'name' => 'Liverpool',
                                    'shortName' => 'Liverpool',
                                ],
                                'player' => [
                                    'id' => 10,
                                    'name' => 'Daniel Agger',
                                    'shortName' => 'Agger',
                                    'position' => 'DF',
                                ],
                                'assist' => [
                                    'id' => 11,
                                    'name' => 'Steven Gerrard',
                                    'shortName' => 'Gerrard',
                                    'position' => 'MF',
                                ],
                            ],
                        ],
                        'states' => [
                            [
                                'id' => 30,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '1\'',
                                'type' => 'state',
                                'state' => [
                                    'id' => 1,
                                    'key' => '1H',
                                    'name' => '1st Half',
                                ],
                            ],
                        ],
                        'substitutions' => [
                            [
                                'id' => 35,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '60\'',
                                'type' => 'substitution',
                                'subType' => null,
                                'team' => [
                                    'id' => 3,
                                    'name' => 'Liverpool',
                                    'shortName' => 'Liverpool',
                                ],
                                'playerOff' => [
                                    'id' => 12,
                                    'name' => 'Aaron Ramsey',
                                    'shortName' => 'Ramsey',
                                    'position' => 'MF',
                                ],
                                'playerOn' => [
                                    'id' => 15,
                                    'name' => 'Santiago Cazorla',
                                    'shortName' => 'Cazorla',
                                    'position' => 'MF',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ]);
    }
}