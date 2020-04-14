<?php

declare(strict_types=1);

namespace App\Domain\Member;

final class Rank
{
    public const INITIATE = 'Initiate';
    public const MEMBER = 'Member';
    public const WARDEN = 'Warden';
    public const CAPTAIN = 'Captain';
    public const COMMANDER = 'Commander';
    public const LEADER = 'Leader';
    public const GENERAL = 'General';
    public const AWAY = 'Away';
    public const ELITE = 'Elite';
    public const INACTIVE = 'Inactive';
    public const VANGUARD = 'Vanguard';
    public const COMPANION = 'Companion';
    public const PROBATION = 'Probation';

    private static array $validRanks = [
        self::INITIATE,
        self::MEMBER,
        self::WARDEN,
        self::CAPTAIN,
        self::COMMANDER,
        self::LEADER,
        self::GENERAL,
        self::AWAY,
        self::ELITE,
        self::INACTIVE,
        self::VANGUARD,
        self::COMPANION,
        self::PROBATION
    ];

    private string $value;

    public function __construct(string $value)
    {
        if (!\in_array($value, self::$validRanks, true)) {
            throw new \InvalidArgumentException(\sprintf('Rank "%s" is not valid.', $value));
        }

        $this->value = $value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
