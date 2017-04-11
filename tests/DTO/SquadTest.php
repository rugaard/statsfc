<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use Rugaard\StatsFC\DTO\Player;
use Rugaard\StatsFC\DTO\Squad;
use Rugaard\StatsFC\DTO\Team;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class SquadTest.
 *
 * @package StatsFC\Tests\DTO
 */
class SquadTest extends AbstractTestCase
{
    /**
     * Test squad DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testSquadDTO()
    {
        // Get all squads.
        $result = $this->statsfc->squads();

        /* @var $squad \Rugaard\StatsFC\DTO\Squad */
        $squad = $result->first();

        $this->assertInstanceOf(Squad::class, $squad);

        /* @var $team \Rugaard\StatsFC\DTO\Team */
        $team = $squad->getTeam();
        $this->assertInstanceOf(Team::class, $team);
        $this->assertEquals(1, $team->getId());
        $this->assertEquals('Liverpool', $team->getName());
        $this->assertEquals('Liverpool', $team->getShortName());

        /* @var $player \Rugaard\StatsFC\DTO\Player */
        $player = $squad->getPlayers()->first();
        $this->assertInstanceOf(Player::class, $player);
        $this->assertEquals(1, $player->getId());
        $this->assertNull($player->getNumber());
        $this->assertEquals('Daniel Agger', $player->getName());
        $this->assertEquals('Agger', $player->getShortName());
        $this->assertEquals('DF', $player->getPosition());
        $this->assertNull($player->getRole());
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
                    'team' => [
                        'id' => 1,
                        'name' => 'Liverpool',
                        'shortName' => 'Liverpool',
                    ],
                    'players' => [
                        [
                            'id' => 1,
                            'name' => 'Daniel Agger',
                            'shortName' => 'Agger',
                            'position' => 'DF',
                        ]
                    ]
                ]
            ]
        ]);
    }
}