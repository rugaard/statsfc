<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO\Events;

use Rugaard\StatsFC\DTO\State as TheState;

/**
 * Class Goal.
 *
 * @package Rugaard\StatsFC\DTO\Events
 */
class State extends AbstractEvent
{
    /**
     * State of state event.
     *
     * @var \Rugaard\StatsFC\DTO\State
     */
    protected $state;

    /**
     * Set state of state event.
     *
     * @param  \Rugaard\StatsFC\DTO\State $state
     * @return \Rugaard\StatsFC\DTO\Events\State
     */
    public function setState(TheState $state) : State
    {
        $this->state = $state;
        return $this;
    }

    /**
     * Get state of state event.
     *
     * @return \Rugaard\StatsFC\DTO\State|null
     */
    public function getState() :? TheState
    {
        return $this->state;
    }
}