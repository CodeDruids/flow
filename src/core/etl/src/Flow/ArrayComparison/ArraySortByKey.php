<?php

declare(strict_types=1);

namespace Flow\ArrayComparison;

final class ArraySortByKey
{
    /**
     * @param array<mixed> $array
     *
     * @return array<mixed>
     */
    public function __invoke(array $array) : array
    {
        $array = \array_map(
            fn ($value) => \is_array($value) ? (new self)($value) : $value,
            $array
        );
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
            \sort($array);
        } else {
            \ksort($array);
        }

        return $array;
    }
}
