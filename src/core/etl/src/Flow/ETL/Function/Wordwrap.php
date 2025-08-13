<?php

declare(strict_types=1);

namespace Flow\ETL\Function;

use function Flow\Types\DSL\type_integer;
use function Symfony\Component\String\s;
use Flow\ETL\Row;

final class Wordwrap extends ScalarFunctionChain
{
    public function __construct(
        private ScalarFunction|string $value,
        private ScalarFunction|int $width,
        private ScalarFunction|string $break = "\n",
        private ScalarFunction|bool $cut = false,
    ) {
    }

    public function eval(Row $row) : ?string
    {
        $value = (new Parameter($this->value))->asString($row);
        $width = type_integer()->assert((new Parameter($this->width))->as($row, type_integer()));
        $break = (new Parameter($this->break))->asString($row);
        $cut = (new Parameter($this->cut))->asBoolean($row);

        if ($value === null) {
            return null;
        }

        if ($width <= 0) {
            return $value;
        }

        if ($break === null) {
            $break = "\n";
        }

        return s($value)->wordwrap($width, $break, $cut)->toString();
    }
}
