<?php

declare(strict_types=1);

namespace Flow\ETL;

/**
 * Collection of transformations.
 * Transformations are applied in the order they are passed to the constructor.
 */
final class Transformations implements Transformation
{
    /**
     * @var array<int, Transformation>
     *
     * @readonly
     */
    public array $transformations;

    public function __construct(Transformation ...$transformations)
    {
        $this->transformations = \array_values($transformations);
    }

    public function transform(DataFrame $dataFrame) : DataFrame
    {
        foreach ($this->transformations as $transformation) {
            $dataFrame = $transformation->transform($dataFrame);
        }

        return $dataFrame;
    }
}
