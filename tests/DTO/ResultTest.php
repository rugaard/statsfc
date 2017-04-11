<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use DateTime;
use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Competition;
use Rugaard\StatsFC\DTO\Round;
use Rugaard\StatsFC\DTO\Result;
use Rugaard\StatsFC\DTO\Team;
use Rugaard\StatsFC\DTO\State;
use Rugaard\StatsFC\DTO\Venue;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class ResultTest.
 *
 * @package StatsFC\Tests\DTO
 */
class ResultTest extends AbstractTestCase
{
    /**
     * Test result DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testResultDTO()
    {
        // Get all results.
        $result = $this->statsfc->results([
            'team' => 'Liverpool',
        ]);

        /* @var $item \Rugaard\StatsFC\DTO\Result */
        $item = $result->first();
        $this->assertInstanceOf(Result::class, $item);
        $this->assertInstanceOf(DateTime::class, $item->getTimestamp());
        $this->assertEquals('2017-04-11T20:25:00+0000', $item->getTimestamp()->format('Y-m-d\TH:i:sO'));

        /* @var $competition \Rugaard\StatsFC\DTO\Competition */
        $competition = $item->getCompetition();
        $this->assertInstanceOf(Competition::class, $competition);
        $this->assertEquals(1, $competition->getId());
        $this->assertEquals('Premier League', $competition->getName());
        $this->assertEquals('EPL', $competition->getKey());
        $this->assertEquals('England', $competition->getRegion());

        /* @var $round \Rugaard\StatsFC\DTO\Round */
        $round = $item->getRound();
        $this->assertInstanceOf(Round::class, $round);
        $this->assertEquals(2, $round->getId());
        $this->assertEquals('Premier League', $round->getName());
        $this->assertInstanceOf(DateTime::class, $round->getStart());
        $this->assertEquals('2016-08-15', $round->getStart()->format('Y-m-d'));
        $this->assertInstanceOf(DateTime::class, $round->getEnd());
        $this->assertEquals('2017-04-28', $round->getEnd()->format('Y-m-d'));

        /* @var $teams \Illuminate\Support\Collection */
        $teams = $item->getTeams();
        $this->assertInstanceOf(Collection::class, $teams);
        $this->assertEquals(2, $teams->count());
        $this->assertArrayHasKey('home', $teams);
        $this->assertInstanceOf(Team::class, $teams->first());
        $this->assertArrayHasKey('away', $teams);
        $this->assertInstanceOf(Team::class, $teams->last());

        /* @var $homeTeam \Rugaard\StatsFC\DTO\Team */
        $homeTeam = $item->getTeam('home');
        $this->assertInstanceOf(Team::class, $homeTeam);
        $this->assertEquals(3, $homeTeam->getId());
        $this->assertEquals('Liverpool', $homeTeam->getName());
        $this->assertEquals('Liverpool', $homeTeam->getShortName());

        /* @var $awayTeam \Rugaard\StatsFC\DTO\Team */
        $awayTeam = $item->getTeam('away');
        $this->assertInstanceOf(Team::class, $awayTeam);
        $this->assertEquals(4, $awayTeam->getId());
        $this->assertEquals('Arsenal', $awayTeam->getName());
        $this->assertEquals('Arsenal', $awayTeam->getShortName());

        /* @var $players \Illuminate\Support\Collection */
        $players = $item->getAllPlayers();
        $this->assertInstanceOf(Collection::class, $players);
        $this->assertEquals(2, $players->count());
        $this->assertArrayHasKey('home', $players);
        $this->assertInstanceOf(Collection::class, $players->first());
        $this->assertArrayHasKey('away', $players);
        $this->assertInstanceOf(Collection::class, $players->last());

        /* @var $homePlayers \Illuminate\Support\Collection */
        $homePlayers = $item->getPlayers('home');
        $this->assertInstanceOf(Collection::class, $homePlayers);
        $this->assertEquals(2, $homePlayers->get('starting')->count());

        /* @var $homePlayer \Rugaard\StatsFC\DTO\Player */
        $homePlayer = $homePlayers->get('starting')->first();
        $this->assertEquals(10, $homePlayer->getId());
        $this->assertEquals(5, $homePlayer->getNumber());
        $this->assertEquals('Daniel Agger', $homePlayer->getName());
        $this->assertEquals('Agger', $homePlayer->getShortName());
        $this->assertEquals('DF', $homePlayer->getPosition());
        $this->assertEquals('starting', $homePlayer->getRole());

        /* @var $awayPlayers \Illuminate\Support\Collection */
        $awayPlayers = $item->getPlayers('away');
        $this->assertInstanceOf(Collection::class, $awayPlayers);
        $this->assertEquals(2, $awayPlayers->get('starting')->count());

        /* @var $awayPlayer \Rugaard\StatsFC\DTO\Player */
        $awayPlayer = $awayPlayers->get('starting')->first();
        $this->assertEquals(12, $awayPlayer->getId());
        $this->assertEquals(8, $awayPlayer->getNumber());
        $this->assertEquals('Aaron Ramsey', $awayPlayer->getName());
        $this->assertEquals('Ramsey', $awayPlayer->getShortName());
        $this->assertEquals('MF', $awayPlayer->getPosition());
        $this->assertEquals('starting', $awayPlayer->getRole());

        /* @var $state \Rugaard\StatsFC\DTO\State */
        $state = $item->getCurrentState();
        $this->assertInstanceOf(State::class, $state);
        $this->assertEquals(5, $state->getId());
        $this->assertEquals('FT', $state->getKey());
        $this->assertEquals('Full-Time', $state->getName());

        /* @var $venue \Rugaard\StatsFC\DTO\Venue */
        $venue = $item->getVenue();
        $this->assertInstanceOf(Venue::class, $venue);
        $this->assertEquals(6, $venue->getId());
        $this->assertEquals('Anfield Road', $venue->getName());
        $this->assertEquals(54074, $venue->getCapacity());
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