<?php

namespace WireUi\View\Components;

class Button extends BaseButton
{
    public function outlineColors(): array
    {
        return [
            self::DEFAULT => <<<EOT
                border text-slate-500 hover:bg-slate-100 ring-slate-200 dark:ring-slate-600 dark:border-slate-500
                dark:ring-offset-slate-800 dark:text-slate-400 dark:hover:bg-slate-700
            EOT,

            'primary' => <<<EOT
                ring-primary-500 text-primary-500 border border-primary-500 hover:bg-primary-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'secondary' => <<<EOT
                ring-secondary-600 text-secondary-600 border border-secondary-600 hover:bg-secondary-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:border-secondary-400 dark:text-secondary-400
            EOT,

            'positive' => <<<EOT
                ring-positive-500 text-positive-500 border border-positive-500 hover:bg-positive-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'negative' => <<<EOT
                ring-negative-500 text-negative-500 border border-negative-500 hover:bg-negative-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'warning' => <<<EOT
                ring-warning-600 text-warning-600 border border-warning-600 hover:bg-warning-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'info' => <<<EOT
                ring-info-600 text-info-600 border border-info-600 hover:bg-info-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'dark' => <<<EOT
                ring-slate-600 text-slate-600 border border-slate-600 hover:bg-slate-200
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:text-slate-400
                dark:border-slate-400
            EOT,

            'white' => <<<EOT
                border border-white text-white hover:bg-slate-100 ring-slate-200 dark:text-slate-200
                dark:ring-slate-600 dark:border-slate-400 dark:hover:bg-slate-700 dark:ring-offset-slate-800
            EOT,

            'black' => <<<EOT
                border border-black text-black hover:bg-slate-100 ring-black dark:text-slate-200
                dark:ring-slate-600 dark:border-slate-400 dark:hover:bg-slate-700 dark:ring-offset-slate-800
            EOT,

            'slate' => <<<EOT
                ring-slate-600 text-slate-600 border border-slate-600 hover:bg-slate-100
                dark:ring-offset-slate-800 dark:text-slate-400 dark:border-slate-400 dark:hover:bg-slate-700
            EOT,

            'gray' => <<<EOT
                ring-gray-500 text-gray-500 border border-gray-500 hover:bg-gray-100
                dark:ring-offset-slate-800 dark:text-gray-400 dark:border-gray-400 dark:hover:bg-slate-700
            EOT,

            'zinc' => <<<EOT
                ring-zinc-500 text-zinc-500 border border-zinc-500 hover:bg-zinc-100
                dark:ring-offset-slate-800 dark:text-zinc-400 dark:border-zinc-400 dark:hover:bg-slate-700
            EOT,

            'neutral' => <<<EOT
                ring-neutral-500 text-neutral-500 border border-neutral-500 hover:bg-neutral-100
                dark:ring-offset-slate-800 dark:text-neutral-400 dark:border-neutral-400 dark:hover:bg-slate-700
            EOT,

            'stone' => <<<EOT
                ring-stone-500 text-stone-500 border border-stone-500 hover:bg-stone-100
                dark:ring-offset-slate-800 dark:text-stone-400 dark:border-stone-400 dark:hover:bg-slate-700
            EOT,

            'red' => <<<EOT
                ring-red-500 text-red-500 border border-red-500 hover:bg-red-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'orange' => <<<EOT
                ring-orange-500 text-orange-500 border border-orange-500 hover:bg-orange-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'amber' => <<<EOT
                ring-amber-600 text-amber-600 border border-amber-600 hover:bg-amber-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'lime' => <<<EOT
                ring-lime-500 text-lime-500 border border-lime-500 hover:bg-lime-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'green' => <<<EOT
                ring-green-500 text-green-500 border border-green-500 hover:bg-green-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'emerald' => <<<EOT
                ring-emerald-500 text-emerald-500 border border-emerald-500 hover:bg-emerald-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'teal' => <<<EOT
                ring-teal-500 text-teal-500 border border-teal-500 hover:bg-teal-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'cyan' => <<<EOT
                ring-cyan-500 text-cyan-500 border border-cyan-500 hover:bg-cyan-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'sky' => <<<EOT
                ring-sky-500 text-sky-500 border border-sky-500 hover:bg-sky-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'blue' => <<<EOT
                ring-blue-500 text-blue-500 border border-blue-500 hover:bg-blue-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'indigo' => <<<EOT
                ring-indigo-500 text-indigo-500 border border-indigo-500 hover:bg-indigo-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'violet' => <<<EOT
                ring-violet-500 text-violet-500 border border-violet-500 hover:bg-violet-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'purple' => <<<EOT
                ring-purple-500 text-purple-500 border border-purple-500 hover:bg-purple-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'fuchsia' => <<<EOT
                ring-fuchsia-500 text-fuchsia-500 border border-fuchsia-500 hover:bg-fuchsia-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'pink' => <<<EOT
                ring-pink-500 text-pink-500 border border-pink-500 hover:bg-pink-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,

            'rose' => <<<EOT
                ring-rose-500 text-rose-500 border border-rose-500 hover:bg-rose-50
                dark:ring-offset-slate-800 dark:hover:bg-slate-700
            EOT,
        ];
    }

    public function flatColors(): array
    {
        return [
            self::DEFAULT => <<<EOT
                text-slate-500 hover:bg-slate-100 ring-slate-200 dark:text-slate-400
                dark:hover:bg-slate-700 dark:ring-slate-600 dark:ring-offset-slate-700
            EOT,

            'primary' => <<<EOT
                ring-primary-600 text-primary-600 hover:bg-primary-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-primary-700
            EOT,

            'secondary' => <<<EOT
                ring-secondary-600 text-secondary-600 hover:bg-secondary-100 dark:text-secondary-400
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-secondary-700
            EOT,

            'positive' => <<<EOT
                ring-positive-500 text-positive-600 hover:bg-positive-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-positive-700
            EOT,

            'negative' => <<<EOT
                ring-negative-600 text-negative-600 hover:bg-negative-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-negative-700
            EOT,

            'warning' => <<<EOT
                ring-warning-500 text-warning-600 hover:bg-warning-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-warning-700
            EOT,

            'info' => <<<EOT
                ring-info-600 text-info-600 hover:bg-info-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-info-700
            EOT,

            'dark' => <<<EOT
                ring-slate-600 text-slate-900 hover:bg-slate-200 dark:text-slate-400
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-dark-700
            EOT,

            'white' => <<<EOT
                text-white hover:bg-slate-100 ring-slate-200 dark:text-slate-300
                dark:hover:bg-slate-700 dark:ring-slate-600 dark:ring-offset-slate-800
            EOT,

            'black' => <<<EOT
                text-black hover:bg-slate-100 ring-black dark:text-slate-300
                dark:hover:bg-slate-700 dark:ring-slate-600 dark:ring-offset-slate-800
            EOT,

            'slate' => <<<EOT
                ring-slate-500 text-slate-600 hover:bg-slate-100 dark:text-slate-400
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-slate-700
            EOT,

            'gray' => <<<EOT
                ring-gray-500 text-gray-600 hover:bg-gray-100 dark:text-gray-400
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-gray-600
            EOT,

            'zinc' => <<<EOT
                ring-zinc-500 text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-zinc-600
            EOT,

            'neutral' => <<<EOT
                ring-neutral-500 text-neutral-600 hover:bg-neutral-100 dark:text-neutral-400
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-neutral-600
            EOT,

            'stone' => <<<EOT
                ring-stone-500 text-stone-600 hover:bg-stone-100 dark:text-stone-400
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-stone-600
            EOT,

            'red' => <<<EOT
                ring-red-600 text-red-600 hover:bg-red-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-red-700
            EOT,

            'orange' => <<<EOT
                ring-orange-600 text-orange-600 hover:bg-orange-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-orange-700
            EOT,

            'amber' => <<<EOT
                ring-amber-500 text-amber-600 hover:bg-amber-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-amber-700
            EOT,

            'lime' => <<<EOT
                ring-lime-600 text-lime-600 hover:bg-lime-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-lime-700
            EOT,

            'green' => <<<EOT
                ring-green-600 text-green-600 hover:bg-green-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-green-700
            EOT,

            'emerald' => <<<EOT
                ring-emerald-600 text-emerald-600 hover:bg-emerald-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-emerald-700
            EOT,

            'teal' => <<<EOT
                ring-teal-600 text-teal-600 hover:bg-teal-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-teal-700
            EOT,

            'cyan' => <<<EOT
                ring-cyan-600 text-cyan-600 hover:bg-cyan-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-cyan-700
            EOT,

            'sky' => <<<EOT
                ring-sky-600 text-sky-600 hover:bg-sky-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-sky-700
            EOT,

            'blue' => <<<EOT
                ring-blue-600 text-blue-600 hover:bg-blue-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-blue-700
            EOT,

            'indigo' => <<<EOT
                ring-indigo-600 text-indigo-600 hover:bg-indigo-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-indigo-700
            EOT,

            'violet' => <<<EOT
                ring-violet-600 text-violet-600 hover:bg-violet-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-violet-700
            EOT,

            'purple' => <<<EOT
                ring-purple-600 text-purple-600 hover:bg-purple-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-purple-700
            EOT,

            'fuchsia' => <<<EOT
                ring-fuchsia-600 text-fuchsia-600 hover:bg-fuchsia-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-fuchsia-700
            EOT,

            'pink' => <<<EOT
                ring-pink-600 text-pink-600 hover:bg-pink-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-pink-700
            EOT,

            'rose' => <<<EOT
                ring-rose-600 text-rose-600 hover:bg-rose-100
                dark:ring-offset-slate-800 dark:hover:bg-slate-700 dark:ring-rose-700
            EOT,
        ];
    }

    public function defaultColors(): array
    {
        return [
            self::DEFAULT => <<<EOT
                border text-slate-500 hover:bg-slate-100 ring-slate-200
                dark:ring-slate-600 dark:border-slate-500 dark:hover:bg-slate-700
                dark:ring-offset-slate-800 dark:text-slate-400
            EOT,

            'primary' => <<<EOT
                ring-primary-500 text-white bg-primary-500 hover:bg-primary-600 hover:ring-primary-600
                dark:ring-offset-slate-800 dark:bg-primary-700 dark:ring-primary-700
                dark:hover:bg-primary-600 dark:hover:ring-primary-600
            EOT,

            'secondary' => <<<EOT
                ring-secondary-500 text-white bg-secondary-500 hover:bg-secondary-600 hover:ring-secondary-600
                dark:ring-offset-slate-800 dark:bg-secondary-700 dark:ring-secondary-700
                dark:hover:bg-secondary-600 dark:hover:ring-secondary-600
            EOT,

            'positive' => <<<EOT
                ring-positive-500 text-white bg-positive-500 hover:bg-positive-600 hover:ring-positive-600
                dark:ring-offset-slate-800 dark:bg-positive-700 dark:ring-positive-700
                dark:hover:bg-positive-600 dark:hover:ring-positive-600
            EOT,

            'negative' => <<<EOT
                ring-negative-500 text-white bg-negative-500 hover:bg-negative-600 hover:ring-negative-600
                dark:ring-offset-slate-800 dark:bg-negative-700 dark:ring-negative-700
                dark:hover:bg-negative-600 dark:hover:ring-negative-600
            EOT,

            'warning' => <<<EOT
                ring-warning-500 text-white bg-warning-500 hover:bg-warning-600 hover:ring-warning-600
                dark:ring-offset-slate-800 dark:bg-warning-700 dark:ring-warning-700
                dark:hover:bg-warning-600 dark:hover:ring-warning-600
            EOT,

            'info' => <<<EOT
                ring-info-500 text-white bg-info-500 hover:bg-info-600 hover:ring-info-600
                dark:ring-offset-slate-800 dark:bg-info-700 dark:ring-info-700
                dark:hover:bg-info-600 dark:hover:ring-info-600
            EOT,

            'dark' => <<<EOT
                ring-gray-700 text-white bg-gray-700 hover:bg-gray-900 hover:ring-gray-900
                dark:ring-offset-gray-800 dark:bg-gray-700 dark:ring-gray-700
                dark:hover:bg-gray-600 dark:hover:ring-gray-600
            EOT,

            'white' => <<<EOT
                bg-white border text-slate-500 hover:bg-slate-50 ring-slate-200
                dark:text-slate-200 dark:ring-slate-700 dark:border-slate-700
                dark:bg-slate-700 dark:hover:bg-slate-600 dark:hover:ring-slate-600
                dark:ring-offset-slate-800
            EOT,

            'black' => <<<EOT
                bg-black text-slate-100 hover:bg-slate-900 ring-black
                dark:ring-slate-700 dark:border-slate-700 dark:bg-slate-700 dark:hover:bg-slate-600
                dark:ring-offset-slate-800 dark:hover:ring-slate-600
            EOT,

            'slate' => <<<EOT
                ring-slate-500 text-white bg-slate-500 hover:bg-slate-600 hover:ring-slate-600
                dark:ring-offset-slate-800 dark:bg-slate-700 dark:ring-slate-700
                dark:hover:bg-slate-600 dark:hover:ring-slate-600
            EOT,

            'gray' => <<<EOT
                ring-gray-500 text-white bg-gray-500 hover:bg-gray-600 hover:ring-gray-600
                dark:ring-offset-slate-800 dark:bg-gray-700 dark:ring-gray-700
                dark:hover:bg-gray-600 dark:hover:ring-gray-600
            EOT,

            'zinc' => <<<EOT
                ring-zinc-500 text-white bg-zinc-500 hover:bg-zinc-600 hover:ring-zinc-600
                dark:ring-offset-slate-800 dark:bg-zinc-700 dark:ring-zinc-700
                dark:hover:bg-zinc-600 dark:hover:ring-zinc-600
            EOT,

            'neutral' => <<<EOT
                ring-neutral-500 text-white bg-neutral-500 hover:bg-neutral-600 hover:ring-neutral-600
                dark:ring-offset-slate-800 dark:bg-neutral-700 dark:ring-neutral-700
                dark:hover:bg-neutral-600 dark:hover:ring-neutral-600
            EOT,

            'stone' => <<<EOT
                ring-stone-500 text-white bg-stone-500 hover:bg-stone-600 hover:ring-stone-600
                dark:ring-offset-slate-800 dark:bg-stone-700 dark:ring-stone-700
                dark:hover:bg-stone-600 dark:hover:ring-stone-600
            EOT,

            'red' => <<<EOT
                ring-red-500 text-white bg-red-500 hover:bg-red-600 hover:ring-red-600
                dark:ring-offset-slate-800 dark:bg-red-700 dark:ring-red-700
                dark:hover:bg-red-600 dark:hover:ring-red-600
            EOT,

            'orange' => <<<EOT
                ring-orange-500 text-white bg-orange-500 hover:bg-orange-600 hover:ring-orange-600
                dark:ring-offset-slate-800 dark:bg-orange-700 dark:ring-orange-700
                dark:hover:bg-orange-600 dark:hover:ring-orange-600
            EOT,

            'amber' => <<<EOT
                ring-amber-500 text-white bg-amber-500 hover:bg-amber-600 hover:ring-amber-600
                dark:ring-offset-slate-800 dark:bg-amber-700 dark:ring-amber-700
                dark:hover:bg-amber-600 dark:hover:ring-amber-600
            EOT,

            'lime' => <<<EOT
                ring-lime-500 text-white bg-lime-500 hover:bg-lime-600 hover:ring-lime-600
                dark:ring-offset-slate-800 dark:bg-lime-700 dark:ring-lime-700
                dark:hover:bg-lime-600 dark:hover:ring-lime-600
            EOT,

            'green' => <<<EOT
                ring-green-500 text-white bg-green-500 hover:bg-green-600 hover:ring-green-600
                dark:ring-offset-slate-800 dark:bg-green-700 dark:ring-green-700
                dark:hover:bg-green-600 dark:hover:ring-green-600
            EOT,

            'emerald' => <<<EOT
                ring-emerald-500 text-white bg-emerald-500 hover:bg-emerald-600 hover:ring-emerald-600
                dark:ring-offset-slate-800 dark:bg-emerald-700 dark:ring-emerald-700
                dark:hover:bg-emerald-600 dark:hover:ring-emerald-600
            EOT,

            'teal' => <<<EOT
                ring-teal-500 text-white bg-teal-500 hover:bg-teal-600 hover:ring-teal-600
                dark:ring-offset-slate-800 dark:bg-teal-700 dark:ring-teal-700
                dark:hover:bg-teal-600 dark:hover:ring-teal-600
            EOT,

            'cyan' => <<<EOT
                ring-cyan-500 text-white bg-cyan-500 hover:bg-cyan-600 hover:ring-cyan-600
                dark:ring-offset-slate-800 dark:bg-cyan-700 dark:ring-cyan-700
                dark:hover:bg-cyan-600 dark:hover:ring-cyan-600
            EOT,

            'sky' => <<<EOT
                ring-sky-500 text-white bg-sky-500 hover:bg-sky-600 hover:ring-sky-600
                dark:ring-offset-slate-800 dark:bg-sky-700 dark:ring-sky-700
                dark:hover:bg-sky-600 dark:hover:ring-sky-600
            EOT,

            'blue' => <<<EOT
                ring-blue-500 text-white bg-blue-500 hover:bg-blue-600 hover:ring-blue-600
                dark:ring-offset-slate-800 dark:bg-blue-700 dark:ring-blue-700
                dark:hover:bg-blue-600 dark:hover:ring-blue-600
            EOT,

            'indigo' => <<<EOT
                ring-indigo-500 text-white bg-indigo-500 hover:bg-indigo-600 hover:ring-indigo-600
                dark:ring-offset-slate-800 dark:bg-indigo-700 dark:ring-indigo-700
                dark:hover:bg-indigo-600 dark:hover:ring-indigo-600
            EOT,

            'violet' => <<<EOT
                ring-violet-500 text-white bg-violet-500 hover:bg-violet-600 hover:ring-violet-600
                dark:ring-offset-slate-800 dark:bg-violet-700 dark:ring-violet-700
                dark:hover:bg-violet-600 dark:hover:ring-violet-600
            EOT,

            'purple' => <<<EOT
                ring-purple-500 text-white bg-purple-500 hover:bg-purple-600 hover:ring-purple-600
                dark:ring-offset-slate-800 dark:bg-purple-700 dark:ring-purple-700
                dark:hover:bg-purple-600 dark:hover:ring-purple-600
            EOT,

            'fuchsia' => <<<EOT
                ring-fuchsia-500 text-white bg-fuchsia-500 hover:bg-fuchsia-600 hover:ring-fuchsia-600
                dark:ring-offset-slate-800 dark:bg-fuchsia-700 dark:ring-fuchsia-700
                dark:hover:bg-fuchsia-600 dark:hover:ring-fuchsia-600
            EOT,

            'pink' => <<<EOT
                ring-pink-500 text-white bg-pink-500 hover:bg-pink-600 hover:ring-pink-600
                dark:ring-offset-slate-800 dark:bg-pink-700 dark:ring-pink-700
                dark:hover:bg-pink-600 dark:hover:ring-pink-600
            EOT,

            'rose' => <<<EOT
                ring-rose-500 text-white bg-rose-500 hover:bg-rose-600 hover:ring-rose-600
                dark:ring-offset-slate-800 dark:bg-rose-700 dark:ring-rose-700
                dark:hover:bg-rose-600 dark:hover:ring-rose-600
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
