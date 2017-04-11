<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\TopScorer;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class TopScorersTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class TopScorersTest extends AbstractTestCase
{
    /**
     * Test top scorers endpoint.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testTopScorersEndpoint()
    {
        // Get all top scorers
        $result = $this->statsfc->topScorers([
            'team' => 'Liverpool',
        ]);
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(2, $result->count());
        $this->assertInstanceOf(TopScorer::class, $result->first());
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
                [
                    'id' => 2,
                    'team' => [
                        'name' => 'Liverpool',
                        'shortName' => 'Liverpool',
                    ],
                    'player' => [
                        'name' => 'Philippe Coutinho',
                        'shortName' => 'Coutinho',
                    ],
                    'goals' => 16,
                ],
            ]
        ]);
    }
}