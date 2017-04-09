<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

use DateTime;

/**
 * Class Round.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Round
{
    /**
     * Round ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Name of round.
     *
     * @var string
     */
    protected $name;

    /**
     * Start date of round.
     *
     * @var \DateTime
     */
    protected $start;

    /**
     * End date of round.
     *
     * @var \DateTime
     */
    protected $end;

    /**
     * Set round ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Round
     */
    public function setId(int $id) : Round
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get round ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set name of round.
     *
     * @param  string $name
     * @return \Rugaard\StatsFC\DTO\Round
     */
    public function setName(string $name) : Round
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of round.
     *
     * @return string|null
     */
    public function getName() :? string
    {
        return $this->name;
    }

    /**
     * Set start date of round.
     *
     * @param  string $date
     * @return \Rugaard\StatsFC\DTO\Round
     */
    public function setStart(string $date) : Round
    {
        $this->start = new DateTime($date);
        return $this;
    }

    /**
     * Get start date of round.
     *
     * @return DateTime|null
     */
    public function getStart() :? DateTime
    {
        return $this->start;
    }

    /**
     * Set end date of round.
     *
     * @param  string $date
     * @return \Rugaard\StatsFC\DTO\Round
     */
    public function setEnd(string $date) : Round
    {
        $this->end = new DateTime($date);
        return $this;
    }

    /**
     * Get end date of round.
     *
     * @return DateTime|null
     */
    public function getEnd() :? DateTime
    {
        return $this->end;
    }
}