<?php

namespace FluxFileStorageApi\Service\Storage\Command;

use Exception;
use FluxFileStorageApi\Adapter\Storage\StorageConfigDto;
use FluxFileStorageApi\Service\Storage\StorageUtils;

class ReadCommand
{

    use StorageUtils;

    private function __construct(
        private readonly StorageConfigDto $storage_config
    ) {

    }


    public static function new(
        StorageConfigDto $storage_config
    ) : static {
        return new static(
            $storage_config
        );
    }


    public function read(string $path) : ?string
    {
        $full_path = $this->getFullPath_(
            $path
        );
        if (!file_exists($full_path)) {
            return null;
        }

        if (($data = file_get_contents($full_path)) === false) {
            throw new Exception("Failed to read " . $full_path);
        }

        return $data;
    }
}
