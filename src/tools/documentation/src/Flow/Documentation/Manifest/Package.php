<?php

declare(strict_types=1);

namespace Flow\Documentation\Manifest;

final class Package
{
    public function __construct(public string $name, public string $path, public Type $type)
    {
    }
}
