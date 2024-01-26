<?php

namespace WireUi\Components\Badge\WireUi\Color;

use WireUi\Support\ComponentPack;

class Outline extends ComponentPack
{
    public function default(): string
    {
        return config('wireui.style.color') ?? 'base';
    }

    public function all(): array
    {
        return [
            'base'      => 'text-slate-500 border dark:text-slate-400 dark:border-slate-500',
            'primary'   => 'text-primary-500 border border-primary-500',
            'secondary' => 'text-secondary-600 border border-secondary-600 dark:text-secondary-400 dark:border-secondary-400',
            'positive'  => 'text-positive-500 border border-positive-500',
            'negative'  => 'text-negative-500 border border-negative-500',
            'warning'   => 'text-warning-600 border border-warning-600',
            'info'      => 'text-info-600 border border-info-600',
            'dark'      => 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
            'white'     => 'text-white border border-white dark:text-slate-200 dark:border-slate-400',
            'black'     => 'text-black border border-black dark:text-slate-200 dark:border-slate-400',
            'slate'     => 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
            'gray'      => 'text-gray-500 border border-gray-500 dark:text-gray-400 dark:border-gray-400',
            'zinc'      => 'text-zinc-500 border border-zinc-500 dark:text-zinc-400 dark:border-zinc-400',
            'neutral'   => 'text-neutral-500 border border-neutral-500 dark:text-neutral-400 dark:border-neutral-400',
            'stone'     => 'text-stone-500 border border-stone-500 dark:text-stone-400 dark:border-stone-400',
            'red'       => 'text-red-500 border border-red-500',
            'orange'    => 'text-orange-500 border border-orange-500',
            'amber'     => 'text-amber-600 border border-amber-600',
            'lime'      => 'text-lime-500 border border-lime-500 ring-lime-500',
            'green'     => 'text-green-500 border border-green-500 ring-green-500',
            'emerald'   => 'text-emerald-500 border border-emerald-500',
            'teal'      => 'text-teal-500 border border-teal-500 ring-teal-500',
            'cyan'      => 'text-cyan-500 border border-cyan-500 ring-cyan-500',
            'sky'       => 'text-sky-500 border border-sky-500 ring-sky-500',
            'blue'      => 'text-blue-500 border border-blue-500 ring-blue-500',
            'indigo'    => 'text-indigo-500 border border-indigo-500 ring-indigo-500',
            'violet'    => 'text-violet-500 border border-violet-500 ring-violet-500',
            'purple'    => 'text-purple-500 border border-purple-500 ring-purple-500',
            'fuchsia'   => 'text-fuchsia-500 border border-fuchsia-500 ring-fuchsia-500',
            'pink'      => 'text-pink-500 border border-pink-500 ring-pink-500',
            'rose'      => 'text-rose-500 border border-rose-500 ring-rose-500',
        ];
    }
}
