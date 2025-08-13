<?php

declare(strict_types=1);

namespace Flow\ETL\Attribute;

#[\Attribute] final class DocumentationDSL
{
    public function __construct(
        public Module $module,
        public Type $type,
    ) {

    }
}
