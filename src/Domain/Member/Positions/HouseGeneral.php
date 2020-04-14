<?php declare(strict_types=1);

namespace App\Domain\Member\Positions;

use App\Domain\Member\BasicMember;

class HouseGeneral extends BasicMember implements Position
{
    public function getPosition(): string
    {
        return Position::HOUSE_GENERAL;
    }

    public static function doesMatch(string $position): bool
    {
        return Position::HOUSE_GENERAL === $position;
    }
}
