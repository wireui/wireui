<?php

namespace WireUi\Support\Alerts;

class Values extends ConfigPack
{
    public function default(): Config
    {
        return new Config(
            icon: 'bell',
            iconColor: 'text-primary-400 dark:text-primary-600',
            textColor: 'text-primary-800 dark:text-primary-600',
            borderColor: 'border-primary-200 dark:border-primary-600',
            backgroundColor: 'bg-primary-50 dark:bg-secondary-800',
        );
    }

    public function all(): array
    {
        return [
            'positive' => new Config(
                icon: 'check-circle',
                iconColor: 'text-positive-400 dark:text-positive-600',
                textColor: 'text-positive-800 dark:text-positive-600',
                borderColor: 'border-positive-200 dark:border-positive-600',
                backgroundColor: 'bg-positive-50 dark:bg-secondary-800',
            ),
            'negative' => new Config(
                icon: 'x-circle',
                iconColor: 'text-negative-400 dark:text-negative-600',
                textColor: 'text-negative-800 dark:text-negative-600',
                borderColor: 'border-negative-200 dark:border-negative-600',
                backgroundColor: 'bg-negative-50 dark:bg-secondary-800',
            ),
            'warning' => new Config(
                icon: 'exclamation-triangle',
                iconColor: 'text-warning-400 dark:text-warning-600',
                textColor: 'text-warning-800 dark:text-warning-600',
                borderColor: 'border-warning-200 dark:border-warning-600',
                backgroundColor: 'bg-warning-50 dark:bg-secondary-800',
            ),
            'info' => new Config(
                icon: 'information-circle',
                iconColor: 'text-info-400 dark:text-info-600',
                textColor: 'text-info-800 dark:text-info-600',
                borderColor: 'border-info-200 dark:border-info-600',
                backgroundColor: 'bg-info-50 dark:bg-secondary-800',
            ),
        ];
    }
}
