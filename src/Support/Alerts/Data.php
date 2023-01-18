<?php

namespace WireUi\Support\Alerts;

use Stringable;

class Data implements Stringable
{
    public function __construct(
        public string $icon = '',
        public string $iconColor = '',
        public string $textColor = '',
        public string $borderColor = '',
        public string $backgroundColor = '',
    ) {
    }

    public function toString(): string
    {
        return json_encode([
            'icon'            => $this->icon,
            'iconColor'       => $this->iconColor,
            'textColor'       => $this->textColor,
            'borderColor'     => $this->borderColor,
            'backgroundColor' => $this->backgroundColor,
        ]);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
