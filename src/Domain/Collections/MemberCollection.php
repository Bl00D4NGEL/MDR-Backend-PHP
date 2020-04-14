<?php declare(strict_types=1);

namespace App\Domain\Collections;

use App\Domain\Member\MemberType;

class MemberCollection
{
    /** @var MemberType[] $members */
    private array $members = [];

    public function add(MemberType $member)
    {
        $this->members[] = $member;
    }

    /** @return MemberType[] */
    public function getMembers(): array
    {
        return $this->members;
    }
}
