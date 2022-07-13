<?php

namespace WireUi\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Alert extends Component
{
    public ?string $padding;

    public ?string $rounded;

    public bool $border;

    public bool $shadow;

    public bool $info;

    public bool $warning;

    public bool $success;

    public bool $danger;

    public ?string $icon;

    public ?string $heading;

    public ?string $text;

    public ?string $actions;

    public bool $dismiss;

    public ?string $alertClasses = '';

    public string $backgroundColor = 'bg-gray-50 dark:bg-secondary-700';

    public string $subjectColor = 'text-gray-700 dark:text-gray-400';

    public function __construct(
        ?string $padding = 'p-4',
        ?string $rounded = 'rounded-md',
        bool $border = false,
        bool $shadow = false,
        bool $info = false,
        bool $warning = false,
        bool $success = false,
        bool $danger = false,
        ?string $icon = null,
        ?string $heading = null,
        ?string $text = null,
        ?string $actions = null,
        bool $dismiss = false,
        ?string $alertClasses = '',
    ) {
        $this->padding = $padding;
        $this->rounded = $rounded;
        $this->border = $border;
        $this->shadow = $shadow;
        $this->info = $this->setInfoAlert($info);
        $this->warning = $this->setWarningAlert($warning);
        $this->success = $this->setSuccessAlert($success);
        $this->danger = $this->setDangerAlert($danger);
        $this->icon = $icon;
        $this->heading = $heading;
        $this->text = $text;
        $this->actions = $actions;
        $this->dismiss = $dismiss;
        $this->alertClasses = $this->setAlertClasses($alertClasses);
    }

    public function setInfoAlert($info): string
    {
        if ($info) {
            $this->backgroundColor = 'bg-blue-50 dark:bg-blue-200';
            $this->subjectColor = 'text-blue-700 dark:text-blue-800';
            return true;
        }

        return false;
    }

    public function setWarningAlert($warning): string
    {
        if ($warning) {
            $this->backgroundColor = 'bg-yellow-50 dark:bg-yellow-200';
            $this->subjectColor = 'text-yellow-700 dark:text-yellow-800';
            return true;
        }

        return false;
    }

    public function setSuccessAlert($success): string
    {
        if ($success) {
            $this->backgroundColor = 'bg-green-50 dark:bg-green-200';
            $this->subjectColor = 'text-green-700 dark:text-green-800';
            return true;
        }

        return false;
    }

    public function setDangerAlert($danger): string
    {
        if ($danger) {
            $this->backgroundColor = 'bg-red-50 dark:bg-red-200';
            $this->subjectColor = 'text-red-700 dark:text-red-800';
            return true;
        }

        return false;
    }

    public function setAlertClasses(?string $alertClasses): string
    {
        return Str::of('')
            ->append(" {$this->rounded}")
            ->append(" {$this->padding}")
            ->append(" {$this->backgroundColor}")
            ->append(" {$alertClasses}")
            ->when($this->border, function ($classes) {
                return $classes->append(' border border-gray-300 dark:border-secondary-600');
            })
            ->when($this->shadow, function ($classes) {
                return $classes->append(' shadow-md');
            });
    }

    public function render()
    {
        return view('wireui::components.alert');
    }
}
