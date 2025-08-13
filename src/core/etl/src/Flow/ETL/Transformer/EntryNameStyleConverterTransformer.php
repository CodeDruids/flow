<?php

declare(strict_types=1);

namespace Flow\ETL\Transformer;

use Flow\ETL\{FlowContext,
    Function\StyleConverter\StringStyles as OldStringStyles,
    Row,
    Rows,
    String\StringStyles,
    Transformer};
use Flow\ETL\Row\Entry;

final class EntryNameStyleConverterTransformer implements Transformer
{
    /**
     * @readonly
     */
    private StringStyles $style;

    public function __construct(OldStringStyles|StringStyles $style)
    {
        if ($style instanceof OldStringStyles) {
            $this->style = StringStyles::fromString($style->value);
        } else {
            $this->style = $style;
        }
    }

    public function transform(Rows $rows, FlowContext $context) : Rows
    {
        $rowTransformer = function (Row $row) : Row {
            $valueMap = fn (Entry $entry) : Entry => $entry->rename($this->style->convert($entry->name()));

            return $row->map($valueMap);
        };

        return $rows->map($rowTransformer);
    }
}
