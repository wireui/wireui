<?php

namespace WireUi\WireUi\Badge\Colors;

use WireUi\Support\ComponentPack;

class Flat extends ComponentPack
{
    /**
     * Get the default option.
     */
    public function default(): string
    {
        return 'base';
    }

    /**
     * Get the available options.
     */
    public function all(): array
    {
        return [
            'base' => 'text-slate-500 bg-slate-100 dark:text-slate-400 dark:bg-slate-700',
            'primary' => 'text-primary-600 bg-primary-100 dark:bg-slate-700',
            'secondary' => 'text-secondary-600 bg-secondary-100 dark:text-secondary-400 dark:bg-slate-700',
            'positive' => 'text-positive-600 bg-positive-100 dark:bg-slate-700',
            'negative' => 'text-negative-600 bg-negative-100 dark:bg-slate-700',
            'warning' => 'text-warning-600 bg-warning-100 dark:bg-slate-700',
            'info' => 'text-info-600 bg-info-100 dark:bg-slate-700',
            'dark' => 'text-slate-900 bg-slate-200 dark:text-slate-400 dark:bg-slate-700',
            'white' => 'text-slate-500 bg-white dark:text-slate-300 dark:bg-slate-700',
            'black' => 'text-black bg-slate-100 dark:text-slate-300 dark:bg-slate-700',
            'slate' => 'text-slate-600 bg-slate-100 dark:text-slate-400 dark:bg-slate-700',
            'gray' => 'text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-slate-700',
            'zinc' => 'text-zinc-600 bg-zinc-100 dark:text-zinc-400 dark:bg-slate-700',
            'neutral' => 'text-neutral-600 bg-neutral-100 dark:text-neutral-400 dark:bg-slate-700',
            'stone' => 'text-stone-600 bg-stone-100 dark:text-stone-400 dark:bg-slate-700',
            'red' => 'text-red-600 bg-red-100 dark:bg-slate-700',
            'orange' => 'text-orange-600 bg-orange-100 dark:bg-slate-700',
            'amber' => 'text-amber-600 bg-amber-100 dark:bg-slate-700',
            'lime' => 'text-lime-600 bg-lime-100 dark:bg-slate-700',
            'green' => 'text-green-600 bg-green-100 dark:bg-slate-700',
            'emerald' => 'text-emerald-600 bg-emerald-100 dark:bg-slate-700',
            'teal' => 'text-teal-600 bg-teal-100 dark:bg-slate-700',
            'cyan' => 'text-cyan-600 bg-cyan-100 dark:bg-slate-700',
            'sky' => 'text-sky-600 bg-sky-100 dark:bg-slate-700',
            'blue' => 'text-blue-600 bg-blue-100 dark:bg-slate-700',
            'indigo' => 'text-indigo-600 bg-indigo-100 dark:bg-slate-700',
            'violet' => 'text-violet-600 bg-violet-100 dark:bg-slate-700',
            'purple' => 'text-purple-600 bg-purple-100 dark:bg-slate-700',
            'fuchsia' => 'text-fuchsia-600 bg-fuchsia-100 dark:bg-slate-700',
            'pink' => 'text-pink-600 bg-pink-100 dark:bg-slate-700',
            'rose' => 'text-rose-600 bg-rose-100 dark:bg-slate-700',
        ];
    }
}
