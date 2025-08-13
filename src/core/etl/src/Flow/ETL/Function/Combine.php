<?php

declare(strict_types=1);

namespace Flow\ETL\Function;

use Flow\ETL\Row;

final class Combine extends ScalarFunctionChain
{
    /**
     * @param array<array-key, mixed>|ScalarFunction $keys
     * @param array<array-key, mixed>|ScalarFunction $values
     */
    public function __construct(
        private ScalarFunction|array $keys,
        private ScalarFunction|array $values,
    ) {
    }

    /**
     * @return null|array<int|string, mixed>
     */
    public function eval(Row $row) : ?array
    {
        $keys = (new Parameter($this->keys))->asArray($row);
        $values = (new Parameter($this->values))->asArray($row);

        if (null === $keys || null === $values) {
            return null;
        }

        if ([] === $keys) {
            return [];
        }
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

        if (!$arrayIsListFunction($keys)) {
            return null;
        }

        if (\count($keys) !== \count($values)) {
            return null;
        }

        if (!\is_string($keys[0] ?? null) && !\is_int($keys[0] ?? null)) {
            return null;
        }

        /** @var array<array-key, array-key> $keys */
        return \array_combine($keys, $values);
    }
}
