<?php

declare(strict_types=1);

namespace Flow\ETL\Exception;

final class ConstraintViolationException extends RuntimeException
{
    public function __construct(
        private string $constraint,
        private string $violation,
        private int $rowIndex,
    ) {
        parent::__construct("Constraint violation: {$this->constraint} - {$this->violation} in row: {$this->rowIndex}");
    }
}
