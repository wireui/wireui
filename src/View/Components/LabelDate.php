<?php

namespace WireUi\View\Components;

use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LabelDate extends Label
{
    public function __construct(
        public bool $hasError = false,
        public ?DateTime $datetime = null
    ) {
        parent::__construct($hasError);

        $this->label = $this->getLabel($datetime);
    }

    private function getLabel($datetime): string
    {
        switch ($this->getDays($datetime)) {
            case 0:
                return $datetime->diffForHumans();

            case 1:
                return $datetime->diffForHumans(['options' =>  \Carbon\Carbon::ONE_DAY_WORDS]);

            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
                return $datetime->format('l');

            default:
                return $datetime->format('j M y');
        }
    }

    private function getDays($datetime): string
    {
        return now()->diffInDays($datetime);
    }

    public function render(): View
    {
        return view('wireui::components.label');
    }
}
