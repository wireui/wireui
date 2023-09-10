<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
{
    protected function default(): string
    {
        return 'primary';
    }

    public function all(): array
    {
        return [
            'primary' => <<<EOT
                bg-secondary-200 peer-checked:bg-primary-600 peer-focus:ring-primary-600
                group-focus:ring-primary-600 dark:group-focus:ring-secondary-600
                dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800
                dark:bg-secondary-600 dark:peer-checked:bg-secondary-700
            EOT,
            'secondary' => <<<EOT
                bg-secondary-200 peer-checked:bg-primary-600 peer-focus:ring-primary-600
                group-focus:ring-primary-600 dark:group-focus:ring-secondary-600
                dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800
                dark:bg-secondary-600 dark:peer-checked:bg-secondary-700
            EOT,
            'positive' => <<<EOT
                bg-secondary-200 peer-checked:bg-positive-600 peer-focus:ring-positive-600
                group-focus:ring-positive-600 dark:group-focus:ring-secondary-600
                dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800
                dark:bg-secondary-600 dark:peer-checked:bg-secondary-700
            EOT,
            'negative' => <<<EOT
                bg-secondary-200 peer-checked:bg-negative-600 peer-focus:ring-negative-600
                group-focus:ring-negative-600 dark:group-focus:ring-secondary-600
                dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800
                dark:bg-secondary-600 dark:peer-checked:bg-secondary-700
            EOT,
            'warning' => <<<EOT
                bg-secondary-200 peer-checked:bg-warning-600 peer-focus:ring-warning-600
                group-focus:ring-warning-600 dark:group-focus:ring-secondary-600
                dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800
                dark:bg-secondary-600 dark:peer-checked:bg-secondary-700
            EOT,
            'info' => <<<EOT
                bg-secondary-200 peer-checked:bg-info-600 peer-focus:ring-info-600
                group-focus:ring-info-600 dark:group-focus:ring-secondary-600
                dark:peer-focus:ring-secondary-600 dark:peer-focus:ring-offset-secondary-800
                dark:bg-secondary-600 dark:peer-checked:bg-secondary-700
            EOT,
        ];
    }
}
