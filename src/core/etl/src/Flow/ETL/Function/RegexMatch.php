<?php

declare(strict_types=1);

namespace Flow\ETL\Function;

use Flow\ETL\Row;

final class RegexMatch extends ScalarFunctionChain
{
    /**
     * @param ScalarFunction|string $pattern
     * @param array<array-key, mixed>|ScalarFunction|string $subject
     * @param int|ScalarFunction $flags
     * @param int|ScalarFunction $offset
     */
    public function __construct(
        private ScalarFunction|string $pattern,
        private ScalarFunction|string|array $subject,
        private ScalarFunction|int $flags = 0,
        private ScalarFunction|int $offset = 0,
    ) {
    }

    public function eval(Row $row) : ?bool
    {
        $pattern = (new Parameter($this->pattern))->asString($row);
        $subject = (new Parameter($this->subject))->asString($row);
        $flags = (new Parameter($this->flags))->asInt($row);
        $offset = (new Parameter($this->offset))->asInt($row);

        if ($pattern === null || $subject === null || $flags === null || $offset === null) {
            return null;
        }

        /** @phpstan-ignore-next-line */
        return \preg_match(pattern: $pattern, subject: $subject, flags: $flags, offset: $offset) === 1;
    }
}
