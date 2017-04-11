<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use DateTime;
use Rugaard\StatsFC\DTO\Season;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class SeasonTest.
 *
 * @package StatsFC\Tests\DTO
 */
class SeasonTest extends AbstractTestCase
{
    /**
     * Test season DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testSeasonDTO()
    {
        // Get all seasons.
        $result = $this->statsfc->seasons();

        /* @var $season \Rugaard\StatsFC\DTO\Season */
        $season = $result->first();

        $this->assertInstanceOf(Season::class, $season);
        $this->assertEquals(1, $season->getId());
        $this->assertEquals('2015/2016', $season->getName());
        $this->assertInstanceOf(DateTime::class, $season->getStart());
        $this->assertEquals('2015-06-30', $season->getStart()->format('Y-m-d'));
        $this->assertInstanceOf(DateTime::class, $season->getEnd());
        $this->assertEquals('2016-06-30', $season->getEnd()->format('Y-m-d'));
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
                ]
            ]
        ]);
    }
}