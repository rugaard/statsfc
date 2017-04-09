<?php
declare(strict_types=1);

namespace Rugaard\StatsFC\DTO;

/**
 * Class Team.
 *
 * @package Rugaard\StatsFC\DTO
 */
class Team
{
    /**
     * Team ID.
     *
     * @var int
     */
    protected $id;

    /**
     * Name of team.
     *
     * @var string
     */
    protected $name;

    /**
     * Short name of team.
     *
     * @var string
     */
    protected $shortName;

    /**
     * Set team ID.
     *
     * @param  int $id
     * @return \Rugaard\StatsFC\DTO\Team
     */
    public function setId(int $id) : Team
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get team ID.
     *
     * @return int|null
     */
    public function getId() :? int
    {
        return $this->id;
    }

    /**
     * Set name of team.
     *
     * @param  string $name
     * @return \Rugaard\StatsFC\DTO\Team
     */
    public function setName(string $name) : Team
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name of team.
     *
     * @return string|null
     */
    public function getName() :? string
    {
        return $this->name;
    }

    /**
     * Set short name of team.
     *
     * @param  string $shortName
     * @return \Rugaard\StatsFC\DTO\Team
     */
    public function setShortName(string $shortName) : Team
    {
        $this->shortName = $shortName;
        return $this;
    }

    /**
     * Get short name of team.
     *
     * @return string|null
     */
    public function getShortName() :? string
    {
        return $this->shortName;
    }
}