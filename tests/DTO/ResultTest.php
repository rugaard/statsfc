<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\Tests\DTO;

use DateTime;
use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\Competition;
use Rugaard\StatsFC\DTO\Events\Card;
use Rugaard\StatsFC\DTO\Events\Goal;
use Rugaard\StatsFC\DTO\Events\State;
use Rugaard\StatsFC\DTO\Events\Substitution;
use Rugaard\StatsFC\DTO\Player;
use Rugaard\StatsFC\DTO\Round;
use Rugaard\StatsFC\DTO\Result;
use Rugaard\StatsFC\DTO\Team;
use Rugaard\StatsFC\DTO\State as OriginalState;
use Rugaard\StatsFC\DTO\Venue;
use Rugaard\StatsFC\Tests\AbstractTestCase;

/**
 * Class ResultTest.
 *
 * @package StatsFC\Tests\DTO
 */
class ResultTest extends AbstractTestCase
{
    /**
     * Test result DTO.
     *
     * @return void
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function testResultDTO()
    {
        // Get all results.
        $result = $this->statsfc->results([
            'team' => 'Liverpool',
        ]);

        /* @var $item \Rugaard\StatsFC\DTO\Result */
        $item = $result->first();
        $this->assertInstanceOf(Result::class, $item);
        $this->assertEquals(1, $item->getId());
        $this->assertInstanceOf(DateTime::class, $item->getTimestamp());
        $this->assertEquals('2017-04-11T20:25:00+0000', $item->getTimestamp()->format('Y-m-d\TH:i:sO'));
        $this->assertEquals(4, $item->getScore('home'));
        $this->assertEquals(3, $item->getScore('away'));
        $this->assertEquals('4 - 3', $item->getFullScore());

        /* @var $competition \Rugaard\StatsFC\DTO\Competition */
        $competition = $item->getCompetition();
        $this->assertInstanceOf(Competition::class, $competition);
        $this->assertEquals(1, $competition->getId());
        $this->assertEquals('Premier League', $competition->getName());
        $this->assertEquals('EPL', $competition->getKey());
        $this->assertEquals('England', $competition->getRegion());

        /* @var $round \Rugaard\StatsFC\DTO\Round */
        $round = $item->getRound();
        $this->assertInstanceOf(Round::class, $round);
        $this->assertEquals(2, $round->getId());
        $this->assertEquals('Premier League', $round->getName());
        $this->assertInstanceOf(DateTime::class, $round->getStart());
        $this->assertEquals('2016-08-15', $round->getStart()->format('Y-m-d'));
        $this->assertInstanceOf(DateTime::class, $round->getEnd());
        $this->assertEquals('2017-04-28', $round->getEnd()->format('Y-m-d'));

        /* @var $teams \Illuminate\Support\Collection */
        $teams = $item->getTeams();
        $this->assertInstanceOf(Collection::class, $teams);
        $this->assertEquals(2, $teams->count());
        $this->assertArrayHasKey('home', $teams);
        $this->assertInstanceOf(Team::class, $teams->first());
        $this->assertArrayHasKey('away', $teams);
        $this->assertInstanceOf(Team::class, $teams->last());
        $this->assertNull($item->getTeam('non-existing-side'));

        /* @var $homeTeam \Rugaard\StatsFC\DTO\Team */
        $homeTeam = $item->getTeam('home');
        $this->assertInstanceOf(Team::class, $homeTeam);
        $this->assertEquals(3, $homeTeam->getId());
        $this->assertEquals('Liverpool', $homeTeam->getName());
        $this->assertEquals('Liverpool', $homeTeam->getShortName());

        /* @var $awayTeam \Rugaard\StatsFC\DTO\Team */
        $awayTeam = $item->getTeam('away');
        $this->assertInstanceOf(Team::class, $awayTeam);
        $this->assertEquals(4, $awayTeam->getId());
        $this->assertEquals('Arsenal', $awayTeam->getName());
        $this->assertEquals('Arsenal', $awayTeam->getShortName());

        /* @var $players \Illuminate\Support\Collection */
        $players = $item->getAllPlayers();
        $this->assertInstanceOf(Collection::class, $players);
        $this->assertEquals(2, $players->count());
        $this->assertArrayHasKey('home', $players);
        $this->assertInstanceOf(Collection::class, $players->first());
        $this->assertArrayHasKey('away', $players);
        $this->assertInstanceOf(Collection::class, $players->last());
        $this->assertNull($item->getPlayers('non-existing-side'));

        /* @var $homePlayers \Illuminate\Support\Collection */
        $homePlayers = $item->getPlayers('home');
        $this->assertInstanceOf(Collection::class, $homePlayers);
        $this->assertEquals(2, $homePlayers->get('starting')->count());

        /* @var $homePlayer \Rugaard\StatsFC\DTO\Player */
        $homePlayer = $homePlayers->get('starting')->first();
        $this->assertEquals(10, $homePlayer->getId());
        $this->assertEquals(5, $homePlayer->getNumber());
        $this->assertEquals('Daniel Agger', $homePlayer->getName());
        $this->assertEquals('Agger', $homePlayer->getShortName());
        $this->assertEquals('DF', $homePlayer->getPosition());
        $this->assertEquals('starting', $homePlayer->getRole());

        /* @var $awayPlayers \Illuminate\Support\Collection */
        $awayPlayers = $item->getPlayers('away');
        $this->assertInstanceOf(Collection::class, $awayPlayers);
        $this->assertEquals(2, $awayPlayers->get('starting')->count());

        /* @var $awayPlayer \Rugaard\StatsFC\DTO\Player */
        $awayPlayer = $awayPlayers->get('starting')->first();
        $this->assertEquals(12, $awayPlayer->getId());
        $this->assertEquals(8, $awayPlayer->getNumber());
        $this->assertEquals('Aaron Ramsey', $awayPlayer->getName());
        $this->assertEquals('Ramsey', $awayPlayer->getShortName());
        $this->assertEquals('MF', $awayPlayer->getPosition());
        $this->assertEquals('starting', $awayPlayer->getRole());

        /* @var $state \Rugaard\StatsFC\DTO\State */
        $state = $item->getCurrentState();
        $this->assertInstanceOf(OriginalState::class, $state);
        $this->assertEquals(5, $state->getId());
        $this->assertEquals('FT', $state->getKey());
        $this->assertEquals('Full-Time', $state->getName());

        /* @var $venue \Rugaard\StatsFC\DTO\Venue */
        $venue = $item->getVenue();
        $this->assertInstanceOf(Venue::class, $venue);
        $this->assertEquals(6, $venue->getId());
        $this->assertEquals('Anfield Road', $venue->getName());
        $this->assertEquals(54074, $venue->getCapacity());

        /* @var $eventCards \Illuminate\Support\Collection */
        $eventCards = $item->getEvents('cards');
        $this->assertInstanceOf(Collection::class, $eventCards);
        $this->assertEquals(1, $eventCards->count());

        /* @var $eventCard \Rugaard\StatsFC\DTO\Events\Card */
        $eventCard = $eventCards->first();
        $this->assertInstanceOf(Card::class, $eventCard);
        $this->assertEquals(20, $eventCard->getId());
        $this->assertInstanceOf(DateTime::class, $eventCard->getTimestamp());
        $this->assertEquals('2017-04-11T20:31:25+0000', $eventCard->getTimestamp()->format('Y-m-d\TH:i:sO'));
        $this->assertEquals('25\'', $eventCard->getMatchTime());
        $this->assertEquals('card', $eventCard->getType());
        $this->assertEquals('first-yellow', $eventCard->getSubType());
        $this->assertInstanceOf(Team::class, $eventCard->getTeam());
        $this->assertEquals(3, $eventCard->getTeam()->getId());
        $this->assertEquals('Liverpool', $eventCard->getTeam()->getName());
        $this->assertEquals('Liverpool', $eventCard->getTeam()->getShortName());
        $this->assertInstanceOf(Player::class, $eventCard->getPlayer());
        $this->assertEquals(9, $eventCard->getPlayer()->getId());
        $this->assertEquals('Adam Lallana', $eventCard->getPlayer()->getName());
        $this->assertEquals('Lallana', $eventCard->getPlayer()->getShortName());
        $this->assertEquals('MF', $eventCard->getPlayer()->getPosition());

        /* @var $eventGoals \Illuminate\Support\Collection */
        $eventGoals = $item->getEvents('goals');
        $this->assertInstanceOf(Collection::class, $eventGoals);
        $this->assertEquals(1, $eventGoals->count());

        /* @var $eventGoal \Rugaard\StatsFC\DTO\Events\Goal */
        $eventGoal = $eventGoals->first();
        $this->assertInstanceOf(Goal::class, $eventGoal);
        $this->assertEquals(25, $eventGoal->getId());
        $this->assertInstanceOf(DateTime::class, $eventGoal->getTimestamp());
        $this->assertEquals('2017-04-11T20:31:25+0000', $eventGoal->getTimestamp()->format('Y-m-d\TH:i:sO'));
        $this->assertEquals('29\'', $eventGoal->getMatchTime());
        $this->assertEquals('goal', $eventGoal->getType());
        $this->assertNull($eventGoal->getSubType());
        $this->assertInstanceOf(Team::class, $eventGoal->getTeam());
        $this->assertEquals(3, $eventGoal->getTeam()->getId());
        $this->assertEquals('Liverpool', $eventGoal->getTeam()->getName());
        $this->assertEquals('Liverpool', $eventGoal->getTeam()->getShortName());
        $this->assertInstanceOf(Player::class, $eventGoal->getGoalscorer());
        $this->assertEquals(10, $eventGoal->getGoalscorer()->getId());
        $this->assertEquals('Daniel Agger', $eventGoal->getGoalscorer()->getName());
        $this->assertEquals('Agger', $eventGoal->getGoalscorer()->getShortName());
        $this->assertEquals('DF', $eventGoal->getGoalscorer()->getPosition());
        $this->assertInstanceOf(Player::class, $eventGoal->getAssist());
        $this->assertEquals(11, $eventGoal->getAssist()->getId());
        $this->assertEquals('Steven Gerrard', $eventGoal->getAssist()->getName());
        $this->assertEquals('Gerrard', $eventGoal->getAssist()->getShortName());
        $this->assertEquals('MF', $eventGoal->getAssist()->getPosition());

        /* @var $eventStates \Illuminate\Support\Collection */
        $eventStates = $item->getEvents('states');
        $this->assertInstanceOf(Collection::class, $eventStates);
        $this->assertEquals(1, $eventStates->count());

        /* @var $eventState \Rugaard\StatsFC\DTO\Events\State */
        $eventState = $eventStates->first();
        $this->assertInstanceOf(State::class, $eventState);
        $this->assertEquals(30, $eventState->getId());
        $this->assertInstanceOf(DateTime::class, $eventState->getTimestamp());
        $this->assertEquals('2017-04-11T20:31:25+0000', $eventState->getTimestamp()->format('Y-m-d\TH:i:sO'));
        $this->assertEquals('1\'', $eventState->getMatchTime());
        $this->assertEquals('state', $eventState->getType());
        $this->assertInstanceOf(OriginalState::class, $eventState->getState());
        $this->assertEquals(1, $eventState->getState()->getId());
        $this->assertEquals('1H', $eventState->getState()->getKey());
        $this->assertEquals('1st Half', $eventState->getState()->getName());

        /* @var $eventSubstitutions \Illuminate\Support\Collection */
        $eventSubstitutions = $item->getEvents('substitutions');
        $this->assertInstanceOf(Collection::class, $eventSubstitutions);
        $this->assertEquals(1, $eventSubstitutions->count());

        /* @var $eventSubstitution \Rugaard\StatsFC\DTO\Events\Substitution */
        $eventSubstitution = $eventSubstitutions->first();
        $this->assertInstanceOf(Substitution::class, $eventSubstitution);
        $this->assertEquals(35, $eventSubstitution->getId());
        $this->assertInstanceOf(DateTime::class, $eventSubstitution->getTimestamp());
        $this->assertEquals('2017-04-11T20:31:25+0000', $eventSubstitution->getTimestamp()->format('Y-m-d\TH:i:sO'));
        $this->assertEquals('60\'', $eventSubstitution->getMatchTime());
        $this->assertEquals('substitution', $eventSubstitution->getType());
        $this->assertNull($eventSubstitution->getSubType());
        $this->assertInstanceOf(Team::class, $eventSubstitution->getTeam());
        $this->assertEquals(4, $eventSubstitution->getTeam()->getId());
        $this->assertEquals('Arsenal', $eventSubstitution->getTeam()->getName());
        $this->assertEquals('Arsenal', $eventSubstitution->getTeam()->getShortName());
        $this->assertInstanceOf(Player::class, $eventSubstitution->getPlayerOff());
        $this->assertEquals(12, $eventSubstitution->getPlayerOff()->getId());
        $this->assertEquals('Aaron Ramsey', $eventSubstitution->getPlayerOff()->getName());
        $this->assertEquals('Ramsey', $eventSubstitution->getPlayerOff()->getShortName());
        $this->assertEquals('MF', $eventSubstitution->getPlayerOff()->getPosition());
        $this->assertInstanceOf(Player::class, $eventSubstitution->getPlayerOn());
        $this->assertEquals(15, $eventSubstitution->getPlayerOn()->getId());
        $this->assertEquals('Santiago Cazorla', $eventSubstitution->getPlayerOn()->getName());
        $this->assertEquals('Cazorla', $eventSubstitution->getPlayerOn()->getShortName());
        $this->assertEquals('MF', $eventSubstitution->getPlayerOn()->getPosition());
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
                    'timestamp' => '2017-04-11T20:25:00+0000',
                    'competition' => [
                        'id' => 1,
                        'name' => 'Premier League',
                        'key' => 'EPL',
                        'region' => 'England',
                    ],
                    'round' => [
                        'id' => 2,
                        'name' => 'Premier League',
                        'start' => '2016-08-15',
                        'end' => '2017-04-28',
                    ],
                    'teams' => [
                        'home' => [
                            'id' => 3,
                            'name' => 'Liverpool',
                            'shortName' => 'Liverpool',
                        ],
                        'away' => [
                            'id' => 4,
                            'name' => 'Arsenal',
                            'shortName' => 'Arsenal',
                        ],
                    ],
                    'players' => [
                        'home' => [
                            [
                                'id' => 10,
                                'number' => 5,
                                'name' => 'Daniel Agger',
                                'shortName' => 'Agger',
                                'position' => 'DF',
                                'role' => 'starting'
                            ], [
                                'id' => 11,
                                'number' => 8,
                                'name' => 'Steven Gerrard',
                                'shortName' => 'Gerrard',
                                'position' => 'MF',
                                'role' => 'starting'
                            ],
                        ],
                        'away' => [
                            [
                                'id' => 12,
                                'number' => 8,
                                'name' => 'Aaron Ramsey',
                                'shortName' => 'Ramsey',
                                'position' => 'MF',
                                'role' => 'starting'
                            ], [
                                'id' => 13,
                                'number' => 52,
                                'name' => 'Niklas Bendtner',
                                'shortName' => 'Bendtner',
                                'position' => 'FW',
                                'role' => 'starting'
                            ],
                        ],
                    ],
                    'score' => [
                        4,
                        3
                    ],
                    'currentState' => [
                        'id' => 5,
                        'key' => 'FT',
                        'name' => 'Full-Time',
                    ],
                    'venue' => [
                        'id' => 6,
                        'name' => 'Anfield Road',
                        'capacity' => 54074,
                    ],
                    'events' => [
                        'cards' => [
                            [
                                'id' => 20,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '25\'',
                                'type' => 'card',
                                'subType' => 'first-yellow',
                                'team' => [
                                    'id' => 3,
                                    'name' => 'Liverpool',
                                    'shortName' => 'Liverpool',
                                ],
                                'player' => [
                                    'id' => 9,
                                    'name' => 'Adam Lallana',
                                    'shortName' => 'Lallana',
                                    'position' => 'MF',
                                ],
                            ],
                        ],
                        'goals' => [
                            [
                                'id' => 25,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '29\'',
                                'type' => 'goal',
                                'subType' => null,
                                'team' => [
                                    'id' => 3,
                                    'name' => 'Liverpool',
                                    'shortName' => 'Liverpool',
                                ],
                                'player' => [
                                    'id' => 10,
                                    'name' => 'Daniel Agger',
                                    'shortName' => 'Agger',
                                    'position' => 'DF',
                                ],
                                'assist' => [
                                    'id' => 11,
                                    'name' => 'Steven Gerrard',
                                    'shortName' => 'Gerrard',
                                    'position' => 'MF',
                                ],
                            ],
                        ],
                        'states' => [
                            [
                                'id' => 30,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '1\'',
                                'type' => 'state',
                                'state' => [
                                    'id' => 1,
                                    'key' => '1H',
                                    'name' => '1st Half',
                                ],
                            ],
                        ],
                        'substitutions' => [
                            [
                                'id' => 35,
                                'timestamp' => '2017-04-11T20:31:25+0000',
                                'matchTime' => '60\'',
                                'type' => 'substitution',
                                'subType' => null,
                                'team' => [
                                    'id' => 4,
                                    'name' => 'Arsenal',
                                    'shortName' => 'Arsenal',
                                ],
                                'playerOff' => [
                                    'id' => 12,
                                    'name' => 'Aaron Ramsey',
                                    'shortName' => 'Ramsey',
                                    'position' => 'MF',
                                ],
                                'playerOn' => [
                                    'id' => 15,
                                    'name' => 'Santiago Cazorla',
                                    'shortName' => 'Cazorla',
                                    'position' => 'MF',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ]);
    }
}