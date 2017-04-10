<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use Rugaard\StatsFC\DTO\State;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class StateTest.
 *
 * @package StatsFC\Tests\DTO
 */
class StateTest extends AbstractTestCase
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
    public function testStateDTO()
    {
        // Get all competitions
        $result = $this->statsfc->states();

        // Grab first competition.
        $state = $result->first();

        $this->assertInstanceOf(State::class, $state);
        $this->assertEquals($state->getId(), 1);
        $this->assertEquals($state->getKey(), 'HT');
        $this->assertEquals($state->getName(), 'Half-Time');
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
                    'key' => 'HT',
                    'name' => 'Half-Time',
                ],
            ]
        ]);
    }
}