<?php

namespace WireUi\View\Components;

use Closure;
use Illuminate\Support\{Arr, HtmlString};
use Illuminate\View\Component;
use WireUi\Traits\HasModifiers;
use Illuminate\Contracts\View\View;

class Divider extends Component
{
    use HasModifiers;

    public function __construct(
        public ?bool $reactive = false
    ) {
    }

    public function getDividerClasses($isReactive): string
    {
        $default = <<<EOT
            flex flex-row flex-grow items-center
            before:mr-4 before:flex-1 before:border-b-2 before:m-auto
            empty:before:mr-0 empty:after:ml-0 before:flex-1
            after:ml-4 before:border-b-2 before:m-auto after:flex-1 after:border-b-2 after:m-auto
        EOT;

        $reactive = <<<EOT
            lg:mx-4 lg:my-0 lg:h-auto lg:flex-col
            lg:before:m-0 lg:before:border-0 lg:before:h-full lg:before:w-0.5 lg:before:bg-gray-200
            lg:after:m-0 lg:after:border-0 lg:after:h-full lg:after:w-0.5 lg:after:bg-gray-200
         EOT;

        return Arr::toCssClasses([
            $default,
            $reactive    => $isReactive
        ]);
    }

    public function render(): View
    {
        return view('wireui::components.divider');
    }
}
