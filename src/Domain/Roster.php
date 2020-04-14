<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Collections\MemberCollection;
use App\Domain\Member\MemberType;

class Roster
{
    private MemberCollection $members;
    private int $rosterNumber;
    private string $teamName;

    public function __construct(string $teamName, int $rosterNumber)
    {
        $this->teamName = $teamName;
        $this->rosterNumber = $rosterNumber;
        $this->members = new MemberCollection();
    }

    public function addMember(MemberType $member): self
    {
        $this->members->add($member);

        return $this;
    }

    /** @return MemberType[] */
    public function getMembers(): array
    {
        return $this->members->getMembers();
    }

    public function getFullyQualifiedRosterName(): string
    {
        return sprintf("Team %s Roster %d", $this->teamName, $this->rosterNumber);
    }
}
