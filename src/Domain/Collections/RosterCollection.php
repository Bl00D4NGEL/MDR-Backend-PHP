<?php declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\Member\MemberType;
use App\Domain\Roster;

class RosterCollection
{
    /** @var Roster[] $rosters */
    private array $rosters = [];

    public function add(Roster $roster)
    {
        $this->rosters[] = $roster;
    }

    /** @return MemberType[] */
    public function getMembers(): array
    {
        $members = [];
        foreach ($this->rosters as $roster) {
            $members = array_merge($members, $roster->getMembers());
        }

        return $members;
    }

    /** @return Roster[] */
    public function getRosters(): array
    {
        return $this->rosters;
    }
}
