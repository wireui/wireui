<?php

namespace WireUi\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    public function __construct(
        public string $name,
        public ?string $style = null,
        public bool $solid = false,
        public bool $outline = false,
        public bool $mini = false,
        public bool $micro = false,
    ) {
        $this->style = $this->getStyle();

        if ($mini || $this->style === 'mini') {
            $this->style = 'mini.solid';
        }

        if ($micro || $this->style === 'micro') {
            $this->style = 'micro.solid';
        }
    }

    public function render(): View
    {
        return view("wireui::components.icons.{$this->style}.{$this->name}");
    }

    private function getStyle(): string
    {
        return match (true) {
            (bool) $this->style => $this->style,
            $this->solid => 'solid',
            $this->outline => 'outline',
            $this->mini => 'mini.solid',
            $this->micro => 'micro.solid',
            default => $this->defaultStyle(),
        };
    }

    protected function defaultStyle(): string
    {
        /** @var string */
        return config('wireui.icons.style');
    }
}
