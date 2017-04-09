<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

/**
 * Class State.
 *
 * @package Rugaard\StatsFC\DTO
 */
class State
{
    /**
     * State ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Name of state.
     *
     * @var string
     */
    protected $name;

    /**
     * Unique key of state.
     *
     * @var string
     */
    protected $key;

    /**
     * Set state ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\State
     */
    public function setId(int $id) : State
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get state ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set name of state.
     *
     * @param  string $name
     * @return \Rugaard\StatsFC\DTO\State
     */
    public function setName(string $name) : State
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of state.
     *
     * @return string|null
     */
    public function getName() :? string
    {
        return $this->name;
    }

    /**
     * Set unique key of state.
     *
     * @param  string $key
     * @return \Rugaard\StatsFC\DTO\State
     */
    public function setKey(string $key) : State
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Get unique key of state.
     *
     * @return string|null
     */
    public function getKey() :? string
    {
        return $this->key;
    }
}