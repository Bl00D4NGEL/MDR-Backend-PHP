<?php declare(strict_types=1);

namespace App\Domain\Member\Positions;

use App\Domain\Member\BasicMember;
use App\Domain\Member\Ranks;

class Member extends BasicMember implements Position
{
    public function __construct(string $name, int $id, ?string $rank = Ranks::MEMBER)
    {
        parent::__construct($name, $id, $rank);
    }

    public function getPosition(): string
    {
        return Position::MEMBER;
    }

    public static function doesMatch(string $position): bool
    {
        return Position::MEMBER === $position;
    }
}
