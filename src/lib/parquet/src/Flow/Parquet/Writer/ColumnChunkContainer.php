<?php

declare(strict_types=1);

namespace Flow\Parquet\Writer;

use Flow\Parquet\ParquetFile\RowGroup\ColumnChunk;

final class ColumnChunkContainer
{
    public function __construct(
        public string $binaryBuffer,
        public ColumnChunk $columnChunk,
    ) {
    }
}
