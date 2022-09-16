<?php

namespace WireUi\View\Components;

class Badge extends BaseBadge
{
    public function outlineColors(): array
    {
        return [
            self::DEFAULT => <<<EOT
                border text-slate-500 dark:border-slate-500 dark:text-slate-400
            EOT,

            'primary' => <<<EOT
                text-primary-500 border border-primary-500
            EOT,

            'secondary' => <<<EOT
                text-secondary-600 border border-secondary-600 dark:border-secondary-400 dark:text-secondary-400
            EOT,

            'positive' => <<<EOT
                text-positive-500 border border-positive-500
            EOT,

            'negative' => <<<EOT
                text-negative-500 border border-negative-500
            EOT,

            'warning' => <<<EOT
                text-warning-600 border border-warning-600
            EOT,

            'info' => <<<EOT
                text-info-600 border border-info-600
            EOT,

            'dark' => <<<EOT
                text-slate-600 border border-slate-600 dark:border-slate-400 dark:text-slate-400
            EOT,

            'white' => <<<EOT
                border border-white text-white dark:text-slate-200 dark:border-slate-400
            EOT,

            'black' => <<<EOT
                border border-black text-black dark:text-slate-200 dark:border-slate-400
            EOT,

            'slate' => <<<EOT
                text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400
            EOT,

            'gray' => <<<EOT
                text-gray-500 border border-gray-500 dark:text-gray-400 dark:border-gray-400
            EOT,

            'zinc' => <<<EOT
                text-zinc-500 border border-zinc-500 dark:text-zinc-400 dark:border-zinc-400
            EOT,

            'neutral' => <<<EOT
                text-neutral-500 border border-neutral-500 dark:text-neutral-400 dark:border-neutral-400
            EOT,

            'stone' => <<<EOT
                text-stone-500 border border-stone-500 dark:text-stone-400 dark:border-stone-400
            EOT,

            'red' => <<<EOT
                text-red-500 border border-red-500
            EOT,

            'orange' => <<<EOT
                text-orange-500 border border-orange-500
            EOT,

            'amber' => <<<EOT
                text-amber-600 border border-amber-600
            EOT,

            'lime' => <<<EOT
                ring-lime-500 text-lime-500 border border-lime-500
            EOT,

            'green' => <<<EOT
                ring-green-500 text-green-500 border border-green-500
            EOT,

            'emerald' => <<<EOT
                text-emerald-500 border border-emerald-500
            EOT,

            'teal' => <<<EOT
                ring-teal-500 text-teal-500 border border-teal-500
            EOT,

            'cyan' => <<<EOT
                ring-cyan-500 text-cyan-500 border border-cyan-500
            EOT,

            'sky' => <<<EOT
                ring-sky-500 text-sky-500 border border-sky-500
            EOT,

            'blue' => <<<EOT
                ring-blue-500 text-blue-500 border border-blue-500
            EOT,

            'indigo' => <<<EOT
                ring-indigo-500 text-indigo-500 border border-indigo-500
            EOT,

            'violet' => <<<EOT
                ring-violet-500 text-violet-500 border border-violet-500
            EOT,

            'purple' => <<<EOT
                ring-purple-500 text-purple-500 border border-purple-500
            EOT,

            'fuchsia' => <<<EOT
                ring-fuchsia-500 text-fuchsia-500 border border-fuchsia-500
            EOT,

            'pink' => <<<EOT
                ring-pink-500 text-pink-500 border border-pink-500
            EOT,

            'rose' => <<<EOT
                ring-rose-500 text-rose-500 border border-rose-500
            EOT,
        ];
    }

    public function flatColors(): array
    {
        return [
            self::DEFAULT => <<<EOT
                text-slate-500 bg-slate-100 dark:text-slate-400 dark:bg-slate-700
            EOT,

            'primary' => <<<EOT
                text-primary-600 bg-primary-100 dark:bg-slate-700
            EOT,

            'secondary' => <<<EOT
                text-secondary-600 bg-secondary-100 dark:text-secondary-400 dark:bg-slate-700
            EOT,

            'positive' => <<<EOT
                text-positive-600 bg-positive-100 dark:bg-slate-700
            EOT,

            'negative' => <<<EOT
                text-negative-600 bg-negative-100 dark:bg-slate-700
            EOT,

            'warning' => <<<EOT
                text-warning-600 bg-warning-100 dark:bg-slate-700
            EOT,

            'info' => <<<EOT
                text-info-600 bg-info-100 dark:bg-slate-700
            EOT,

            'dark' => <<<EOT
                text-slate-900 bg-slate-200 dark:text-slate-400 dark:bg-slate-700
            EOT,

            'white' => <<<EOT
                text-white bg-slate-100 dark:text-slate-300 dark:bg-slate-700
            EOT,

            'black' => <<<EOT
                text-black bg-slate-100 dark:text-slate-300 dark:bg-slate-700
            EOT,

            'slate' => <<<EOT
                text-slate-600 bg-slate-100 dark:text-slate-400 dark:bg-slate-700
            EOT,

            'gray' => <<<EOT
                text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-slate-700
            EOT,

            'zinc' => <<<EOT
                text-zinc-600 bg-zinc-100 dark:text-zinc-400 dark:bg-slate-700
            EOT,

            'neutral' => <<<EOT
                text-neutral-600 bg-neutral-100 dark:text-neutral-400 dark:bg-slate-700
            EOT,

            'stone' => <<<EOT
                text-stone-600 bg-stone-100 dark:text-stone-400 dark:bg-slate-700
            EOT,

            'red' => <<<EOT
                text-red-600 bg-red-100 dark:bg-slate-700
            EOT,

            'orange' => <<<EOT
                text-orange-600 bg-orange-100 dark:bg-slate-700
            EOT,

            'amber' => <<<EOT
                text-amber-600 bg-amber-100 dark:bg-slate-700
            EOT,

            'lime' => <<<EOT
                text-lime-600 bg-lime-100 dark:bg-slate-700
            EOT,

            'green' => <<<EOT
                text-green-600 bg-green-100 dark:bg-slate-700
            EOT,

            'emerald' => <<<EOT
                text-emerald-600 bg-emerald-100 dark:bg-slate-700
            EOT,

            'teal' => <<<EOT
                text-teal-600 bg-teal-100 dark:bg-slate-700
            EOT,

            'cyan' => <<<EOT
                text-cyan-600 bg-cyan-100 dark:bg-slate-700
            EOT,

            'sky' => <<<EOT
                text-sky-600 bg-sky-100 dark:bg-slate-700
            EOT,

            'blue' => <<<EOT
                text-blue-600 bg-blue-100 dark:bg-slate-700
            EOT,

            'indigo' => <<<EOT
                text-indigo-600 bg-indigo-100 dark:bg-slate-700
            EOT,

            'violet' => <<<EOT
                text-violet-600 bg-violet-100 dark:bg-slate-700
            EOT,

            'purple' => <<<EOT
                text-purple-600 bg-purple-100 dark:bg-slate-700
            EOT,

            'fuchsia' => <<<EOT
                text-fuchsia-600 bg-fuchsia-100 dark:bg-slate-700
            EOT,

            'pink' => <<<EOT
                text-pink-600 bg-pink-100 dark:bg-slate-700
            EOT,

            'rose' => <<<EOT
                text-rose-600 bg-rose-100 dark:bg-slate-700
            EOT,
        ];
    }

    public function defaultColors(): array
    {
        return [
            self::DEFAULT => <<<EOT
                border text-slate-500 dark:border-slate-500 dark:text-slate-400
            EOT,

            'primary' => <<<EOT
                text-white bg-primary-500 dark:bg-primary-700
            EOT,

            'secondary' => <<<EOT
                text-white bg-secondary-500 dark:bg-secondary-700
            EOT,

            'positive' => <<<EOT
                text-white bg-positive-500 dark:bg-positive-700
            EOT,

            'negative' => <<<EOT
                text-white bg-negative-500 dark:bg-negative-700
            EOT,

            'warning' => <<<EOT
                text-white bg-warning-500 dark:bg-warning-700
            EOT,

            'info' => <<<EOT
                text-white bg-info-500 dark:bg-info-700
            EOT,

            'dark' => <<<EOT
                text-white bg-gray-700 dark:bg-gray-700
            EOT,

            'white' => <<<EOT
                bg-white border text-slate-500 dark:text-slate-200 dark:border-slate-700 dark:bg-slate-700
            EOT,

            'black' => <<<EOT
                bg-black text-slate-100 dark:border-slate-700 dark:bg-slate-700
            EOT,

            'slate' => <<<EOT
                text-white bg-slate-500 dark:bg-slate-700
            EOT,

            'gray' => <<<EOT
                text-white bg-gray-500 dark:bg-gray-700
            EOT,

            'zinc' => <<<EOT
                text-white bg-zinc-500 dark:bg-zinc-700
            EOT,

            'neutral' => <<<EOT
                text-white bg-neutral-500 dark:bg-neutral-700
            EOT,

            'stone' => <<<EOT
                text-white bg-stone-500 dark:bg-stone-700
            EOT,

            'red' => <<<EOT
                text-white bg-red-500 dark:bg-red-700
            EOT,

            'orange' => <<<EOT
                text-white bg-orange-500 dark:bg-orange-700
            EOT,

            'amber' => <<<EOT
                text-white bg-amber-500 dark:bg-amber-700
            EOT,

            'lime' => <<<EOT
                text-white bg-lime-500 dark:bg-lime-700
            EOT,

            'green' => <<<EOT
                text-white bg-green-500 dark:bg-green-700
            EOT,

            'emerald' => <<<EOT
                text-white bg-emerald-500 dark:bg-emerald-700
            EOT,

            'teal' => <<<EOT
                text-white bg-teal-500 dark:bg-teal-700
            EOT,

            'cyan' => <<<EOT
                text-white bg-cyan-500 dark:bg-cyan-700
            EOT,

            'sky' => <<<EOT
                text-white bg-sky-500 dark:bg-sky-700
            EOT,

            'blue' => <<<EOT
                text-white bg-blue-500 dark:bg-blue-700
            EOT,

            'indigo' => <<<EOT
                text-white bg-indigo-500 dark:bg-indigo-700
            EOT,

            'violet' => <<<EOT
                text-white bg-violet-500 dark:bg-violet-700
            EOT,

            'purple' => <<<EOT
                text-white bg-purple-500 dark:bg-purple-700
            EOT,

            'fuchsia' => <<<EOT
                text-white bg-fuchsia-500 dark:bg-fuchsia-700
            EOT,

            'pink' => <<<EOT
                text-white bg-pink-500 dark:bg-pink-700
            EOT,

            'rose' => <<<EOT
                text-white bg-rose-500 dark:bg-rose-700
            EOT,
        ];
    }

    public function sizes(): array
    {
        return [
            '2xs'         => 'gap-x-0.5 text-2xs px-2 py-0.5',
            'xs'          => 'gap-x-1 text-xs px-2.5 py-1.5',
            'sm'          => 'gap-x-2 text-sm leading-4 px-3 py-2',
            self::DEFAULT => 'gap-x-2 text-sm px-4 py-2',
            'md'          => 'gap-x-2 text-base px-4 py-2',
            'lg'          => 'gap-x-2 text-base px-6 py-3',
            'xl'          => 'gap-x-3 text-base px-7 py-4',
        ];
    }

    public function iconSizes(): array
    {
        return [
            '2xs'         => 'w-2 h-2',
            'xs'          => 'w-3 h-3',
            'sm'          => 'w-3.5 h-3.5',
            self::DEFAULT => 'w-4 h-4',
            'md'          => 'w-4 h-4',
            'lg'          => 'w-5 h-5',
            'xl'          => 'w-6 h-6',
        ];
    }
}
