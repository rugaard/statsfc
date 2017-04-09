<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO\Events;

use Rugaard\StatsFC\DTO\Player;
use Rugaard\StatsFC\DTO\Team;

/**
 * Class Goal.
 *
 * @package Rugaard\StatsFC\DTO\Events
 */
class Goal extends AbstractEvent
{
    /**
     * Team of goal event.
     *
     * @var \Rugaard\StatsFC\DTO\Team
     */
    protected $team;

    /**
     * Player who scored the goal.
     *
     * @var \Rugaard\StatsFC\DTO\Player
     */
    protected $goalscorer;

    /**
     * Player who made the assist for the goal.
     *
     * @var \Rugaard\StatsFC\DTO\Player
     */
    protected $assist;

    /**
     * Set team of goal event.
     *
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\Events\Goal
     */
    public function setTeam(Team $team) : Goal
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get team of goal event.
     *
     * @return \Rugaard\StatsFC\DTO\Team|null
     */
    public function getTeam() :? Team
    {
        return $this->team;
    }

    /**
     * Set player who scored the goal.
     *
     * @param  \Rugaard\StatsFC\DTO\Player $player
     * @return \Rugaard\StatsFC\DTO\Events\Goal
     */
    public function setGoalscorer(Player $player) : Goal
    {
        $this->goalscorer = $player;
        return $this;
    }

    /**
     * Get player who scored the goal.
     *
     * @return \Rugaard\StatsFC\DTO\Player|null
     */
    public function getGoalscorer() :? Player
    {
        return $this->goalscorer;
    }

    /**
     * Set player who made the assist for the goal.
     *
     * @param  \Rugaard\StatsFC\DTO\Player $player
     * @return \Rugaard\StatsFC\DTO\Events\Goal
     */
    public function setAssist(Player $player) : Goal
    {
        $this->assist = $player;
        return $this;
    }

    /**
     * Get player who made the assist for the goal.
     *
     * @return \Rugaard\StatsFC\DTO\Player|null
     */
    public function getAssist() :? Player
    {
        return $this->assist;
    }
}