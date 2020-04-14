<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Collections\MemberCollection;
use App\Domain\Collections\TeamCollection;
use App\Domain\Member\MemberType;
use App\Domain\Member\Positions\Commander;
use App\Domain\Member\Positions\Vice;

class Division
{
    private string $divisionName;
    private MemberCollection $commanders;
    private MemberCollection $vices;
    private TeamCollection $teams;

    public function __construct(string $divisionName)
    {
        $this->divisionName = $divisionName;
        $this->commanders = new MemberCollection();
        $this->vices = new MemberCollection();
        $this->teams = new TeamCollection();
    }

    public function addCommander(Commander $commander): self
    {
        $this->commanders->add($commander);

        return $this;
    }

    public function addVice(Vice $vice): self
    {
        $this->vices->add($vice);

        return $this;
    }

    public function addTeam(Team $team): self {
        $this->teams->add($team);

        return $this;
    }

    /** @return MemberType[] */
    public function getMembers(): array {
        $members = [];

        foreach ($this->commanders->getMembers() as $member) {
            $members[] = $member;
        }

        foreach ($this->vices->getMembers() as $member) {
            $members[] = $member;
        }

        foreach ($this->teams->getMembers() as $member) {
            $members[] = $member;
        }

        return $members;
    }

    /** @return Team[] */
    public function getTeams(): array {
        return $this->teams->getTeams();
    }

    public function getName(): string {
        return $this->divisionName;
    }
}
