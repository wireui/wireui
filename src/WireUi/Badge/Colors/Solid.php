<?php

namespace WireUi\WireUi\Badge\Colors;

use WireUi\Support\ComponentPack;

class Solid extends ComponentPack
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
            'base' => 'text-slate-500 border dark:text-slate-400 dark:border-slate-500',
            'primary' => 'text-white bg-primary-500 dark:bg-primary-700',
            'secondary' => 'text-white bg-secondary-500 dark:bg-secondary-700',
            'positive' => 'text-white bg-positive-500 dark:bg-positive-700',
            'negative' => 'text-white bg-negative-500 dark:bg-negative-700',
            'warning' => 'text-white bg-warning-500 dark:bg-warning-700',
            'info' => 'text-white bg-info-500 dark:bg-info-700',
            'dark' => 'text-white bg-gray-700 dark:bg-gray-700',
            'white' => 'text-slate-500 bg-white border dark:text-slate-200 dark:border-slate-700 dark:bg-slate-700',
            'black' => 'text-slate-100 bg-black dark:bg-slate-700 dark:border-slate-700',
            'slate' => 'text-white bg-slate-500 dark:bg-slate-700',
            'gray' => 'text-white bg-gray-500 dark:bg-gray-700',
            'zinc' => 'text-white bg-zinc-500 dark:bg-zinc-700',
            'neutral' => 'text-white bg-neutral-500 dark:bg-neutral-700',
            'stone' => 'text-white bg-stone-500 dark:bg-stone-700',
            'red' => 'text-white bg-red-500 dark:bg-red-700',
            'orange' => 'text-white bg-orange-500 dark:bg-orange-700',
            'amber' => 'text-white bg-amber-500 dark:bg-amber-700',
            'lime' => 'text-white bg-lime-500 dark:bg-lime-700',
            'green' => 'text-white bg-green-500 dark:bg-green-700',
            'emerald' => 'text-white bg-emerald-500 dark:bg-emerald-700',
            'teal' => 'text-white bg-teal-500 dark:bg-teal-700',
            'cyan' => 'text-white bg-cyan-500 dark:bg-cyan-700',
            'sky' => 'text-white bg-sky-500 dark:bg-sky-700',
            'blue' => 'text-white bg-blue-500 dark:bg-blue-700',
            'indigo' => 'text-white bg-indigo-500 dark:bg-indigo-700',
            'violet' => 'text-white bg-violet-500 dark:bg-violet-700',
            'purple' => 'text-white bg-purple-500 dark:bg-purple-700',
            'fuchsia' => 'text-white bg-fuchsia-500 dark:bg-fuchsia-700',
            'pink' => 'text-white bg-pink-500 dark:bg-pink-700',
            'rose' => 'text-white bg-rose-500 dark:bg-rose-700',
        ];
    }
}
