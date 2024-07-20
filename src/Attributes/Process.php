<?php

namespace WireUi\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Process
{
    public readonly int $priority;

    public function __construct(int $priority = 0)
    {
        $this->priority = max(0, min(100, $priority));
    }
}
