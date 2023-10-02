<?php

namespace WireUi\Support;

final class Event
{
    public function __construct(
        public string $name,
        public array $data = [],
    ) {
    }
}
