<?php

namespace WireUi\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $backgroundColor = 'bg-gray-50 dark:bg-secondary-700';

    public string $subjectColor = 'text-gray-700 dark:text-gray-400';

    public function __construct(
        public ?string $padding = 'p-4',
        public ?string $rounded = 'rounded-md',
        public ?string $icon = null,
        public ?string $heading = null,
        public ?string $text = null,
        public ?string $actions = null,
        public bool $border = false,
        public bool $shadow = false,
        public bool $info = false,
        public bool $warning = false,
        public bool $positive = false,
        public bool $negative = false,
        public bool $dismiss = false,
        public ?string $alertClasses = '',
    ) {
        $this->info = $this->getInfoAlert($info);
        $this->warning = $this->getWarningAlert($warning);
        $this->positive = $this->getPositiveAlert($positive);
        $this->negative = $this->getNegativeAlert($negative);
        $this->alertClasses = $this->getAlertClasses($alertClasses);
    }

    public function getInfoAlert($info): string
    {
        if ($info) {
            $this->icon = (!$this->icon) ? 'information-circle' : $this->icon;
            $this->backgroundColor = 'bg-blue-50 dark:bg-blue-200';
            $this->subjectColor = 'text-blue-700 dark:text-blue-800';
            return true;
        }

        return false;
    }

    public function getWarningAlert($warning): string
    {
        if ($warning) {
            $this->icon = (!$this->icon) ? 'exclamation' : $this->icon;
            $this->backgroundColor = 'bg-yellow-50 dark:bg-yellow-200';
            $this->subjectColor = 'text-yellow-700 dark:text-yellow-800';
            return true;
        }

        return false;
    }

    public function getPositiveAlert($success): string
    {
        if ($success) {
            $this->icon = (!$this->icon) ? 'check-circle' : $this->icon;
            $this->backgroundColor = 'bg-green-50 dark:bg-green-200';
            $this->subjectColor = 'text-green-700 dark:text-green-800';
            return true;
        }

        return false;
    }

    public function getNegativeAlert($danger): string
    {
        if ($danger) {
            $this->icon = (!$this->icon) ? 'x-circle' : $this->icon;
            $this->backgroundColor = 'bg-red-50 dark:bg-red-200';
            $this->subjectColor = 'text-red-700 dark:text-red-800';
            return true;
        }

        return false;
    }

    public function getAlertClasses(?string $alertClasses): string
    {
        return $this->classes([
            $this->rounded,
            $this->padding,
            $this->backgroundColor,
            $this->subjectColor,
            'border border-gray-300 dark:border-secondary-600' => $this->border,
            'shadow-md' =>  $this->shadow,
            $alertClasses
        ]);
    }

    public function render()
    {
        return view('wireui::components.alert');
    }
}
