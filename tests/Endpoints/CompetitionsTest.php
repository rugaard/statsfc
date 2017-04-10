<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Competition;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class CompetitionsTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class CompetitionsTest extends AbstractTestCase
{
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
                    'rounds' => []
                ],
                [
                    'id' => 2,
                    'name' => 'Community Shield',
                    'key' => 'ECS',
                    'region' => 'England',
                    'rounds' => []
                ]
            ]
        ]);
    }
}