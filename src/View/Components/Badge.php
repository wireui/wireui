<?php

namespace WireUi\View\Components;

class Badge extends BaseBadge
{
    public function outlineColors(): array
    {
        return [
            self::DEFAULT => 'text-slate-500 border dark:text-slate-400 dark:border-slate-500',
            'primary'     => 'text-primary-500 border border-primary-500',
            'secondary'   => 'text-secondary-600 border border-secondary-600 dark:text-secondary-400 dark:border-secondary-400',
            'positive'    => 'text-positive-500 border border-positive-500',
            'negative'    => 'text-negative-500 border border-negative-500',
            'warning'     => 'text-warning-600 border border-warning-600',
            'info'        => 'text-info-600 border border-info-600',
            'dark'        => 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
            'white'       => 'text-white border border-white dark:text-slate-200 dark:border-slate-400',
            'black'       => 'text-black border border-black dark:text-slate-200 dark:border-slate-400',
            'slate'       => 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
            'gray'        => 'text-gray-500 border border-gray-500 dark:text-gray-400 dark:border-gray-400',
            'zinc'        => 'text-zinc-500 border border-zinc-500 dark:text-zinc-400 dark:border-zinc-400',
            'neutral'     => 'text-neutral-500 border border-neutral-500 dark:text-neutral-400 dark:border-neutral-400',
            'stone'       => 'text-stone-500 border border-stone-500 dark:text-stone-400 dark:border-stone-400',
            'red'         => 'text-red-500 border border-red-500',
            'orange'      => 'text-orange-500 border border-orange-500',
            'amber'       => 'text-amber-600 border border-amber-600',
            'lime'        => 'text-lime-500 border border-lime-500 ring-lime-500',
            'green'       => 'text-green-500 border border-green-500 ring-green-500',
            'emerald'     => 'text-emerald-500 border border-emerald-500',
            'teal'        => 'text-teal-500 border border-teal-500 ring-teal-500',
            'cyan'        => 'text-cyan-500 border border-cyan-500 ring-cyan-500',
            'sky'         => 'text-sky-500 border border-sky-500 ring-sky-500',
            'blue'        => 'text-blue-500 border border-blue-500 ring-blue-500',
            'indigo'      => 'text-indigo-500 border border-indigo-500 ring-indigo-500',
            'violet'      => 'text-violet-500 border border-violet-500 ring-violet-500',
            'purple'      => 'text-purple-500 border border-purple-500 ring-purple-500',
            'fuchsia'     => 'text-fuchsia-500 border border-fuchsia-500 ring-fuchsia-500',
            'pink'        => 'text-pink-500 border border-pink-500 ring-pink-500',
            'rose'        => 'text-rose-500 border border-rose-500 ring-rose-500',
        ];
    }

    public function flatColors(): array
    {
        return [
            self::DEFAULT => 'text-slate-500 bg-slate-100 dark:text-slate-400 dark:bg-slate-700',
            'primary'     => 'text-primary-600 bg-primary-100 dark:bg-slate-700',
            'secondary'   => 'text-secondary-600 bg-secondary-100 dark:text-secondary-400 dark:bg-slate-700',
            'positive'    => 'text-positive-600 bg-positive-100 dark:bg-slate-700',
            'negative'    => 'text-negative-600 bg-negative-100 dark:bg-slate-700',
            'warning'     => 'text-warning-600 bg-warning-100 dark:bg-slate-700',
            'info'        => 'text-info-600 bg-info-100 dark:bg-slate-700',
            'dark'        => 'text-slate-900 bg-slate-200 dark:text-slate-400 dark:bg-slate-700',
            'white'       => 'text-slate-500 bg-white dark:text-slate-300 dark:bg-slate-700',
            'black'       => 'text-black bg-slate-100 dark:text-slate-300 dark:bg-slate-700',
            'slate'       => 'text-slate-600 bg-slate-100 dark:text-slate-400 dark:bg-slate-700',
            'gray'        => 'text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-slate-700',
            'zinc'        => 'text-zinc-600 bg-zinc-100 dark:text-zinc-400 dark:bg-slate-700',
            'neutral'     => 'text-neutral-600 bg-neutral-100 dark:text-neutral-400 dark:bg-slate-700',
            'stone'       => 'text-stone-600 bg-stone-100 dark:text-stone-400 dark:bg-slate-700',
            'red'         => 'text-red-600 bg-red-100 dark:bg-slate-700',
            'orange'      => 'text-orange-600 bg-orange-100 dark:bg-slate-700',
            'amber'       => 'text-amber-600 bg-amber-100 dark:bg-slate-700',
            'lime'        => 'text-lime-600 bg-lime-100 dark:bg-slate-700',
            'green'       => 'text-green-600 bg-green-100 dark:bg-slate-700',
            'emerald'     => 'text-emerald-600 bg-emerald-100 dark:bg-slate-700',
            'teal'        => 'text-teal-600 bg-teal-100 dark:bg-slate-700',
            'cyan'        => 'text-cyan-600 bg-cyan-100 dark:bg-slate-700',
            'sky'         => 'text-sky-600 bg-sky-100 dark:bg-slate-700',
            'blue'        => 'text-blue-600 bg-blue-100 dark:bg-slate-700',
            'indigo'      => 'text-indigo-600 bg-indigo-100 dark:bg-slate-700',
            'violet'      => 'text-violet-600 bg-violet-100 dark:bg-slate-700',
            'purple'      => 'text-purple-600 bg-purple-100 dark:bg-slate-700',
            'fuchsia'     => 'text-fuchsia-600 bg-fuchsia-100 dark:bg-slate-700',
            'pink'        => 'text-pink-600 bg-pink-100 dark:bg-slate-700',
            'rose'        => 'text-rose-600 bg-rose-100 dark:bg-slate-700',
        ];
    }

    public function defaultColors(): array
    {
        return [
            self::DEFAULT => 'text-slate-500 border dark:text-slate-400 dark:border-slate-500',
            'primary'     => 'text-white bg-primary-500 dark:bg-primary-700',
            'secondary'   => 'text-white bg-secondary-500 dark:bg-secondary-700',
            'positive'    => 'text-white bg-positive-500 dark:bg-positive-700',
            'negative'    => 'text-white bg-negative-500 dark:bg-negative-700',
            'warning'     => 'text-white bg-warning-500 dark:bg-warning-700',
            'info'        => 'text-white bg-info-500 dark:bg-info-700',
            'dark'        => 'text-white bg-gray-700 dark:bg-gray-700',
            'white'       => 'text-slate-500 bg-white border dark:text-slate-200 dark:border-slate-700 dark:bg-slate-700',
            'black'       => 'text-slate-100 bg-black dark:bg-slate-700 dark:border-slate-700',
            'slate'       => 'text-white bg-slate-500 dark:bg-slate-700',
            'gray'        => 'text-white bg-gray-500 dark:bg-gray-700',
            'zinc'        => 'text-white bg-zinc-500 dark:bg-zinc-700',
            'neutral'     => 'text-white bg-neutral-500 dark:bg-neutral-700',
            'stone'       => 'text-white bg-stone-500 dark:bg-stone-700',
            'red'         => 'text-white bg-red-500 dark:bg-red-700',
            'orange'      => 'text-white bg-orange-500 dark:bg-orange-700',
            'amber'       => 'text-white bg-amber-500 dark:bg-amber-700',
            'lime'        => 'text-white bg-lime-500 dark:bg-lime-700',
            'green'       => 'text-white bg-green-500 dark:bg-green-700',
            'emerald'     => 'text-white bg-emerald-500 dark:bg-emerald-700',
            'teal'        => 'text-white bg-teal-500 dark:bg-teal-700',
            'cyan'        => 'text-white bg-cyan-500 dark:bg-cyan-700',
            'sky'         => 'text-white bg-sky-500 dark:bg-sky-700',
            'blue'        => 'text-white bg-blue-500 dark:bg-blue-700',
            'indigo'      => 'text-white bg-indigo-500 dark:bg-indigo-700',
            'violet'      => 'text-white bg-violet-500 dark:bg-violet-700',
            'purple'      => 'text-white bg-purple-500 dark:bg-purple-700',
            'fuchsia'     => 'text-white bg-fuchsia-500 dark:bg-fuchsia-700',
            'pink'        => 'text-white bg-pink-500 dark:bg-pink-700',
            'rose'        => 'text-white bg-rose-500 dark:bg-rose-700',
        ];
    }

    public function sizes(): array
    {
        return [
            self::DEFAULT => 'gap-x-1 text-xs font-semibold px-2.5 py-0.5',
            'md'          => 'gap-x-1 text-sm font-semibold px-2.5 py-0.5',
            'lg'          => 'gap-x-1 text-base font-semibold px-2.5 py-0.5',
        ];
    }

    public function iconSizes(): array
    {
        return [
            self::DEFAULT => 'w-3 h-3',
            'md'          => 'w-4 h-4',
            'lg'          => 'w-5 h-5',
        ];
    }
}
