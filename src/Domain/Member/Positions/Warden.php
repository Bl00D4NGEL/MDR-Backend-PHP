<?php declare(strict_types=1);

namespace App\Domain\Member\Positions;

use App\Domain\Member\BasicMember;

class Warden extends BasicMember implements Position
{
    public function getPosition(): string
    {
        return Position::WARDEN;
    }

    public static function doesMatch(string $position): bool
    {
        return Position::WARDEN === $position;
    }
}
