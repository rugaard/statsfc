<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use DateTime;
use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Competition;
use Rugaard\StatsFC\DTO\Round;
use Rugaard\StatsFC\DTO\Fixture;
use Rugaard\StatsFC\DTO\Team;
use Rugaard\StatsFC\DTO\State;
use Rugaard\StatsFC\DTO\Venue;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class FixtureTest.
 *
 * @package StatsFC\Tests\DTO
 */
class FixtureTest extends AbstractTestCase
{
    /**
     * Test fixture DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testFixtureDTO()
    {
        // Get all fixtures.
        $result = $this->statsfc->fixtures([
            'team' => 'Liverpool',
        ]);

        /* @var $fixture \Rugaard\StatsFC\DTO\Fixture */
        $fixture = $result->first();
        $this->assertInstanceOf(Fixture::class, $fixture);
        $this->assertEquals(1, $fixture->getId());
        $this->assertInstanceOf(DateTime::class, $fixture->getTimestamp());
        $this->assertEquals('2017-04-11T20:25:00+0000', $fixture->getTimestamp()->format('Y-m-d\TH:i:sO'));

        /* @var $competition \Rugaard\StatsFC\DTO\Competition */
        $competition = $fixture->getCompetition();
        $this->assertInstanceOf(Competition::class, $competition);
        $this->assertEquals(1, $competition->getId());
        $this->assertEquals('Premier League', $competition->getName());
        $this->assertEquals('EPL', $competition->getKey());
        $this->assertEquals('England', $competition->getRegion());

        /* @var $round \Rugaard\StatsFC\DTO\Round */
        $round = $fixture->getRound();
        $this->assertInstanceOf(Round::class, $round);
        $this->assertEquals(2, $round->getId());
        $this->assertEquals('Premier League', $round->getName());
        $this->assertInstanceOf(DateTime::class, $round->getStart());
        $this->assertEquals('2016-08-15', $round->getStart()->format('Y-m-d'));
        $this->assertInstanceOf(DateTime::class, $round->getEnd());
        $this->assertEquals('2017-04-28', $round->getEnd()->format('Y-m-d'));

        /* @var $homeTeam \Rugaard\StatsFC\DTO\Team */
        $homeTeam = $fixture->getTeam('home');
        $this->assertInstanceOf(Team::class, $homeTeam);
        $this->assertEquals(3, $homeTeam->getId());
        $this->assertEquals('Liverpool', $homeTeam->getName());
        $this->assertEquals('Liverpool', $homeTeam->getShortName());

        /* @var $awayTeam \Rugaard\StatsFC\DTO\Team */
        $awayTeam = $fixture->getTeam('away');
        $this->assertInstanceOf(Team::class, $awayTeam);
        $this->assertEquals(4, $awayTeam->getId());
        $this->assertEquals('Manchester United', $awayTeam->getName());
        $this->assertEquals('Man. Utd.', $awayTeam->getShortName());

        /* @var $teams \Illuminate\Support\Collection */
        $teams = $fixture->getTeams();
        $this->assertInstanceOf(Collection::class, $teams);
        $this->assertEquals(2, $teams->count());
        $this->assertArrayHasKey('home', $teams);
        $this->assertInstanceOf(Team::class, $teams->first());
        $this->assertArrayHasKey('away', $teams);
        $this->assertInstanceOf(Team::class, $teams->last());
        $this->assertNull($fixture->getTeam('non-existing-side'));

        /* @var $state \Rugaard\StatsFC\DTO\State */
        $state = $fixture->getCurrentState();
        $this->assertInstanceOf(State::class, $state);
        $this->assertEquals(5, $state->getId());
        $this->assertEquals('FX', $state->getKey());
        $this->assertEquals('Fixture', $state->getName());

        /* @var $venue \Rugaard\StatsFC\DTO\Venue */
        $venue = $fixture->getVenue();
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
                            'name' => 'Manchester United',
                            'shortName' => 'Man. Utd.',
                        ]
                    ],
                    'currentState' => [
                        'id' => 5,
                        'key' => 'FX',
                        'name' => 'Fixture',
                    ],
                    'venue' => [
                        'id' => 6,
                        'name' => 'Anfield Road',
                        'capacity' => 54074,
                    ]
                ],
            ]
        ]);
    }
}