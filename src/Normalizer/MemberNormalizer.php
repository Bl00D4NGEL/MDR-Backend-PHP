<?php

declare(strict_types=1);

namespace App\Normalizer;

use App\Domain\Member\MemberType;
use App\Domain\Member\Positions\Chancellor;
use App\Domain\Member\Positions\Commander;
use App\Domain\Member\Positions\HouseGeneral;
use App\Domain\Member\Positions\Leader;
use App\Domain\Member\Positions\Member;
use App\Domain\Member\Positions\TeamLeader;
use App\Domain\Member\Positions\Vice;
use App\Domain\Member\Positions\Warden;
use App\Domain\Member\Rank;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final class MemberNormalizer implements DenormalizerInterface
{
    private const POSITION_MAPPING = [
        'TL' => TeamLeader::class,
        'RL' => Warden::class,
        'DC' => Commander::class,
        'DV' => Vice::class,
        'TM' => TeamLeader::class,
        'L' => Leader::class,
        'HG' => HouseGeneral::class,
        'CH' => Chancellor::class,
    ];

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === MemberType::class;
    }

    public function denormalize($data, string $type, string $format = null, array $context = [])
    {
        $memberClass = self::POSITION_MAPPING[$data['position']] ?? Member::class;

        return new $memberClass(
            $data['name'],
            (int) $data['id'],
            new Rank($data['rank'])
        );
    }
}
