<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use Rugaard\StatsFC\DTO\Player;
use Rugaard\StatsFC\DTO\TopScorer;
use Rugaard\StatsFC\DTO\Team;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class TopScorerTest.
 *
 * @package StatsFC\Tests\DTO
 */
class TopScorerTest extends AbstractTestCase
{
    /**
     * Test top scorer DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testTopScorerDTO()
    {
        // Get all top scorers.
        $result = $this->statsfc->topScorers([
            'team' => 'Liverpool',
        ]);

        /* @var $topScorer \Rugaard\StatsFC\DTO\TopScorer */
        $topScorer = $result->first();

        $this->assertInstanceOf(TopScorer::class, $topScorer);
        $this->assertEquals(1, $topScorer->getId());
        $this->assertEquals(28, $topScorer->getGoals());

        /* @var $team \Rugaard\StatsFC\DTO\Team */
        $team = $topScorer->getTeam();
        $this->assertInstanceOf(Team::class, $team);
        $this->assertNull($team->getId());
        $this->assertEquals('Liverpool', $team->getName());
        $this->assertEquals('Liverpool', $team->getShortName());

        /* @var $player \Rugaard\StatsFC\DTO\Player */
        $player = $topScorer->getPlayer();
        $this->assertInstanceOf(Player::class, $player);
        $this->assertNull($player->getId());
        $this->assertEquals('Steven Gerrard', $player->getName());
        $this->assertEquals('Gerrard', $player->getShortName());
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
                    'team' => [
                        'name' => 'Liverpool',
                        'shortName' => 'Liverpool',
                    ],
                    'player' => [
                        'name' => 'Steven Gerrard',
                        'shortName' => 'Gerrard',
                    ],
                    'goals' => 28,
                ],
            ]
        ]);
    }
}