<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

/**
 * Class TopScorer.
 *
 * @package Rugaard\StatsFC\DTO
 */
class TopScorer
{
    /**
     * Top scorer ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Player of top scorer.
     *
     * @var \Rugaard\StatsFC\DTO\Player
     */
    protected $player;

    /**
     * Team of top scorer.
     *
     * @var \Rugaard\StatsFC\DTO\Team
     */
    protected $team;

    /**
     * Amount of goals scored.
     *
     * @var int
     */
    protected $goals = 0;

    /**
     * Set top scorer ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\TopScorer
     */
    public function setId(int $id) : TopScorer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get top scorer ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set player of top scorer.
     *
     * @param  \Rugaard\StatsFC\DTO\Player $player
     * @return \Rugaard\StatsFC\DTO\TopScorer
     */
    public function setPlayer(Player $player) : TopScorer
    {
        $this->player = $player;
        return $this;
    }

    /**
     * Get player of top scorer.
     *
     * @return \Rugaard\StatsFC\DTO\Player|null
     */
    public function getPlayer() :? Player
    {
        return $this->player;
    }

    /**
     * Set team of top scorer.
     *
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\TopScorer
     */
    public function setTeam(Team $team) : TopScorer
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get team of top scorer.
     *
     * @return \Rugaard\StatsFC\DTO\Team|null
     */
    public function getTeam() :? Team
    {
        return $this->team;
    }

    /**
     * Set amount of goals scored.
     *
     * @param  int $goals
     * @return \Rugaard\StatsFC\DTO\TopScorer
     */
    public function setGoals(int $goals) : TopScorer
    {
        $this->goals = $goals;
        return $this;
    }

    /**
     * Get amount of goals scored.
     *
     * @return int
     */
    public function getGoals() :? int
    {
        return $this->goals;
    }
}