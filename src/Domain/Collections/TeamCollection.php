<?php declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\Member\MemberType;
use App\Domain\Team;

class TeamCollection
{
    /** @var Team[] $teams */
    private array $teams = [];

    public function add(Team $team)
    {
        $this->teams[] = $team;
    }

    /** @return MemberType[] */
    public function getMembers(): array
    {
        $members = [];
        foreach ($this->teams as $team) {
            $members = array_merge($members, $team->getMembers());
        }

        return $members;
    }

    /** @return Team[] */
    public function getTeams(): array
    {
        return $this->teams;
    }
}
