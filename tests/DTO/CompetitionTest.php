<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Competition;
use Rugaard\StatsFC\DTO\Round;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class CompetitionTest.
 *
 * @package StatsFC\Tests\DTO
 */
class CompetitionTest extends AbstractTestCase
{
    /**
     * Test competition DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testCompetitionDTO()
    {
        // Get all competitions.
        $result = $this->statsfc->competitions();

        /* @var $competition \Rugaard\StatsFC\DTO\Competition */
        $competition = $result->first();

        $this->assertInstanceOf(Competition::class, $competition);
        $this->assertEquals(1, $competition->getId());
        $this->assertEquals('Premier League', $competition->getName());
        $this->assertEquals('EPL', $competition->getKey());
        $this->assertEquals('England', $competition->getRegion());
        $this->assertInstanceOf(Collection::class, $competition->getRounds());
        $this->assertEquals(1, $competition->getRounds()->count());
        $this->assertInstanceOf(Round::class, $competition->getRounds()->first());
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
                    'name' => 'Premier League',
                    'key' => 'EPL',
                    'region' => 'England',
                    'rounds' => [
                        [
                            'id' => 1,
                            'name' => 'Premier League',
                            'start' => '2017-01-01',
                            'end' => '2017-01-03',
                        ]
                    ]
                ]
            ]
        ]);
    }
}