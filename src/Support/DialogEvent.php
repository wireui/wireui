<?php

namespace WireUi\Support;

final readonly class DialogEvent
{
    public function __construct(
        public string $id,
        public string $name,
        public array $data = [],
    ) {
    }
}
