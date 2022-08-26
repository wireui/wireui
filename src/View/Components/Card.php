<?php

namespace WireUi\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\{Str, Stringable};

class Card extends Component
{
    public ?string $padding;

    public ?string $shadow;

    public ?string $rounded;

    public ?string $color;

    public ?string $title;

    public ?string $action;

    public ?string $header;

    public ?string $footer;

    public ?string $cardClasses = '';

    public ?string $headerClasses = '';

    public ?string $footerClasses = '';

    public function __construct(
        ?string $padding = 'px-2 py-5 md:px-4',
        ?string $shadow = 'shadow-md',
        ?string $rounded = 'rounded-lg',
        ?string $color = 'bg-white dark:bg-secondary-800',
        ?string $title = null,
        ?string $action = null,
        ?string $header = null,
        ?string $footer = null,
        ?string $cardClasses = '',
        ?string $headerClasses = '',
        ?string $footerClasses = '',
    ) {
        $this->padding       = $padding;
        $this->shadow        = $shadow;
        $this->rounded       = $rounded;
        $this->color         = $color;
        $this->title         = $title;
        $this->action        = $action;
        $this->header        = $header;
        $this->footer        = $footer;
        $this->cardClasses   = $this->setCardClasses($cardClasses);
        $this->headerClasses = $this->setHeaderClasses($headerClasses);
        $this->footerClasses = $this->setFooterClasses($footerClasses);
    }

    public function setCardClasses(?string $cardClasses): string
    {
        return Str::of('w-full flex flex-col')
            ->append(" {$this->shadow}")
            ->append(" {$this->rounded}")
            ->append(" {$this->color}")
            ->append(" {$cardClasses}");
    }

    public function setHeaderClasses(?string $headerClasses): string
    {
        if (Str::contains($headerClasses, 'dark:border')) {
            return Str::of('px-4 py-2.5 flex justify-between items-center border-b dark:border-0')
                ->replace('dark:border-0', '')
                ->append(" {$headerClasses}");
        }
        return Str::of('px-4 py-2.5 flex justify-between items-center border-b dark:border-0')
            ->append(" {$headerClasses}");
    }

    public function setFooterClasses(?string $footerClasses): string
    {
        return Str::of('px-4 py-4 sm:px-6 bg-secondary-50 rounded-t-none border-t dark:bg-secondary-800 dark:border-secondary-600')
            ->append(" {$this->rounded}")
            ->append(" {$footerClasses}");
    }

    public function render()
    {
        return view('wireui::components.card');
    }
}
