<?php declare(strict_types=1);

namespace App\Domain\Member\Positions;

use App\Domain\Member\BasicMember;

class TeamLeader extends BasicMember implements Position
{
    public function getPosition(): string
    {
        return Position::TEAM_LEADER;
    }

    public static function doesMatch(string $position): bool
    {
        return Position::TEAM_LEADER === $position;
    }
}
