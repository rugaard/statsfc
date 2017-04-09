<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

use Illuminate\Support\Collection;

/**
 * Class Standing.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Standing
{
    /**
     * Competition of standing.
     *
     * @var \Rugaard\StatsFC\DTO\Competition
     */
    protected $competition;

    /**
     * Round of standing.
     *
     * @var \Rugaard\StatsFC\DTO\Round
     */
    protected $round;

    /**
     * Team of standing.
     *
     * @var \Rugaard\StatsFC\DTO\Team
     */
    protected $team;

    /**
     * Position number.
     *
     * @var int
     */
    protected $position;

    /**
     * Amount of played fixtures.
     *
     * @var int
     */
    protected $played = 0;

    /**
     * Amount of won fixtures.
     *
     * @var int
     */
    protected $wins = 0;

    /**
     * Amount of draw fixtures.
     *
     * @var int
     */
    protected $draws = 0;

    /**
     * Amount of lost fixtures.
     *
     * @var int
     */
    protected $losses = 0;

    /**
     * Amount of goals scored and let in.
     *
     * @var array
     */
    protected $goals = [
        'for' => 0,
        'against' => 0,
        'difference' => 0,
    ];

    /**
     * Total points.
     *
     * @var int
     */
    protected $points = 0;

    /**
     * Info of standing.
     *
     * @var string
     */
    protected $info;

    /**
     * Notes of standing.
     *
     * @var string
     */
    protected $notes;

    /**
     * Set competition of standing.
     *
     * @param  \Rugaard\StatsFC\DTO\Competition $competition
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setCompetition(Competition $competition) : Standing
    {
        $this->competition = $competition;
        return $this;
    }

    /**
     * Get competition of standing.
     *
     * @return \Rugaard\StatsFC\DTO\Competition|null
     */
    public function getCompetition() :? Competition
    {
        return $this->competition;
    }

    /**
     * Set round of standing.
     *
     * @param  \Rugaard\StatsFC\DTO\Round $round
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setRound(Round $round) : Standing
    {
        $this->round = $round;
        return $this;
    }

    /**
     * Get round of standing.
     *
     * @return \Rugaard\StatsFC\DTO\Round|null
     */
    public function getRound() :? Round
    {
        return $this->round;
    }

    /**
     * Set team of standing.
     *
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setTeam(Team $team) : Standing
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get team of standing.
     *
     * @return \Rugaard\StatsFC\DTO\Team|null
     */
    public function getTeam() :? Team
    {
        return $this->team;
    }

    /**
     * Set position number.
     *
     * @param  int $position
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setPosition(int $position) : Standing
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position number.
     *
     * @return int|null
     */
    public function getPosition() :? int
    {
        return $this->position;
    }

    /**
     * Set amount of played fixtures.
     *
     * @param  int $played
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setPlayed(int $played) : Standing
    {
        $this->played = $played;
        return $this;
    }

    /**
     * Get amount of played fixtures.
     *
     * @return int
     */
    public function getPlayed() : int
    {
        return $this->played;
    }

    /**
     * Set amount of won fixtures.
     *
     * @param  int $wins
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setWins(int $wins) : Standing
    {
        $this->wins = $wins;
        return $this;
    }

    /**
     * Get amount of won fixtures.
     *
     * @return int
     */
    public function getWins() : int
    {
        return $this->wins;
    }

    /**
     * Set amount of draw fixtures.
     *
     * @param  int $draws
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setDraws(int $draws) : Standing
    {
        $this->draws = $draws;
        return $this;
    }

    /**
     * Get amount of draw fixtures.
     *
     * @return int
     */
    public function getDraws() : int
    {
        return $this->draws;
    }

    /**
     * Set amount of lost fixtures.
     *
     * @param  int $losses
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setLosses(int $losses) : Standing
    {
        $this->losses = $losses;
        return $this;
    }

    /**
     * Get amount of lost fixtures.
     *
     * @return int
     */
    public function getLosses() : int
    {
        return $this->losses;
    }

    /**
     * Set amount of goals scored or let in.
     *
     * @param  string $type   Options: "for", "against" or "difference"
     * @param  int    $goals
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setGoals(string $type, int $goals) : Standing
    {
        if (in_array($type, ['for', 'against', 'difference'])) {
            $this->goals[$type] = $goals;
        }
        return $this;
    }

    /**
     * Get amount of goals scored or let in.
     *
     * @param  string $type Options: "for", "against" or "difference"
     * @return int
     */
    public function getGoals(string $type) :? int
    {
        if (!in_array($type, ['for', 'against', 'difference'])) {
            return null;
        }
        return $this->goals[$type];
    }

    /**
     * Get all goals.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllGoals() : Collection
    {
        return collect($this->goals);
    }

    /**
     * Set points.
     *
     * @param  int $points
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setPoints(int $points) : Standing
    {
        $this->points = $points;
        return $this;
    }

    /**
     * Get points.
     *
     * @return int|null
     */
    public function getPoints() :? int
    {
        return $this->points;
    }

    /**
     * Set info of standing.
     *
     * @param  string $info
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setInfo(string $info) : Standing
    {
        $this->info = $info;
        return $this;
    }

    /**
     * Get info of standing.
     *
     * @return string|null
     */
    public function getInfo() :? string
    {
        return $this->info = $info;
    }

    /**
     * Set notes of standing.
     *
     * @param  string $notes
     * @return \Rugaard\StatsFC\DTO\Standing
     */
    public function setNotes(string $notes) : Standing
    {
        $this->notes = $notes;
        return $this;
    }

    /**
     * Get notes of standing.
     *
     * @return string|null
     */
    public function getNotes() :? string
    {
        return $this->notes;
    }
}