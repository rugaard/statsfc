<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

use DateTime;

/**
 * Class Season.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Season
{
    /**
     * Season ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Name of season.
     *
     * @var string
     */
    protected $name;

    /**
     * Start date of season.
     *
     * @var \DateTime
     */
    protected $start;

    /**
     * End date of season.
     *
     * @var \DateTime
     */
    protected $end;

    /**
     * Set season ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Season
     */
    public function setId(int $id) : Season
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get season ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set name of season.
     *
     * @param  string $name
     * @return \Rugaard\StatsFC\DTO\Season
     */
    public function setName(string $name) : Season
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of season.
     *
     * @return string|null
     */
    public function getName() :? string
    {
        return $this->name;
    }

    /**
     * Set start date of season.
     *
     * @param  string $date
     * @return \Rugaard\StatsFC\DTO\Season
     */
    public function setStart(string $date) : Season
    {
        $this->start = new DateTime($date);
        return $this;
    }

    /**
     * Get start date of season.
     *
     * @return DateTime|null
     */
    public function getStart() :? DateTime
    {
        return $this->start;
    }

    /**
     * Set end date of season.
     *
     * @param  string $date
     * @return \Rugaard\StatsFC\DTO\Season
     */
    public function setEnd(string $date) : Season
    {
        $this->end = new DateTime($date);
        return $this;
    }

    /**
     * Get end date of season.
     *
     * @return DateTime|null
     */
    public function getEnd() :? DateTime
    {
        return $this->end;
    }
}