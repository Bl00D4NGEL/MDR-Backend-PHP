<?php declare(strict_types=1);

namespace App\Domain\Member\Positions;

interface Position
{
    public const TEAM_LEADER = 'TL';
    public const WARDEN = 'RL';
    public const COMMANDER = 'DC';
    public const VICE = 'DV';
    public const MEMBER = 'TM';
    public const LEADER = 'L';
    public const HOUSE_GENERAL = 'HG';
    public const CHANCELLOR = 'CH';

    public const NOT_SET = 'Not Set';

    public static function doesMatch(string $position): bool;
}
