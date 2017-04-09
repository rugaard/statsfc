<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

use Illuminate\Support\Collection;

/**
 * Class Competition.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Competition
{
    /**
     * Competition ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Name of competition.
     *
     * @var string
     */
    protected $name;

    /**
     * Unique competition key.
     *
     * @var string
     */
    protected $key;

    /**
     * Region/Country of competition.
     *
     * @var string
     */
    protected $region;

    /**
     * Rounds of competition.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $rounds;

    /**
     * Set competition ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Competition
     */
    public function setId(int $id) : Competition
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get competition ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set name of competition.
     *
     * @param  string $name
     * @return \Rugaard\StatsFC\DTO\Competition
     */
    public function setName(string $name) : Competition
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of competition.
     *
     * @return string|null
     */
    public function getName() :? string
    {
        return $this->name;
    }

    /**
     * Set unique competition key.
     *
     * @param  string $key
     * @return \Rugaard\StatsFC\DTO\Competition
     */
    public function setKey(string $key) : Competition
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Get unique competition key.
     *
     * @return string|null
     */
    public function getKey() :? string
    {
        return $this->key;
    }

    /**
     * Set region/country of competition.
     *
     * @param  string $region
     * @return \Rugaard\StatsFC\DTO\Competition
     */
    public function setRegion(string $region) : Competition
    {
        $this->region = $region;
        return $this;
    }

    /**
     * Get region/country of competition.
     *
     * @return string|null
     */
    public function getRegion() :? string
    {
        return $this->region;
    }

    /**
     * Set rounds of competition.
     *
     * @param  \Illuminate\Support\Collection $rounds
     * @return \Rugaard\StatsFC\DTO\Competition
     */
    public function setRounds(Collection $rounds) : Competition
    {
        $this->rounds = $rounds;
        return $this;
    }

    /**
     * Get rounds of competition.
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function getRounds() :? Collection
    {
        return $this->rounds;
    }
}