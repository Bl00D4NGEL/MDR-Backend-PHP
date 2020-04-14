<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Member\MemberType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\SerializerInterface;

final class ReportImporter
{
    private SerializerInterface $serializer;
    private Filesystem $filesystem;
    private string $basePath;

    public function __construct(SerializerInterface $serializer, Filesystem $filesystem, string $basePath)
    {
        $this->serializer = $serializer;
        $this->filesystem = $filesystem;
        $this->basePath = $basePath;
    }

    /** @return MemberType[] */
    public function import(string $filename): array
    {
        $path = $this->basePath.'/'.$filename;

        if (!$this->filesystem->exists($path)) {
            throw new \InvalidArgumentException(\sprintf('File "%s" could not be found.', $filename));
        }

        return $this->serializer->deserialize(file_get_contents($path), MemberType::class.'[]', 'csv');
    }
}
