<?php declare(strict_types=1);

namespace App\Domain\ReportReader;

use App\Domain\Member\MemberType;

interface Reader
{
    /** @return MemberType[] */
    public function read(): array;
}
