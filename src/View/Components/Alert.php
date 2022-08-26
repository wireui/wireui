<?php

namespace WireUi\View\Components;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $backgroundColor = 'bg-gray-50 dark:bg-secondary-700';

    public string $subjectColor = 'text-gray-700 dark:text-gray-400';

    public function __construct(
        public ?string $padding = 'p-4',
        public ?string $rounded = 'rounded-md',
        public ?string $icon = null,
        public ?string $title = null,
        public ?string $message = null,
        public ?string $actions = null,
        public ?string $dismissible = null,
        public bool $border = false,
        public bool $shadow = false,
        public bool $info = false,
        public bool $warning = false,
        public bool $positive = false,
        public bool $negative = false,
        public ?string $alertClasses = '',
    ) {
        $this->getDefaultStyle();
        $this->alertClasses = $this->getAlertClasses($alertClasses);
    }

    public function render()
    {
        return view('wireui::components.alert');
    }

    public function getAlertClasses(?string $alertClasses): string
    {
        return Str::of('')
            ->append(" {$this->rounded}")
            ->append(" {$this->padding}")
            ->append(" {$this->backgroundColor}")
            ->append(" {$this->subjectColor}")
            ->when($this->border, function (Stringable $stringable) {
                return $stringable->append(' border border-gray-300 dark:border-secondary-600');
            })
            ->when($this->shadow, function (Stringable $stringable) {
                return $stringable->append(' shadow-md');
            })
            ->append(" {$alertClasses}");
    }

    public function getDefaultStyle()
    {
        if ($this->info) {
            $this->icon = (!$this->icon) ? 'information-circle' : $this->icon;
            $this->backgroundColor = 'bg-blue-50 dark:bg-blue-200';
            $this->subjectColor = 'text-blue-700 dark:text-blue-800';
            return true;
        }

        if ($this->warning) {
            $this->icon = (!$this->icon) ? 'exclamation' : $this->icon;
            $this->backgroundColor = 'bg-yellow-50 dark:bg-yellow-200';
            $this->subjectColor = 'text-yellow-700 dark:text-yellow-800';
            return true;
        }

        if ($this->positive) {
            $this->icon = (!$this->icon) ? 'check-circle' : $this->icon;
            $this->backgroundColor = 'bg-green-50 dark:bg-green-200';
            $this->subjectColor = 'text-green-700 dark:text-green-800';
            return true;
        }

        if ($this->negative) {
            $this->icon = (!$this->icon) ? 'x-circle' : $this->icon;
            $this->backgroundColor = 'bg-red-50 dark:bg-red-200';
            $this->subjectColor = 'text-red-700 dark:text-red-800';
            return true;
        }
    }
}
