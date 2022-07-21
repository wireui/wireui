<?php

namespace WireUi\View\Components;

abstract class BaseAlert extends Component
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
}
