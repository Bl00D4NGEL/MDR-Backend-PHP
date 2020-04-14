<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Collections\MemberCollection;
use App\Domain\Collections\RosterCollection;
use App\Domain\Member\MemberType;
use App\Domain\Member\Positions\TeamLeader;

class Team
{
    private RosterCollection $rosters;
    private string $teamName;
    private MemberCollection $teamLeaders;

    public function __construct(string $teamName)
    {
        $this->teamName = $teamName;
        $this->rosters = new RosterCollection();
        $this->teamLeaders = new MemberCollection();
    }

    public function addTeamLeader(TeamLeader $teamLeader): self
    {
        $this->teamLeaders->add($teamLeader);

        return $this;
    }

    public function addRoster(Roster $roster): self
    {
        $this->rosters->add($roster);

        return $this;
    }

    /** @return MemberType[] */
    public function getMembers(): array
    {
        $members = [];

        foreach ($this->teamLeaders->getMembers() as $member) {
            $members[] = $member;
        }

        foreach ($this->rosters->getMembers() as $member) {
            $members[] = $member;
        }
        return $members;
    }

    /** @return Roster[] */
    public function getRosters(): array {
        return $this->rosters->getRosters();
    }

    public function getName(): string {
        return $this->teamName;
    }
}
