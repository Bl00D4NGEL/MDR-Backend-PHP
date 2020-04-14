<?php declare(strict_types=1);

namespace App\Domain\ReportReader;

use App\Domain\Member\MemberFactory;
use App\Domain\Member\MemberType;
use Exception;
use InvalidArgumentException;

class CsvReader implements Reader
{
    /** @var false|resource $fileHandle */
    private $fileHandle;

    private MemberFactory $memberFactory;

    public function __construct(string $filePath, MemberFactory $memberFactory)
    {
        $this->fileHandle = fopen($filePath, 'r');
        $this->memberFactory = $memberFactory;
    }

    public function __destruct()
    {
        fclose($this->fileHandle);
    }

    /**
     * @return MemberType[]
     * @throws Exception
     */
    public function read(): array
    {
        $header = fgetcsv($this->fileHandle, 0);
        $members = [];
        while (($row = fgetcsv($this->fileHandle, 0)) !== FALSE) {
            if (count($row) === 1) {
                continue;
            }
            $member = [];
            foreach ($row as $i => $value) {
                $member[$header[$i]] = $value;
            }

            $members[] = $this->transformStateToObject($member);
        }
        return $members;
    }

    private function transformStateToObject(array $state): MemberType
    {
        if (isset($state['name'], $state['id'], $state['rank'])) {
            return $this->memberFactory->createMemberFromState($state);
        }

        throw new InvalidArgumentException("Invalid state given:" . print_r($state, true));
    }
}
