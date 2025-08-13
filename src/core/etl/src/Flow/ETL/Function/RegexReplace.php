<?php

declare(strict_types=1);

namespace Flow\ETL\Function;

use Flow\ETL\Row;

final class RegexReplace extends ScalarFunctionChain
{
    public function __construct(
        private ScalarFunction|string $pattern,
        private ScalarFunction|string $replacement,
        private ScalarFunction|string $subject,
        private ScalarFunction|int|null $limit = null,
    ) {
    }

    public function eval(Row $row) : ?string
    {
        $pattern = (new Parameter($this->pattern))->asString($row);
        $replacement = (new Parameter($this->replacement))->asString($row);
        $subject = (new Parameter($this->subject))->asString($row);
        $limit = $this->limit ? (new Parameter($this->limit))->asInt($row) : -1;

        if ($pattern === null || $replacement === null || $subject === null || $limit === null) {
            return null;
        }

        return \preg_replace($pattern, $replacement, $subject, $limit);
    }
}
