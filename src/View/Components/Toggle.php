<?php

namespace WireUi\View\Components;

class Toggle extends Checkbox
{
    protected function getView(): string
    {
        return 'wireui::components.toggle';
    }

    public function backgroundClasses(bool $hasError): string
    {
        return $this->classes([
            'bg-negative-500 dark:bg-negative-700' => $hasError,

            'w-7 h-4'  => $this->sm,
            'w-9 h-5'  => $this->md,
            'w-10 h-6' => $this->lg,
        ]);
    }

    public function circleClasses(): string
    {
        return $this->classes([
            'left-0.5 w-3 h-3'   => $this->sm,
            'left-1 w-3.5 h-3.5' => $this->md,
            'left-1 w-4 h-4'     => $this->lg,
        ]);
    }
}
