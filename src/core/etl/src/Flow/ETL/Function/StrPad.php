<?php

declare(strict_types=1);

namespace Flow\ETL\Function;

use Flow\ETL\Row;

final class StrPad extends ScalarFunctionChain
{
    public function __construct(
        private ScalarFunction|string $value,
        private ScalarFunction|int $length,
        private ScalarFunction|string $padString = ' ',
        private ScalarFunction|int $type = STR_PAD_RIGHT,
    ) {
    }

    public function eval(Row $row) : mixed
    {
        $value = (new Parameter($this->value))->asString($row);
        $length = (new Parameter($this->length))->asInt($row);
        $padString = (new Parameter($this->padString))->asString($row);
        $type = (new Parameter($this->type))->asInt($row);

        if ($value === null || $length === null || $padString === null || $type === null) {
            return null;
        }

        return \str_pad($value, $length, $padString, $type);
    }
}
