<?php

namespace WireUi\Support;

use Illuminate\Contracts\Support\Htmlable;

class Html implements Htmlable {
    public function __construct(
        public string $html
    ) {
    }

    public function toHtml(): string
    {
        return $this->html;
    }
}
