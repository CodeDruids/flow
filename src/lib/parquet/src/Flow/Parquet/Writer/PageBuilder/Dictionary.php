<?php

declare(strict_types=1);

namespace Flow\Parquet\Writer\PageBuilder;

final class Dictionary
{
    /**
     * @param array<int, mixed> $dictionary
     * @param array<int, int> $indices
     */
    public function __construct(
        public array $dictionary,
        public array $indices,
    ) {
    }
}
