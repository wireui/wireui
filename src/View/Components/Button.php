<?php

namespace WireUi\View\Components;

class Button extends BaseButton
{
    protected function getOutlineColors(): array
    {
        return [
            'primary' => 'ring-primary-600 text-primary-600 border border-primary-600 hover:bg-primary-50
                          dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',

            'secondary' => 'ring-secondary-600 text-secondary-600 border border-secondary-600 hover:bg-secondary-100
                            dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',

            'positive' => 'ring-positive-500 text-positive-600 border border-positive-600 hover:bg-positive-50
                           dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',

            'negative' => 'ring-negative-500 text-negative-600 border border-negative-600 hover:bg-negative-50
                           dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',

            'warning' => 'ring-warning-500 text-warning-600 border border-warning-600 hover:bg-warning-50
                          dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',

            'info' => 'ring-info-600 text-info-800 border border-info-800 hover:bg-info-50
                       dark:ring-offset-secondary-800 dark:hover:bg-secondary-700',

            'dark' => 'ring-secondary-600 text-secondary-800 border border-secondary-800 hover:bg-secondary-200
                       dark:ring-offset-secondary-800 dark:hover:bg-secondary-700 dark:text-secondary-500',
        ];
    }

    protected function getFlatColors(): array
    {
        return [
            'primary' => 'ring-primary-600 text-primary-600 hover:bg-primary-100
                          dark:ring-offset-secondary-800 dark:hover:bg-secondary-700
                          dark:ring-primary-700',

            'secondary' => 'ring-secondary-600 text-secondary-600 hover:bg-secondary-100
                            dark:ring-offset-secondary-800 dark:hover:bg-secondary-700
                            dark:ring-secondary-700',

            'positive' => 'ring-positive-500 text-positive-600 hover:bg-positive-100
                           dark:ring-offset-secondary-800 dark:hover:bg-secondary-700
                           dark:ring-positive-700',

            'negative' => 'ring-negative-600 text-negative-600 hover:bg-negative-100
                           dark:ring-offset-secondary-800 dark:hover:bg-secondary-700
                           dark:ring-negative-700',

            'warning' => 'ring-warning-500 text-warning-600 hover:bg-warning-100
                          dark:ring-offset-secondary-800 dark:hover:bg-secondary-700
                          dark:ring-warning-700',

            'info' => 'ring-info-600 text-info-600 hover:bg-info-100
                       dark:ring-offset-secondary-800 dark:hover:bg-secondary-700
                       dark:ring-info-700',

            'dark' => 'ring-secondary-600 text-secondary-900 hover:bg-secondary-200
                       dark:ring-offset-secondary-800 dark:hover:bg-secondary-700
                       dark:ring-dark-700 dark:text-secondary-500',

        ];
    }

    protected function getDefaultColors(): array
    {
        return [
            'primary' => 'ring-primary-600 text-white bg-primary-500 hover:bg-primary-600
                          dark:ring-offset-secondary-800 dark:bg-primary-700 dark:ring-primary-700',

            'secondary' => 'ring-secondary-600 text-white bg-secondary-500 hover:bg-secondary-600
                            dark:ring-offset-secondary-800 dark:bg-secondary-700 dark:ring-secondary-700',

            'positive' => 'ring-positive-500 text-white bg-positive-500 hover:bg-positive-600
                           dark:ring-offset-secondary-800 dark:bg-positive-700 dark:ring-positive-700',

            'negative' => 'ring-negative-600 text-white bg-negative-500 hover:bg-negative-600
                           dark:ring-offset-secondary-800 dark:bg-negative-700 dark:ring-negative-700',

            'warning' => 'ring-warning-500 text-white bg-warning-500 hover:bg-warning-600
                          dark:ring-offset-secondary-800 dark:bg-warning-700 dark:ring-warning-700',

            'info' => 'ring-info-600 text-white bg-info-500 hover:bg-info-600
                       dark:ring-offset-secondary-800 dark:bg-info-700 dark:ring-info-700',

            'dark' => 'ring-secondary-600 text-white bg-secondary-700 hover:bg-secondary-900
                       dark:ring-offset-secondary-800 dark:bg-secondary-700 dark:ring-secondary-700',

        ];
    }

    protected function getSizes(): array
    {
        return [
            'xs' => 'text-xs',
            'md' => 'text-md',
            'lg' => 'text-lg',
        ];
    }
}
