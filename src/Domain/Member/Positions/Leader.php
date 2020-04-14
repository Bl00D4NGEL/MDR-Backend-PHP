<?php declare(strict_types=1);

namespace App\Domain\Member\Positions;

use App\Domain\Member\BasicMember;

class Leader extends BasicMember implements Position
{
    public function getPosition(): string
    {
        return Position::LEADER;
    }

    public static function doesMatch(string $position): bool
    {
        return Position::LEADER === $position;
    }
}
