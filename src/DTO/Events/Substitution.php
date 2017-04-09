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
class Substitution extends AbstractEvent
{
    /**
     * Team of goal event.
     *
     * @var \Rugaard\StatsFC\DTO\Team
     */
    protected $team;

    /**
     * Player who got substituted on.
     *
     * @var \Rugaard\StatsFC\DTO\Player
     */
    protected $playerOn;

    /**
     * Player who got substituted off.
     *
     * @var \Rugaard\StatsFC\DTO\Player
     */
    protected $playerOff;

    /**
     * Set team of substitution event.
     *
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\Events\Substitution
     */
    public function setTeam(Team $team) : Substitution
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
     * Set player who got substituted on.
     *
     * @param  \Rugaard\StatsFC\DTO\Player $player
     * @return \Rugaard\StatsFC\DTO\Events\Substitution
     */
    public function setPlayerOn(Player $player) : Substitution
    {
        $this->playerOn = $player;
        return $this;
    }

    /**
     * Get player who got substituted on.
     *
     * @return \Rugaard\StatsFC\DTO\Player|null
     */
    public function getPlayerOn() :? Player
    {
        return $this->playerOn;
    }

    /**
     * Set player who got substituted off.
     *
     * @param  \Rugaard\StatsFC\DTO\Player $player
     * @return \Rugaard\StatsFC\DTO\Events\Substitution
     */
    public function setPlayerOff(Player $player) : Substitution
    {
        $this->playerOff = $player;
        return $this;
    }

    /**
     * Get player who got substituted off.
     *
     * @return \Rugaard\StatsFC\DTO\Player|null
     */
    public function getPlayerOff() :? Player
    {
        return $this->playerOff;
    }
}