<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

use Illuminate\Support\Collection;

/**
 * Class Squad.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Squad
{
    /**
     * Team of squad.
     *
     * @var \Rugaard\StatsFC\DTO\Team
     */
    protected $team;

    /**
     * Players of squad.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $players;

    /**
     * Set team of squad.
     *
     * @param  \Rugaard\StatsFC\DTO\Team $team
     * @return \Rugaard\StatsFC\DTO\Squad
     */
    public function setTeam(Team $team) : Squad
    {
        $this->team = $team;
        return $this;
    }

    /**
     * Get team of squad.
     *
     * @return \Rugaard\StatsFC\DTO\Team|null
     */
    public function getTeam() :? Team
    {
        return $this->team;
    }

    /**
     * Set player of squad.
     *
     * @param  \Illuminate\Support\Collection $players
     * @return \Rugaard\StatsFC\DTO\Squad
     */
    public function setPlayers(Collection $players) : Squad
    {
        $this->players = $players;
        return $this;
    }

    /**
     * Get players of squad.
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function getPlayers() :? Collection
    {
        return $this->players;
    }
}