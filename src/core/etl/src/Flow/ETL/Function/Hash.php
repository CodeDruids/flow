<?php

declare(strict_types=1);

namespace Flow\ETL\Function;

use Flow\ETL\Hash\{Algorithm, NativePHPHash};
use Flow\ETL\Row;

final class Hash extends ScalarFunctionChain
{
    public function __construct(private mixed $value, private ?Algorithm $algorithm = null)
    {
        $this->algorithm = $algorithm ?? new NativePHPHash();
    }

    public function eval(Row $row) : ?string
    {
        $value = (new Parameter($this->value))->eval($row);

        return match ($value) {
            null => null,
            default => match (\gettype($value)) {
                'array', 'object' => $this->algorithm->hash(\serialize($value)),
                default => $this->algorithm->hash(\is_scalar($value) ? (string) $value : ''),
            },
        };
    }
}
