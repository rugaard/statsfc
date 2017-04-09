<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

/**
 * Class Player.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Player
{
    /**
     * Player ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Player's shirt number.
     *
     * @var int|null
     */
    protected $number;

    /**
     * Position of player.
     *
     * @var string
     */
    protected $position;

    /**
     * Name of player.
     *
     * @var string
     */
    protected $name;

    /**
     * Short name of player.
     *
     * @var string
     */
    protected $shortName;

    /**
     * Role of player.
     *
     * @var string
     */
    protected $role;

    /**
     * Set player ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Player
     */
    public function setId(int $id) : Player
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get player ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set player's shirt number.
     *
     * @param  int|null $number
     * @return \Rugaard\StatsFC\DTO\Player
     */
    public function setNumber(int $number = null) : Player
    {
        $this->number = $number;
        return $this;
    }

    /**
     * Get player's shirt number.
     *
     * @return int|null
     */
    public function getNumber() :? int
    {
        return $this->number;
    }

    /**
     * Set position of player.
     *
     * @param  string $position
     * @return \Rugaard\StatsFC\DTO\Player
     */
    public function setPosition(string $position) : Player
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position of player.
     *
     * @return string|null
     */
    public function getPosition() :? string
    {
        return $this->position;
    }

    /**
     * Set name of player.
     *
     * @param  string $name
     * @return \Rugaard\StatsFC\DTO\Player
     */
    public function setName(string $name) : Player
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of player.
     *
     * @return string|null
     */
    public function getName() :? string
    {
        return $this->name;
    }

    /**
     * Set short name of player.
     *
     * @param  string $shortName
     * @return \Rugaard\StatsFC\DTO\Player
     */
    public function setShortName(string $shortName) : Player
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * Get short name of player.
     *
     * @return string|null
     */
    public function getShortName() :? string
    {
        return $this->shortName;
    }

    /**
     * Set role of player.
     *
     * @param  string $role
     * @return \Rugaard\StatsFC\DTO\Player
     */
    public function setRole(string $role) : Player
    {
        $this->role = $role;
        return $this;
    }

    /**
     * Get role of player.
     *
     * @return string|null
     */
    public function getRole() :? string
    {
        return $this->role;
    }
}