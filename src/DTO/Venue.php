<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

/**
 * Class Venue.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Venue
{
    /**
     * Venue ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Name of venue.
     *
     * @var string
     */
    protected $name;

    /**
     * Capacity of venue.
     *
     * @var int
     */
    protected $capacity;

    /**
     * Set venue ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Venue
     */
    public function setId(int $id) : Venue
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get venue ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set name of venue.
     *
     * @param  string $name
     * @return \Rugaard\StatsFC\DTO\Venue
     */
    public function setName(string $name) : Venue
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of venue.
     *
     * @return string|null
     */
    public function getName() :? string
    {
        return $this->name;
    }

    /**
     * Set capacity of venue.
     *
     * @param  int $capacity
     * @return \Rugaard\StatsFC\DTO\Venue
     */
    public function setCapacity(int $capacity) : Venue
    {
        $this->capacity = $capacity;
        return $this;
    }

    /**
     * Get capacity of venue.
     *
     * @return int|null
     */
    public function getCapacity() :? int
    {
        return $this->capacity;
    }
}