<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO\Events;

use DateTime;

/**
 * Class Event.
 *
 * @package Rugaard\StatsFC\DTO\Events
 */
abstract class AbstractEvent
{
    /**
     * Event ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Type of event.
     *
     * @var string
     */
    protected $type;

    /**
     * Sub-type of event.
     *
     * @var string|null
     */
    protected $subType;

    /**
     * Time of match event happened.
     *
     * @var string
     */
    protected $matchTime;

    /**
     * Timestamp of event.
     *
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * Set event ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Events\AbstractEvent
     */
    public function setId(int $id) : AbstractEvent
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get event ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set type of event.
     *
     * @param  string $type
     * @return \Rugaard\StatsFC\DTO\Events\AbstractEvent
     */
    public function setType(string $type) : AbstractEvent
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type of event.
     *
     * @return string|null
     */
    public function getType() :? string
    {
        return $this->type;
    }

    /**
     * Set sub-type of event.
     *
     * @param  string $subType
     * @return \Rugaard\StatsFC\DTO\Events\AbstractEvent
     */
    public function setSubType(string $subType = null) : AbstractEvent
    {
        $this->subType = $subType;
        return $this;
    }

    /**
     * Get sub-type of event.
     *
     * @return string|null
     */
    public function getSubType() :? string
    {
        return $this->subType;
    }

    /**
     * Set time of match event happened.
     *
     * @param  string $matchTime
     * @return \Rugaard\StatsFC\DTO\Events\AbstractEvent
     */
    public function setMatchTime(string $matchTime) : AbstractEvent
    {
        $this->matchTime = $matchTime;
        return $this;
    }

    /**
     * Get time of match event happened.
     *
     * @return string|null
     */
    public function getMatchTime() :? string
    {
        return $this->matchTime;
    }

    /**
     * Set timestamp of event.
     *
     * @param  string $timestamp
     * @return \Rugaard\StatsFC\DTO\Events\AbstractEvent
     */
    public function setTimestamp(string $timestamp) : AbstractEvent
    {
        $this->timestamp = new DateTime($timestamp);
        return $this;
    }

    /**
     * Get timestamp of event.
     *
     * @return \DateTime
     */
    public function getTimestamp() :? DateTime
    {
        return $this->timestamp;
    }
}