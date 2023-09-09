<?php

namespace WireUi\WireUi\Link;

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
            'primary'   => 'text-primary-600 hover:text-primary-700 dark:hover:text-primary-500',
            'secondary' => 'text-secondary-600 dark:text-secondary-400 hover:text-secondary-700 dark:hover:text-secondary-300/90',
            'positive'  => 'text-positive-600 dark:text-positive-500/90 hover:text-positive-700 dark:hover:text-positive-500',
            'negative'  => 'text-negative-600 hover:text-negative-700 dark:hover:text-negative-500',
            'warning'   => 'text-warning-600 hover:text-warning-700 dark:hover:text-warning-500',
            'info'      => 'text-info-600 hover:text-info-700 dark:hover:text-info-500',
            'slate'     => 'text-slate-600 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300',
            'gray'      => 'text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300',
            'zinc'      => 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-300',
            'neutral'   => 'text-neutral-600 dark:text-neutral-400 hover:text-neutral-700 dark:hover:text-neutral-300',
            'stone'     => 'text-stone-600 dark:text-stone-400 hover:text-stone-700 dark:hover:text-stone-300',
            'red'       => 'text-red-600 hover:text-red-700 dark:hover:text-red-500',
            'orange'    => 'text-orange-600 hover:text-orange-700 dark:hover:text-orange-500',
            'amber'     => 'text-amber-600 hover:text-amber-700 dark:hover:text-amber-500',
            'yellow'    => 'text-yellow-600 hover:text-yellow-700 dark:hover:text-yellow-500',
            'lime'      => 'text-lime-600 hover:text-lime-700 dark:hover:text-lime-500',
            'green'     => 'text-green-600 hover:text-green-700 dark:hover:text-green-500',
            'emerald'   => 'text-emerald-600 dark:text-emerald-500/90 hover:text-emerald-700 dark:hover:text-emerald-500',
            'teal'      => 'text-teal-600 dark:text-teal-500/90 hover:text-teal-700 dark:hover:text-teal-500',
            'cyan'      => 'text-cyan-600 hover:text-cyan-700 dark:hover:text-cyan-500',
            'sky'       => 'text-sky-600 hover:text-sky-700 dark:hover:text-sky-500',
            'blue'      => 'text-blue-600 hover:text-blue-700 dark:hover:text-blue-500',
            'indigo'    => 'text-indigo-600 hover:text-indigo-700 dark:hover:text-indigo-500',
            'violet'    => 'text-violet-600 hover:text-violet-700 dark:hover:text-violet-500',
            'purple'    => 'text-purple-600 hover:text-purple-700 dark:hover:text-purple-500',
            'fuchsia'   => 'text-fuchsia-600 hover:text-fuchsia-700 dark:hover:text-fuchsia-500',
            'pink'      => 'text-pink-600 hover:text-pink-700 dark:hover:text-pink-500',
            'rose'      => 'text-rose-500 hover:text-rose-700 dark:hover:text-rose-500',
        ];
    }
}
