<?php

declare(strict_types=1);

namespace Flow\ETL\Exception;

final class KeyNotInCacheException extends InvalidArgumentException
{
    public function __construct(public string $key, ?\Throwable $previous = null)
    {
        parent::__construct(\sprintf('Key "%s" not found in cache.', $key), 0, $previous);
    }
}
