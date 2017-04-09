<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Competition;
use Rugaard\StatsFC\DTO\Round;

/**
 * Class CompetitionTest.
 *
 * @package StatsFC\Tests
 */
class CompetitionTest extends AbstractTestCase
{
    /**
     * Setup client to return mocked response.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        // Mock response from client.
        $this->statsfc->setClient($this->createMockedGuzzleClient([
            new GuzzleResponse(200, [], $this->getMockedResponse()),
        ]));
    }

    /**
     * Test competition endpoint.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testCompetitionEndpoint()
    {
        // Get all competitions
        $result = $this->statsfc->competitions();
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($result->count(), 2);
        $this->assertInstanceOf(Competition::class, $result->first());
    }

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
        // Get all competitions
        $result = $this->statsfc->competitions();

        // Grab first competition.
        $competition = $result->first();

        $this->assertInstanceOf(Competition::class, $competition);
        $this->assertEquals($competition->getId(), 1);
        $this->assertEquals($competition->getName(), 'Premier League');
        $this->assertEquals($competition->getKey(), 'EPL');
        $this->assertEquals($competition->getRegion(), 'England');
        $this->assertInstanceOf(Collection::class, $competition->getRounds());
        $this->assertEquals($competition->getRounds()->count(), 2);
        $this->assertInstanceOf(Round::class, $competition->getRounds()->first());
    }

    /**
     * Get a mocked response for testing purposes.
     *
     * @return string
     */
    private function getMockedResponse() : string
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
                        ],
                        [
                            'id' => 2,
                            'name' => 'Premier League',
                            'start' => '2017-01-10',
                            'end' => '2017-01-12',
                        ]
                    ]
                ],
                [
                    'id' => 2,
                    'name' => 'Community Shield',
                    'key' => 'ECS',
                    'region' => 'England',
                    'rounds' => [
                        [
                            'id' => 3,
                            'name' => 'Community Shield',
                            'start' => '2017-02-08',
                            'end' => '2017-02-09',
                        ],
                        [
                            'id' => 4,
                            'name' => 'Community Shield',
                            'start' => '2017-03-21',
                            'end' => '2017-03-23',
                        ]
                    ]
                ]
            ]
        ]);
    }
}