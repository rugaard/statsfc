<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\Endpoints;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Season;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class SeasonsTest.
 *
 * @package StatsFC\Tests\Endpoints
 */
class SeasonsTest extends AbstractTestCase
{
    /**
     * Test seasons endpoint.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testSeasonsEndpoint()
    {
        // Get all seasons
        $result = $this->statsfc->seasons();
        
        $this->assertInstanceOf(Collection::class, $result);
        $this->assertEquals($result->count(), 2);
        $this->assertInstanceOf(Season::class, $result->first());
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
                    'name' => '2015/2016',
                    'start' => '2015-06-30',
                    'end' => '2016-06-30'
                ],
                [
                    'id' => 2,
                    'name' => '2016/2017',
                    'start' => '2016-06-30',
                    'end' => '2017-06-30'
                ],
            ]
        ]);
    }
}