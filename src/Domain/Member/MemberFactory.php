<?php declare(strict_types=1);

namespace App\Domain\Member;

use App\Domain\Member\Positions\Chancellor;
use App\Domain\Member\Positions\Commander;
use App\Domain\Member\Positions\HouseGeneral;
use App\Domain\Member\Positions\Leader;
use App\Domain\Member\Positions\Member;
use App\Domain\Member\Positions\Position;
use App\Domain\Member\Positions\TeamLeader;
use App\Domain\Member\Positions\Vice;
use App\Domain\Member\Positions\Warden;
use InvalidArgumentException;

class MemberFactory
{
    public function createMemberFromState(array $state): MemberType
    {
        if (empty($state['position']) || $state['position'] === Position::NOT_SET) {
            return new Member($state['name'], (int)$state['id'], $state['rank']);
        }

        $positions = [
            Commander::class,
            Member::class,
            TeamLeader::class,
            Vice::class,
            Warden::class,
            Leader::class,
            HouseGeneral::class,
            Chancellor::class
        ];

        /** @var Position $position */
        foreach ($positions as $position) {
            if ($position::doesMatch($state["position"])) {
                return new $position($state['name'], (int)$state['id'], $state['rank']);
            }
        }

        throw new InvalidArgumentException('Unknown position ' . $state['position'] . ' for: ' . print_r($state, true));
    }
}
