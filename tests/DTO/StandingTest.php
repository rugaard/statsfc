<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use DateTime;
use Rugaard\StatsFC\DTO\Competition;
use Rugaard\StatsFC\DTO\Round;
use Rugaard\StatsFC\DTO\Standing;
use Rugaard\StatsFC\DTO\Team;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class StandingTest.
 *
 * @package StatsFC\Tests\DTO
 */
class StandingTest extends AbstractTestCase
{
    /**
     * Test state DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testStandingDTO()
    {
        // Get all standings.
        $result = $this->statsfc->standings();

        /* @var $standing \Rugaard\StatsFC\DTO\Standing */
        $standing = $result->first();
        $this->assertInstanceOf(Standing::class, $standing);
        $this->assertEquals(1, $standing->getPosition());
        $this->assertEquals(38, $standing->getPlayed());
        $this->assertEquals(26, $standing->getWins());
        $this->assertEquals(9, $standing->getDraws());
        $this->assertEquals(3, $standing->getLosses());
        $this->assertEquals(73, $standing->getGoals('for'));
        $this->assertEquals(32, $standing->getGoals('against'));
        $this->assertEquals(41, $standing->getGoals('difference'));
        $this->assertEquals(87, $standing->getPoints());
        $this->assertEquals('top1', $standing->getInfo());
        $this->assertNull($standing->getNotes());

        /* @var $competition \Rugaard\StatsFC\DTO\Competition */
        $competition = $standing->getCompetition();
        $this->assertInstanceOf(Competition::class, $competition);
        $this->assertEquals(1, $competition->getId());
        $this->assertEquals('Premier League', $competition->getName());
        $this->assertEquals('EPL', $competition->getKey());
        $this->assertEquals('England', $competition->getRegion());

        /* @var $round \Rugaard\StatsFC\DTO\Round */
        $round = $standing->getRound();
        $this->assertInstanceOf(Round::class, $round);
        $this->assertEquals(2, $round->getId());
        $this->assertEquals('Premier League', $round->getName());
        $this->assertInstanceOf(DateTime::class, $round->getStart());
        $this->assertEquals('2016-08-15', $round->getStart()->format('Y-m-d'));
        $this->assertInstanceOf(DateTime::class, $round->getEnd());
        $this->assertEquals('2017-04-28', $round->getEnd()->format('Y-m-d'));

        /* @var $team \Rugaard\StatsFC\DTO\Team */
        $team = $standing->getTeam();
        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals(3, $team->getId());
        $this->assertEquals('Liverpool', $team->getName());
        $this->assertEquals('Liverpool', $team->getShortName());
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
                ],
            ]
        ]);
    }
}