<?php
declare(strict_types=1);

namespace Rugaard\StatsFC;

use Illuminate\Support\Collection;
use Rugaard\StatsFC\DTO\ {
    Competition,
    Fixture,
    Player,
    Result,
    Round,
    Season,
    Squad,
    Standing,
    State,
    Team,
    TopScorer,
    Venue
};
use Rugaard\StatsFC\DTO\Events\ {
    Card as EventCard,
    Goal as EventGoal,
    State as EventState,
    Substitution as EventSubstitution
};

/**
 * Class StatsFC.
 *
 * @package Rugaard\StatsFC
 */
class StatsFC extends Client
{
    /**
     * Get all competitions.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function competitions(array $params = []) : Collection
    {
        // Filter array to only contain supported parameters.
        $params = array_filter($params, function($key) {
            return in_array($key, ['region']);
        }, ARRAY_FILTER_USE_KEY);

        // Request endpoint.
        $result = $this->request('competitions', $params);

        // Container.
        $competitions = collect();

        foreach ($result->data as $item) {
            // Generate competition object.
            $competition = (new Competition)
                ->setId($item->id)
                ->setName($item->name)
                ->setKey($item->key)
                ->setRegion($item->region);

            // Handle competition rounds.
            $rounds = collect();
            foreach ($item->rounds as $subItem) {
                // Generate round object.
                $round = (new Round)
                    ->setId($subItem->id)
                    ->setName($subItem->name);

                // Add start date to round.
                if (!empty($subItem->start)) {
                    $round->setStart($subItem->start);
                }

                // Add end date to round.
                if (!empty($subItem->end)) {
                    $round->setEnd($subItem->end);
                }

                // Add round to container.
                $rounds->push($round);
            }

            // Add collection of rounds to competition.
            $competition->setRounds($rounds);

            // Add competition to container.
            $competitions->push($competition);
        }

        return $competitions;
    }

    /**
     * Get all fixtures.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function fixtures(array $params = []) : Collection
    {
        // Filter array to only contain supported parameters.
        $params = array_filter($params, function($key) {
            return in_array($key, [
                'season',
                'competition',
                'competition_id',
                'competition_key',
                'team',
                'team_id',
                'from',
                'to',
            ]);
        }, ARRAY_FILTER_USE_KEY);

        // Request endpoint.
        $result = $this->request('fixtures', $params);

        // Container.
        $fixtures = collect();

        foreach ($result->data as $item) {
            // Generate competition object.
            $competition = (new Competition)
                ->setId($item->competition->id)
                ->setKey($item->competition->key)
                ->setName($item->competition->name)
                ->setRegion($item->competition->region);

            // Generate round object.
            $round = (new Round)
                ->setId($item->round->id)
                ->setName($item->round->name);

            // Add start date to round object.
            if (!empty($item->round->start)) {
                $round->setStart($item->round->start);
            }

            // Add end date to round object.
            if (!empty($item->round->end)) {
                $round->setEnd($item->round->end);
            }

            // Generate home team object.
            $homeTeam = (new Team)
                ->setId($item->teams->home->id)
                ->setName($item->teams->home->name)
                ->setShortName($item->teams->home->shortName);

            // Generate away team object.
            $awayTeam = (new Team)
                ->setId($item->teams->away->id)
                ->setName($item->teams->away->name)
                ->setShortName($item->teams->away->shortName);

            // Generate state object.
            $state = (new State)
                ->setId($item->currentState->id)
                ->setKey($item->currentState->key)
                ->setName($item->currentState->name);

            // Generate venue object
            $venue = (new Venue)
                ->setId($item->venue->id)
                ->setName($item->venue->name)
                ->setCapacity($item->venue->capacity);

            // Generate fixture object.
            $fixture = (new Fixture)
                ->setId($item->id)
                ->setTimestamp($item->timestamp)
                ->setCompetition($competition)
                ->setRound($round)
                ->setTeams('home', $homeTeam)
                ->setTeams('away', $awayTeam)
                ->setCurrentState($state)
                ->setVenue($venue);

            // Add fixture object to container.
            $fixtures->push($fixture);
        }

        return $fixtures;
    }

    /**
     * Get all results.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function results(array $params = []) : Collection
    {
        // Filter array to only contain supported parameters.
        $params = array_filter($params, function ($key) {
            return in_array($key, [
                'season',
                'competition',
                'competition_id',
                'competition_key',
                'team',
                'team_id',
                'from',
                'to',
            ]);
        }, ARRAY_FILTER_USE_KEY);

        // Request endpoint.
        $result = $this->request('results', $params);

        // Container.
        $results = collect();

        foreach ($result->data as $item) {
            // Generate competition object.
            $competition = (new Competition)
                ->setId($item->competition->id)
                ->setKey($item->competition->key)
                ->setName($item->competition->name)
                ->setRegion($item->competition->region);

            // Generate round object.
            $round = (new Round)
                ->setId($item->round->id)
                ->setName($item->round->name);

            // Add start date to round object.
            if (!empty($item->round->start)) {
                $round->setStart($item->round->start);
            }

            // Add end date to round object.
            if (!empty($item->round->end)) {
                $round->setEnd($item->round->end);
            }

            // Generate home team object.
            $homeTeam = (new Team)
                ->setId($item->teams->home->id)
                ->setName($item->teams->home->name)
                ->setShortName($item->teams->home->shortName);

            // Generate away team object.
            $awayTeam = (new Team)
                ->setId($item->teams->away->id)
                ->setName($item->teams->away->name)
                ->setShortName($item->teams->away->shortName);

            // Generate state object.
            $state = (new State)
                ->setId($item->currentState->id)
                ->setKey($item->currentState->key)
                ->setName($item->currentState->name);

            // Generate venue object
            $venue = (new Venue)
                ->setId($item->venue->id)
                ->setName($item->venue->name)
                ->setCapacity($item->venue->capacity);

            // Generate result object.
            $result = (new Result)
                ->setId($item->id)
                ->setTimestamp($item->timestamp)
                ->setCompetition($competition)
                ->setRound($round)
                ->setTeams('home', $homeTeam)
                ->setTeams('away', $awayTeam)
                ->setScore('home', $item->score[0])
                ->setScore('away', $item->score[1])
                ->setCurrentState($state)
                ->setVenue($venue);

            // Generate player objects.
            foreach ($item->players as $teamSide => $subItems) {
                // Team side container.
                $players = [];

                foreach ($subItems as $subItem) {
                    // Generate player object.
                    $player = (new Player)
                        ->setId((int) $subItem->id)
                        ->setName($subItem->name)
                        ->setShortName($subItem->shortName)
                        ->setNumber($subItem->number)
                        ->setPosition($subItem->position)
                        ->setRole($subItem->role);

                    // If role doesn't exist, we'll add it to our container
                    // as an empty collection-
                    if (!array_key_exists($subItem->role, $players)) {
                        $players[$subItem->role] = collect();
                    }

                    // Add player to team side container.
                    $players[$subItem->role]->push($player);
                }

                // Add team side players to container.
                $result->setPlayers($teamSide, collect($players));
            }

            // Generate event objects
            foreach ($item->events as $eventType => $subItems) {
                // Event type container.
                $events = collect();

                foreach ($subItems as $subItem) {
                    switch ($eventType) {
                        case 'cards':
                            // Generate team object.
                            $team = (new Team)
                                ->setId($subItem->team->id)
                                ->setName($subItem->team->name)
                                ->setShortName($subItem->team->shortName);

                            // Generate player object.
                            $player = (new Player)
                                ->setId((int) $subItem->player->id)
                                ->setName($subItem->player->name)
                                ->setShortName($subItem->player->shortName)
                                ->setPosition($subItem->player->position);

                            // Generate event object.
                            $event = (new EventCard)
                                ->setTeam($team)
                                ->setPlayer($player)
                                ->setId($subItem->id)
                                ->setType($subItem->type)
                                ->setTimestamp($subItem->timestamp)
                                ->setMatchTime($subItem->matchTime)
                                ->setSubType($subItem->subType);
                            break;
                        case 'goals':
                            // Generate team object.
                            $team = (new Team)
                                ->setId($subItem->team->id)
                                ->setName($subItem->team->name)
                                ->setShortName($subItem->team->shortName);

                            // Generate player object.
                            $player = (new Player)
                                ->setId((int) $subItem->player->id)
                                ->setName($subItem->player->name)
                                ->setShortName($subItem->player->shortName)
                                ->setPosition($subItem->player->position);

                            // Generate event object.
                            $event = (new EventGoal)
                                ->setTeam($team)
                                ->setGoalscorer($player)
                                ->setId($subItem->id)
                                ->setType($subItem->type)
                                ->setTimestamp($subItem->timestamp)
                                ->setMatchTime($subItem->matchTime)
                                ->setSubType($subItem->subType ?? null);

                            // Generate assist object
                            // and add it to the event object.
                            if (!empty($subItem->assist)) {
                                $event->setAssist(
                                    (new Player)
                                    ->setId((int) $subItem->assist->id)
                                    ->setName($subItem->assist->name)
                                    ->setShortName($subItem->assist->shortName)
                                    ->setPosition($subItem->assist->position)
                                );
                            }
                            break;
                        case 'penalties':
                            // Not sure if this exists anymore?
                            break;
                        case 'penalty':
                            // Not sure if this exists anymore
                            // or if it has been merged with "goals" events?
                            break;
                        case 'states':
                            // Generate state object.
                            $state = (new State)
                                ->setId($subItem->state->id)
                                ->setKey($subItem->state->key)
                                ->setName($subItem->state->name);

                            // Generate event object.
                            $event = (new EventState)
                                ->setState($state)
                                ->setId($subItem->id)
                                ->setType($subItem->type)
                                ->setTimestamp($subItem->timestamp)
                                ->setMatchTime($subItem->matchTime);
                            break;
                        case 'substitutions':
                            // Generate team object.
                            $team = (new Team)
                                ->setId($subItem->team->id)
                                ->setName($subItem->team->name)
                                ->setShortName($subItem->team->shortName);

                            // Generate player off object.
                            $playerOff = (new Player)
                                ->setId((int) $subItem->playerOff->id)
                                ->setName($subItem->playerOff->name)
                                ->setShortName($subItem->playerOff->shortName)
                                ->setPosition($subItem->playerOff->position);

                            // Generate player on object.
                            $playerOn = (new Player)
                                ->setId((int) $subItem->playerOn->id)
                                ->setName($subItem->playerOn->name)
                                ->setShortName($subItem->playerOn->shortName)
                                ->setPosition($subItem->playerOn->position);

                            // Generate event object.
                            $event = (new EventSubstitution)
                                ->setTeam($team)
                                ->setPlayerOff($playerOff)
                                ->setPlayerOn($playerOn)
                                ->setId($subItem->id)
                                ->setType($subItem->type)
                                ->setTimestamp($subItem->timestamp)
                                ->setMatchTime($subItem->matchTime);
                            break;
                    }

                    if (empty($event)) {
                        print_r($eventType);
                        print_r($subItem);
                        die;
                    }

                    // Add event to events container.
                    $events->push($event);
                }

                // Add events to result object.
                $result->setEvents($eventType, $events);
            }

            // Add result object to container.
            $results->push($result);
        }

        return $results;
    }

    /**
     * Get all seasons.
     *
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function seasons() : Collection
    {
        // Request endpoint.
        $result = $this->request('seasons');

        // Container.
        $seasons = collect();

        foreach ($result->data as $item) {
            // Generate season object.
            $season = (new Season)
                ->setId($item->id)
                ->setName($item->name);

            // Add start date of season.
            if (!empty($item->start)) {
                $season->setStart($item->start);
            }

            // Add end date of season.
            if (!empty($item->end)) {
                $season->setEnd($item->end);
            }

            // Add season to container.
            $seasons->push($season);
        }

        return $seasons;
    }

    /**
     * Get all squads.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function squads(array $params = []) : Collection
    {
        // Filter array to only contain supported parameters.
        $params = array_filter($params, function($key) {
            return in_array($key, [
                'season',
                'competition',
                'competition_id',
                'competition_key',
                'team',
                'team_id',
            ]);
        }, ARRAY_FILTER_USE_KEY);

        // Request endpoint.
        $result = $this->request('squads', $params);

        // Container.
        $squads = collect();

        foreach ($result->data as $item) {
            // Generate team object.
            $team = (new Team)
                ->setId($item->team->id)
                ->setName($item->team->name)
                ->setShortName($item->team->shortName);

            // Collection of players.
            $players = collect();
            foreach ($item->players as $subItem) {
                // Generate player object.
                $player = (new Player)
                    ->setId((int) $subItem->id)
                    ->setName($subItem->name)
                    ->setShortName($subItem->shortName)
                    ->setPosition($subItem->position);

                // Add player to container.
                $players->push($player);
            }

            // Generate squad object.
            $squad = (new Squad)
                ->setTeam($team)
                ->setPlayers($players);

            // Add squad to container.
            $squads->push($squad);
        }

        return $squads;
    }

    /**
     * Get all standings.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function standings(array $params = []) : Collection
    {
        // Filter array to only contain supported parameters.
        $params = array_filter($params, function($key) {
            return in_array($key, [
                'season',
                'competition',
                'competition_id',
                'competition_key',
            ]);
        }, ARRAY_FILTER_USE_KEY);

        // Request endpoint.
        $result = $this->request('standings', $params);

        // Container.
        $standings = collect();

        foreach ($result->data as $item) {
            // Generate competition object.
            $competition = (new Competition)
                ->setId($item->competition->id)
                ->setKey($item->competition->key)
                ->setName($item->competition->name)
                ->setRegion($item->competition->region);

            // Generate round object.
            $round = (new Round)
                ->setId($item->round->id)
                ->setName($item->round->name);

            // Add start date to round object.
            if (!empty($item->round->start)) {
                $round->setStart($item->round->start);
            }

            // Add end date to round object.
            if (!empty($item->round->end)) {
                $round->setEnd($item->round->end);
            }

            // Generate team object.
            $team = (new Team)
                ->setId($item->team->id)
                ->setName($item->team->name)
                ->setShortName($item->team->shortName);

            // Generate standing object.
            $standing = (new Standing)
                ->setCompetition($competition)
                ->setRound($round)
                ->setTeam($team)
                ->setPosition($item->position)
                ->setPlayed($item->played)
                ->setWins($item->wins)
                ->setDraws($item->draws)
                ->setLosses($item->losses)
                ->setGoals('for', $item->for)
                ->setGoals('against', $item->against)
                ->setGoals('difference', $item->difference)
                ->setPoints($item->points);

            // Add info to standing object.
            if (!empty($item->info)) {
                $standing->setInfo($item->info);
            }

            // Add notes to standing object.
            if (!empty($item->notes)) {
                $standing->setNotes($item->notes);
            }

            // Add standing object to container.
            $standings->push($standing);
        }

        return $standings;
    }

    /**
     * Get all states.
     *
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function states() : Collection
    {
        // Request endpoint.
        $result = $this->request('states');

        // Container.
        $states = collect();

        foreach ($result->data as $item) {
            // Generate state object.
            $state = (new State)
                ->setId($item->id)
                ->setKey($item->key)
                ->setName($item->name);

            // Add state to container.
            $states->push($state);
        }

        return $states;
    }

    /**
     * Get top scorers list.
     *
     * @param  array $params
     * @return \Illuminate\Support\Collection
     * @throws \Rugaard\StatsFC\Exceptions\InvalidResponseBodyException
     * @throws \Rugaard\StatsFC\Exceptions\InvalidUrlException
     * @throws \Rugaard\StatsFC\Exceptions\RequestFailedException
     * @throws \Rugaard\StatsFC\Exceptions\ServiceUnavailableException
     * @throws \Rugaard\StatsFC\Exceptions\TooManyRequestsException
     * @throws \Rugaard\StatsFC\Exceptions\UnauthorizedException
     */
    public function topScorers(array $params = []) : Collection
    {
        // Filter array to only contain supported parameters.
        $params = array_filter($params, function($key) {
            return in_array($key, [
                'season',
                'competition',
                'competition_id',
                'competition_key',
                'team',
                'team_id',
            ]);
        }, ARRAY_FILTER_USE_KEY);

        // Request endpoint.
        $result = $this->request('top-scorers', $params);

        // Container.
        $topScorers = collect();

        foreach ($result->data as $item) {
            // Generate team object.
            $team = (new Team)
                ->setName($item->team->name)
                ->setShortName($item->team->shortName);

            // Generate player object.
            $player = (new Player)
                ->setName($item->player->name)
                ->setShortName($item->player->shortName);

            // Generate top scorer object.
            $topScorer = (new TopScorer)
                ->setId($item->id)
                ->setTeam($team)
                ->setPlayer($player)
                ->setGoals($item->goals);

            // Add top scorer object to container.
            $topScorers->push($topScorer);
        }

        return $topScorers;
    }
}