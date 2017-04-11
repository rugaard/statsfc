<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Squad;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class SquadsTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class SquadsTest extends AbstractTestCase
{
    /**
     * Test squads endpoint.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testSquadsEndpoint()
    {
        // Get all seasons
        $result = $this->statsfc->squads();
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals(2, $result->count());
        $this->assertInstanceOf(Squad::class, $result->first());
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
                        ], [
                            'id' => 2,
                            'name' => 'Steven Gerrard',
                            'shortName' => 'Gerrard',
                            'position' => 'MF',
                        ]
                    ]
                ],
                [
                    'team' => [
                        'id' => 2,
                        'name' => 'Arsenal',
                        'shortName' => 'Arsenal',
                    ],
                    'players' => [
                        [
                            'id' => 1,
                            'name' => 'Aaron Ramsey',
                            'shortName' => 'Ramsey',
                            'position' => 'MF',
                        ], [
                            'id' => 2,
                            'name' => 'Santiago Carzorla',
                            'shortName' => 'Carzorla',
                            'position' => 'MF',
                        ]
                    ]
                ],
            ]
        ]);
    }
}