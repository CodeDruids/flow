<?php

declare(strict_types=1);

namespace Flow\ETL\Exception;

final class InvalidFileFormatException extends \RuntimeException
{
    public function __construct(public string $expected, public string $given, ?\Throwable $previous = null)
    {
        parent::__construct(\sprintf('Expected "%s" file format, "%s" given.', $expected, $given), 0, $previous);
    }
}
