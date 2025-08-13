<?php

declare(strict_types=1);

namespace Flow\ETL\Schema\Formatter\PHPFormatter;

use Flow\ETL\Exception\RuntimeException;

final class ValueFormatter
{
    public function format(mixed $value) : string
    {
        if (null === $value) {
            return 'null';
        }

        if (\is_array($value)) {
            return $this->formatArray($value);
        }

        if (\is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (\is_string($value)) {
            return \sprintf('"%s"', $value);
        }

        if (!\is_numeric($value)) {
            throw new RuntimeException(\sprintf('Unsupported value type: %s', \get_debug_type($value)));
        }

        return (string) $value;
    }

    /**
     * @param array<array-key, mixed> $array
     */
    private function formatArray(array $array) : string
    {
        $formattedArray = [];
        $arrayIsListFunction = function (array $array) : bool {
            if (function_exists('array_is_list')) {
                return array_is_list($array);
            }

            if ($array === []) {
                return true;
            }
            $current_key = 0;

            foreach ($array as $key => $noop) {
                if ($key !== $current_key) {
                    return false;
                }
                $current_key++;
            }

            return true;
        };

        if ($arrayIsListFunction($array)) {
            foreach ($array as $value) {
                $formattedArray[] = \sprintf('%s', $this->format($value));
            }
        } else {
            foreach ($array as $key => $value) {
                $formattedArray[] = \sprintf('%s => %s', $this->format($key), $this->format($value));
            }
        }

        return '[' . \implode(', ', $formattedArray) . ']';
    }
}
