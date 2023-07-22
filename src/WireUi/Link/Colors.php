<?php

namespace WireUi\WireUi\Link;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
{
    /**
     * Get the default option.
     */
    protected function default(): string
    {
        return 'primary';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'primary' => 'text-primary-500 dark:text-primary-700 hover:text-primary-600 dark:hover:text-primary-600',
            'secondary' => 'text-secondary-500 dark:text-secondary-700 hover:text-secondary-600 dark:hover:text-secondary-600',
            'positive' => 'text-positive-500 dark:text-positive-700 hover:text-positive-600 dark:hover:text-positive-600',
            'negative' => 'text-negative-500 dark:text-negative-700 hover:text-negative-600 dark:hover:text-negative-600',
            'warning' => 'text-warning-500 dark:text-warning-700 hover:text-warning-600 dark:hover:text-warning-600',
            'info' => 'text-info-500 dark:text-info-700 hover:text-info-600 dark:hover:text-info-600',
            'slate' => 'text-slate-500 dark:text-slate-700 hover:text-slate-600 dark:hover:text-slate-600',
            'gray' => 'text-gray-500 dark:text-gray-700 hover:text-gray-600 dark:hover:text-gray-600',
            'zinc' => 'text-zinc-500 dark:text-zinc-700 hover:text-zinc-600 dark:hover:text-zinc-600',
            'neutral' => 'text-neutral-500 dark:text-neutral-700 hover:text-neutral-600 dark:hover:text-neutral-600',
            'stone' => 'text-stone-500 dark:text-stone-700 hover:text-stone-600 dark:hover:text-stone-600',
            'red' => 'text-red-500 dark:text-red-700 hover:text-red-600 dark:hover:text-red-600',
            'orange' => 'text-orange-500 dark:text-orange-700 hover:text-orange-600 dark:hover:text-orange-600',
            'amber' => 'text-amber-500 dark:text-amber-700 hover:text-amber-600 dark:hover:text-amber-600',
            'yellow' => 'text-yellow-500 dark:text-yellow-700 hover:text-yellow-600 dark:hover:text-yellow-600',
            'lime' => 'text-lime-500 dark:text-lime-700 hover:text-lime-600 dark:hover:text-lime-600',
            'green' => 'text-green-500 dark:text-green-700 hover:text-green-600 dark:hover:text-green-600',
            'emerald' => 'text-emerald-500 dark:text-emerald-700 hover:text-emerald-600 dark:hover:text-emerald-600',
            'teal' => 'text-teal-500 dark:text-teal-700 hover:text-teal-600 dark:hover:text-teal-600',
            'cyan' => 'text-cyan-500 dark:text-cyan-700 hover:text-cyan-600 dark:hover:text-cyan-600',
            'sky' => 'text-sky-500 dark:text-sky-700 hover:text-sky-600 dark:hover:text-sky-600',
            'blue' => 'text-blue-500 dark:text-blue-700 hover:text-blue-600 dark:hover:text-blue-600',
            'indigo' => 'text-indigo-500 dark:text-indigo-700 hover:text-indigo-600 dark:hover:text-indigo-600',
            'violet' => 'text-violet-500 dark:text-violet-700 hover:text-violet-600 dark:hover:text-violet-600',
            'purple' => 'text-purple-500 dark:text-purple-700 hover:text-purple-600 dark:hover:text-purple-600',
            'fuchsia' => 'text-fuchsia-500 dark:text-fuchsia-700 hover:text-fuchsia-600 dark:hover:text-fuchsia-600',
            'pink' => 'text-pink-500 dark:text-pink-700 hover:text-pink-600 dark:hover:text-pink-600',
            'rose' => 'text-rose-500 dark:text-rose-700 hover:text-rose-600 dark:hover:text-rose-600',
        ];
    }
}
