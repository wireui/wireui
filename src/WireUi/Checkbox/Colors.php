<?php

namespace WireUi\WireUi\Checkbox;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
{
    public function __toString(): string
    {
        return 'checkbox color';
    }

    protected function default(): string
    {
        $color = config('wireui.checkbox.color') ?? 'primary';

        $this->checkAttribute($color);

        return $this->get($color);
    }

    public function all(): array
    {
        return [
            'primary' => <<<EOT
                border-secondary-300 text-primary-600 focus:ring-primary-600 focus:border-primary-400
                dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
                dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
                dark:focus:ring-offset-secondary-800
            EOT,
            'secondary' => <<<EOT
                border-secondary-300 text-secondary-600 focus:ring-secondary-600 focus:border-secondary-400
                dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
                dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
                dark:focus:ring-offset-secondary-800
            EOT,
            'positive' => <<<EOT
                border-secondary-300 text-positive-600 focus:ring-positive-600 focus:border-positive-400
                dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
                dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
                dark:focus:ring-offset-secondary-800
            EOT,
            'negative' => <<<EOT
                border-secondary-300 text-negative-600 focus:ring-negative-600 focus:border-negative-400
                dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
                dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
                dark:focus:ring-offset-secondary-800
            EOT,
            'warning' => <<<EOT
                border-secondary-300 text-warning-600 focus:ring-warning-600 focus:border-warning-400
                dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
                dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
                dark:focus:ring-offset-secondary-800
            EOT,
            'info' => <<<EOT
                border-secondary-300 text-info-600 focus:ring-info-600 focus:border-info-400
                dark:border-secondary-500 dark:checked:border-secondary-600 dark:focus:ring-secondary-600
                dark:focus:border-secondary-500 dark:bg-secondary-600 dark:text-secondary-600
                dark:focus:ring-offset-secondary-800
            EOT,
        ];
    }
}
