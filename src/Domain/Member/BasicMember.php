<?php

namespace App\Domain\Member;

use InvalidArgumentException;

abstract class BasicMember implements MemberType
{
    private string $name;
    private int $id;
    private string $rank;

    public function __construct(string $name, int $id, string $rank = Ranks::INITIATE)
    {
        $this->name = $name;
        $this->id = $id;
        if (!Ranks::isValidRank($rank)) {
            throw new InvalidArgumentException("Rank $rank is invalid!");
        }
        $this->rank = $rank;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRank(): string
    {
        return $this->rank;
    }
}
