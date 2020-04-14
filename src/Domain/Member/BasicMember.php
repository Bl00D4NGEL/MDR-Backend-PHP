<?php

namespace App\Domain\Member;

/** @todo omit base classes, put Logic in Member Class */
abstract class BasicMember implements MemberType
{
    private string $name;
    private int $id;
    private Rank $rank;

    public function __construct(string $name, int $id, Rank $rank)
    {
        $this->name = $name;
        $this->id = $id;
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

    public function getRank(): Rank
    {
        return $this->rank;
    }
}
