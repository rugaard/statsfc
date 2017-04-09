<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO\Events;

use Rugaard\StatsFC\DTO\Player;
use Rugaard\StatsFC\DTO\Team;

/**
 * Class Card.
 *
 * @package Rugaard\StatsFC\DTO\Events
 */
class Card extends AbstractEvent
{
    /**
     * Team of card event.
     *
     * @var \Rugaard\StatsFC\DTO\Team
     */
    protected $team;

    /**
     * Player of card event.
     *
     * @var \Rugaard\StatsFC\DTO\Player
     */
    protected $player;

    /**
     * Set team of card event.
     *
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\Events\Card
     */
    public function setTeam(Team $team) : Card
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get team of card event.
     *
     * @return \Rugaard\StatsFC\DTO\Team|null
     */
    public function getTeam() :? Team
    {
        return $this->team;
    }

    /**
     * Set player of card event.
     *
     * @param  \Rugaard\StatsFC\DTO\Player $player
     * @return \Rugaard\StatsFC\DTO\Events\Card
     */
    public function setPlayer(Player $player) : Card
    {
        $this->player = $player;
        return $this;
    }

    /**
     * Get player of card event.
     *
     * @return \Rugaard\StatsFC\DTO\Player|null
     */
    public function getPlayer() :? Player
    {
        return $this->player;
    }
}