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
     * Test state DTO.
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
        // Get all states.
        $result = $this->statsfc->states();

        /* @var $state \Rugaard\StatsFC\DTO\State */
        $state = $result->first();

        $this->assertInstanceOf(State::class, $state);
        $this->assertEquals(1, $state->getId());
        $this->assertEquals('HT', $state->getKey());
        $this->assertEquals('Half-Time', $state->getName());
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