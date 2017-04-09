<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

use DateTime;
use Illuminate\Support\Collection;

/**
 * Class Fixture.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Fixture
{
    /**
     * Fixture ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Timestamp of fixture.
     *
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * Competition of fixture.
     *
     * @var \Rugaard\StatsFC\DTO\Competition
     */
    protected $competition;

    /**
     * Round of fixture.
     *
     * @var \Rugaard\StatsFC\DTO\Round
     */
    protected $round;

    /**
     * Teams of fixture.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $teams;

    /**
     * Current state of fixture.
     *
     * @var \Rugaard\StatsFC\DTO\State
     */
    protected $currentState;

    /**
     * Venue of fixture.
     *
     * @var \Rugaard\StatsFC\DTO\Venue
     */
    protected $venue;

    /**
     * Fixture constructor.
     */
    public function __construct()
    {
        // Make sure $teams is an empty collection.
        $this->teams = collect();
    }

    /**
     * Set fixture ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Fixture
     */
    public function setId(int $id) : Fixture
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get fixture ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set timestamp of fixture.
     *
     * @param  string $timestamp
     * @return \Rugaard\StatsFC\DTO\Fixture
     */
    public function setTimestamp(string $timestamp) : Fixture
    {
        $this->timestamp = new DateTime($timestamp);
        return $this;
    }

    /**
     * Get timestamp of fixture.
     *
     * @return \DateTime
     */
    public function getTimestamp() :? DateTime
    {
        return $this->timestamp;
    }

    /**
     * Set competition of fixture.
     *
     * @param  \Rugaard\StatsFC\DTO\Competition $competition
     * @return \Rugaard\StatsFC\DTO\Fixture
     */
    public function setCompetition(Competition $competition) : Fixture
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * Get competition of fixture.
     *
     * @return \Rugaard\StatsFC\DTO\Competition|null
     */
    public function getCompetition() :? Competition
    {
        return $this->competition;
    }

    /**
     * Set round of fixture.
     *
     * @param  \Rugaard\StatsFC\DTO\Round $round
     * @return \Rugaard\StatsFC\DTO\Fixture
     */
    public function setRound(Round $round) : Fixture
    {
        $this->round = $round;
        return $this;
    }

    /**
     * Get round of fixture.
     *
     * @return \Rugaard\StatsFC\DTO\Round|null
     */
    public function getRound() :? Round
    {
        return $this->round;
    }

    /**
     * Set home or away team of fixture.
     *
     * @param  string                    $side Options: "home" or "away".
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\Fixture
     */
    public function setTeams(string $side, Team $team) : Fixture
    {
        if (in_array($side, ['home', 'away'])) {
            $this->teams->put($side, $team);
        }
        return $this;
    }

    /**
     * Get home or away team of fixture.
     *
     * @param  string $side Options: "home" or "away".
     * @return \Rugaard\StatsFC\DTO\Team|null
     */
    public function getTeam(string $side) :? Team
    {
        if (!in_array($side, ['home', 'away'])) {
            return null;
        }
        return $this->teams->get($side);
    }

    /**
     * Get teams of fixture.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTeams() : Collection
    {
        return $this->teams;
    }

    /**
     * Set current state of fixture.
     *
     * @param  \Rugaard\StatsFC\DTO\State $state
     * @return \Rugaard\StatsFC\DTO\Fixture
     */
    public function setCurrentState(State $state) : Fixture
    {
        $this->currentState = $state;
        return $this;
    }

    /**
     * Get current state of fixture.
     *
     * @return \Rugaard\StatsFC\DTO\State|null
     */
    public function getCurrentState() :? State
    {
        return $this->currentState;
    }

    /**
     * Set venue of fixture.
     *
     * @param  \Rugaard\StatsFC\DTO\Venue $venue
     * @return \Rugaard\StatsFC\DTO\Fixture
     */
    public function setVenue(Venue $venue) : Fixture
    {
        $this->venue = $venue;
        return $this;
    }

    /**
     * Get venue of fixture.
     *
     * @return \Rugaard\StatsFC\DTO\Venue|null
     */
    public function getVenue() :? Venue
    {
        return $this->venue;
    }
}