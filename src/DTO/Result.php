<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

use DateTime;
use Illuminate\Support\Collection;

/**
 * Class Result.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Result
{
    /**
     * Result ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Timestamp of result.
     *
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * Competition of result.
     *
     * @var \Rugaard\StatsFC\DTO\Competition
     */
    protected $competition;

    /**
     * Round of result.
     *
     * @var \Rugaard\StatsFC\DTO\Round
     */
    protected $round;

    /**
     * Teams of result.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $teams;

    /**
     * Players of result.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $players;

    /**
     * Score of result.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $score;

    /**
     * Current state of result.
     *
     * @var \Rugaard\StatsFC\DTO\State
     */
    protected $currentState;

    /**
     * Venue of result.
     *
     * @var \Rugaard\StatsFC\DTO\Venue
     */
    protected $venue;

    /**
     * Events of result.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $events;

    /**
     * Team sides.
     *
     * @var array
     */
    private $teamSides = [
        'home',
        'away',
    ];

    /**
     * Supported event types.
     *
     * @var array
     */
    private $eventTypes = [
        'cards',
        'goals',
        'penalties',
        'penalty',
        'states',
        'substitutions',
    ];

    /**
     * Result constructor.
     */
    public function __construct()
    {
        // Set default $teams collection.
        $this->teams = collect([
            'home' => null,
            'away' => null,
        ]);

        // Set default $players collection.
        $this->players = collect([
            'home' => null,
            'away' => null,
        ]);

        // Set default $score collection
        $this->score = collect([
            'home' => 0,
            'away' => 0,
        ]);

        // Make sure events is an empty collection.
        $this->events = collect();
    }

    /**
     * Set result ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setId(int $id) : Result
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get result ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set timestamp of result.
     *
     * @param  string $timestamp
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setTimestamp(string $timestamp) : Result
    {
        $this->timestamp = new DateTime($timestamp);
        return $this;
    }

    /**
     * Get timestamp of result.
     *
     * @return \DateTime
     */
    public function getTimestamp() :? DateTime
    {
        return $this->timestamp;
    }

    /**
     * Set competition of result.
     *
     * @param  \Rugaard\StatsFC\DTO\Competition $competition
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setCompetition(Competition $competition) : Result
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * Get competition of result.
     *
     * @return \Rugaard\StatsFC\DTO\Competition|null
     */
    public function getCompetition() :? Competition
    {
        return $this->competition;
    }

    /**
     * Set round of result.
     *
     * @param  \Rugaard\StatsFC\DTO\Round $round
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setRound(Round $round) : Result
    {
        $this->round = $round;
        return $this;
    }

    /**
     * Get round of result.
     *
     * @return \Rugaard\StatsFC\DTO\Round|null
     */
    public function getRound() :? Round
    {
        return $this->round;
    }

    /**
     * Set home or away team of result.
     *
     * @param  string                    $side Options: "home" or "away".
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setTeams(string $side, Team $team) : Result
    {
        if (in_array($side, $this->teamSides)) {
            $this->teams->put($side, $team);
        }
        return $this;
    }

    /**
     * Get home or away team of result.
     *
     * @param  string $side Options: "home" or "away".
     * @return \Rugaard\StatsFC\DTO\Team|null
     */
    public function getTeam(string $side) :? Team
    {
        if (!in_array($side, $this->teamSides)) {
            return null;
        }
        return $this->teams->get($side);
    }

    /**
     * Get teams of result.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTeams() : Collection
    {
        return $this->teams;
    }

    /**
     * Set home or away players of result.
     *
     * @param  string                         $side    Options: "home" or "away".
     * @param  \Illuminate\Support\Collection $players
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setPlayers(string $side, Collection $players) : Result
    {
        if (in_array($side, $this->teamSides)) {
            $this->players->put($side, $players);
        }
        return $this;
    }

    /**
     * Get home or away players of result.
     *
     * @param  string $side Options: "home" or "away".
     * @return \Illuminate\Support\Collection|null
     */
    public function getPlayers(string $side) :? Collection
    {
        if (!in_array($side, $this->teamSides)) {
            return null;
        }
        return $this->players->get($side);
    }

    /**
     * Get all players of result.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllPlayers() : Collection
    {
        return $this->players;
    }

    /**
     * Set home or away score of result.
     *
     * @param  string $side  Options: "home" or "away".
     * @param  int    $score
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setScore(string $side, int $score) : Result
    {
        if (in_array($side, $this->teamSides)) {
            $this->score->put($side, $score);
        }
        return $this;
    }

    /**
     * Get home or away score of result.
     *
     * @param  string $side Options: "home" or "away".
     * @return int|null
     */
    public function getScore(string $side) :? int
    {
        if (!in_array($side, $this->teamSides)) {
            return null;
        }
        return $this->score->get($side);
    }

    /**
     * Get full score of result..
     *
     * @return string
     */
    public function getFullScore() : string
    {
        return sprintf('%d - %d', $this->score->get('home'), $this->score->get('away'));
    }

    /**
     * Set current state of result.
     *
     * @param  \Rugaard\StatsFC\DTO\State $state
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setCurrentState(State $state) : Result
    {
        $this->currentState = $state;
        return $this;
    }

    /**
     * Get current state of result.
     *
     * @return \Rugaard\StatsFC\DTO\State|null
     */
    public function getCurrentState() :? State
    {
        return $this->currentState;
    }

    /**
     * Set venue of result.
     *
     * @param  \Rugaard\StatsFC\DTO\Venue $venue
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setVenue(Venue $venue) : Result
    {
        $this->venue = $venue;
        return $this;
    }

    /**
     * Get venue of result.
     *
     * @return \Rugaard\StatsFC\DTO\Venue|null
     */
    public function getVenue() :? Venue
    {
        return $this->venue;
    }

    /**
     * Set events of result.
     *
     * @param  string                         $type   Options: "cards", "goals", "penalties", "penalty", "states" or "substitutions"
     * @param  \Illuminate\Support\Collection $events
     * @return \Rugaard\StatsFC\DTO\Result
     */
    public function setEvents(string $type, Collection $events) : Result
    {
        if (in_array($type, $this->eventTypes)) {
            $this->events->put($type, $events);
        }
        return $this;
    }

    /**
     * Get a type of events of results.
     *
     * @param  string $type Options: "cards", "goals", "penalties", "penalty", "states" or "substitutions"
     * @return \Illuminate\Support\Collection|null
     */
    public function getEvents(string $type) :? Collection
    {
        if (!in_array($type, $this->eventTypes)) {
            return null;
        }
        return $this->events->get($type);
    }

    /**
     * Get all events of result.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllEvents() : Collection
    {
        return collect($this->events);
    }
}