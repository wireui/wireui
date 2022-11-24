<?php

namespace WireUi\Support\Buttons\Colors;

class Outline extends ColorPack
{
    private string $hover = 'dark:hover:bg-slate-700';

    private string $focus = 'focus:border-transparent dark:focus:border-transparent dark:focus:bg-slate-700 dark:focus:ring-offset-slate-800';

    public function default(): Color
    {
        return new Color(
            base: 'border text-slate-500 dark:border-slate-500 dark:text-slate-400',
            hover: [
                "{$this->hover} hover:text-slate-500 dark:hover:text-slate-400 hover:border-slate-200",
                'dark:hover:border-slate-600 hover:bg-slate-100',
            ],
            focus: [
                "{$this->focus} focus:text-slate-500 dark:focus:text-slate-400 focus:ring-slate-200",
                'dark:focus:ring-slate-600 focus:bg-slate-100',
            ],
        );
    }

    public function all(): array
    {
        return [
            'primary' => new Color(
                base: 'text-primary-500 border border-primary-500',
                hover: "{$this->hover} hover:text-primary-500 hover:border-primary-500 hover:bg-primary-50",
                focus: "{$this->focus} focus:text-primary-500 focus:ring-primary-500 focus:bg-primary-50"
            ),
            'secondary' => new Color(
                base: 'text-secondary-600 border border-secondary-600 dark:text-secondary-400 dark:border-secondary-400',
                hover: "{$this->hover} hover:text-secondary-600 dark:hover:text-secondary-400 hover:border-secondary-600 hover:bg-secondary-100",
                focus: "{$this->focus} focus:text-secondary-600 dark:focus:text-secondary-400 focus:ring-secondary-600 focus:bg-secondary-100",
            ),
            'positive' => new Color(
                base: 'text-positive-500 border border-positive-500',
                hover: "{$this->hover} hover:text-positive-500 hover:border-positive-500 hover:bg-positive-50",
                focus: "{$this->focus} focus:text-positive-500 focus:ring-positive-500 focus:bg-positive-50",
            ),
            'negative' => new Color(
                base: 'text-negative-500 border border-negative-500',
                hover: "{$this->hover} hover:text-negative-500 hover:border-negative-500 hover:bg-negative-50",
                focus: "{$this->focus} focus:text-negative-500 focus:ring-negative-500 focus:bg-negative-50",
            ),
            'warning' => new Color(
                base: 'text-warning-600 border border-warning-600',
                hover: "{$this->hover} hover:text-warning-500 hover:border-warning-600 hover:bg-warning-50",
                focus: "{$this->focus} focus:text-warning-500 focus:ring-warning-600 focus:bg-warning-50",
            ),
            'info' => new Color(
                base: 'text-info-600 border border-info-600',
                hover: "{$this->hover} hover:text-info-500 hover:border-info-600 hover:bg-info-50",
                focus: "{$this->focus} focus:text-info-500 focus:ring-info-600 focus:bg-info-50",
            ),
            'dark' => new Color(
                base: 'text-slate-600 border border-slate-600 dark:border-slate-400 dark:text-slate-400',
                hover: "{$this->hover} hover:text-slate-600 dark:hover:text-slate-400 hover:border-slate-600 hover:bg-slate-200",
                focus: "{$this->focus} focus:text-slate-600 dark:focus:text-slate-400 focus:ring-slate-600 focus:bg-slate-200",
            ),
            'white' => new Color(
                base: 'text-white border border-white dark:text-slate-200 dark:border-slate-400',
                hover: "{$this->hover} hover:text-slate-500 dark:hover:text-slate-200 hover:border-white dark:hover:border-slate-600 hover:bg-slate-50",
                focus: "{$this->focus} focus:text-slate-500 dark:focus:text-slate-200 focus:ring-white dark:focus:ring-slate-600 focus:bg-slate-50",
            ),
            'black' => new Color(
                base: 'border border-black text-black dark:border-slate-400 dark:text-slate-200',
                hover: "{$this->hover} hover:text-black dark:hover:text-slate-200 hover:border-black dark:hover:border-slate-600 hover:bg-slate-100",
                focus: "{$this->focus} focus:text-black dark:focus:text-slate-200 focus:ring-black dark:focus:ring-slate-600 focus:bg-slate-100",
            ),
            'slate' => new Color(
                base: 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
                hover: "{$this->hover} hover:text-slate-600 dark:hover:text-slate-400 hover:border-slate-600 hover:bg-slate-100",
                focus: "{$this->focus} focus:text-slate-600 dark:focus:text-slate-400 focus:ring-slate-600 focus:bg-slate-100",
            ),
            'gray' => new Color(
                base: 'text-gray-500 border border-gray-500 dark:text-gray-400 dark:border-gray-400',
                hover: "{$this->hover} hover:text-gray-500 dark:hover:text-gray-400 hover:border-gray-500 hover:bg-gray-100",
                focus: "{$this->focus} focus:text-gray-500 dark:focus:text-gray-400 focus:ring-gray-500 focus:bg-gray-100",
            ),
            'zinc' => new Color(
                base: 'text-zinc-500 border border-zinc-500 dark:text-zinc-400 dark:border-zinc-400',
                hover: "{$this->hover} hover:text-zinc-500 dark:hover:text-zinc-400 hover:border-zinc-500 hover:bg-zinc-100",
                focus: "{$this->focus} focus:text-zinc-500 dark:focus:text-zinc-400 focus:ring-zinc-500 focus:bg-zinc-100",
            ),
            'neutral' => new Color(
                base: 'text-neutral-500 border border-neutral-500 dark:text-neutral-400 dark:border-neutral-400',
                hover: "{$this->hover} hover:text-neutral-500 dark:hover:text-neutral-400 hover:border-neutral-500 hover:bg-neutral-100",
                focus: "{$this->focus} focus:text-neutral-500 dark:focus:text-neutral-400 focus:ring-neutral-500 focus:bg-neutral-100",
            ),
            'stone' => new Color(
                base: 'text-stone-500 border border-stone-500 dark:text-stone-400 dark:border-stone-400',
                hover: "{$this->hover} hover:text-stone-500 dark:hover:text-stone-400 hover:border-stone-500 hover:bg-stone-100",
                focus: "{$this->focus} focus:text-stone-500 dark:focus:text-stone-400 focus:ring-stone-500 focus:bg-stone-100",
            ),
            'red' => new Color(
                base: 'text-red-500 border border-red-500 dark:text-red-400 dark:border-red-400',
                hover: "{$this->hover} hover:text-red-500 dark:hover:text-red-400 hover:border-red-500 hover:bg-red-50",
                focus: "{$this->focus} focus:text-red-500 dark:focus:text-red-400 focus:ring-red-500 focus:bg-red-50",
            ),
            'orange' => new Color(
                base: 'text-orange-500 border border-orange-500 dark:text-orange-400 dark:border-orange-400',
                hover: "{$this->hover} hover:text-orange-500 dark:hover:text-orange-400 hover:border-orange-500 hover:bg-orange-50",
                focus: "{$this->focus} focus:text-orange-500 dark:focus:text-orange-400 focus:ring-orange-500 focus:bg-orange-50",
            ),
            'amber' => new Color(
                base: 'text-amber-600 border border-amber-600 dark:text-amber-400 dark:border-amber-400',
                hover: "{$this->hover} hover:text-amber-500 dark:hover:text-amber-400 hover:border-orange-600 hover:bg-amber-50",
                focus: "{$this->focus} focus:text-amber-500 dark:focus:text-amber-400 focus:ring-amber-600 focus:bg-amber-50",
            ),
            'lime' => new Color(
                base: 'text-lime-500 border border-lime-500 dark:text-lime-400 dark:border-lime-400',
                hover: "{$this->hover} hover:text-lime-500 dark:hover:text-lime-400 hover:border-lime-500 hover:bg-lime-50",
                focus: "{$this->focus} focus:text-lime-500 dark:focus:text-lime-400 focus:ring-lime-500 focus:bg-lime-50",
            ),
            'green' => new Color(
                base: 'text-green-500 border border-green-500 dark:text-green-400 dark:border-green-400',
                hover: "{$this->hover} hover:text-green-500 dark:hover:text-green-400 hover:border-green-500 hover:bg-green-50",
                focus: "{$this->focus} focus:text-green-500 dark:focus:text-green-400 focus:ring-green-500 focus:bg-green-50",
            ),
            'emerald' => new Color(
                base: 'text-emerald-500 border border-emerald-500 dark:text-emerald-400 dark:border-emerald-400',
                hover: "{$this->hover} hover:text-emerald-500 dark:hover:text-emerald-400 hover:border-emerald-500 hover:bg-emerald-50",
                focus: "{$this->focus} focus:text-emerald-500 dark:focus:text-emerald-400 focus:ring-emerald-500 focus:bg-emerald-50",
            ),
            'teal' => new Color(
                base: 'text-teal-500 border border-teal-500 dark:text-teal-400 dark:border-teal-400',
                hover: "{$this->hover} hover:text-teal-500 dark:hover:text-teal-400 hover:border-teal-500 hover:bg-teal-50",
                focus: "{$this->focus} focus:text-teal-500 dark:focus:text-teal-400 focus:ring-teal-500 focus:bg-teal-50",
            ),
            'cyan' => new Color(
                base: 'text-cyan-500 border border-cyan-500 dark:text-cyan-400 dark:border-cyan-400',
                hover: "{$this->hover} hover:text-cyan-500 dark:hover:text-cyan-400 hover:border-cyan-500 hover:bg-cyan-50",
                focus: "{$this->focus} focus:text-cyan-500 dark:focus:text-cyan-400 focus:ring-cyan-500 focus:bg-cyan-50",
            ),
            'sky' => new Color(
                base: 'text-sky-500 border border-sky-500 dark:text-sky-400 dark:border-sky-400',
                hover: "{$this->hover} hover:text-sky-500 dark:hover:text-sky-400 hover:border-sky-500 hover:bg-sky-50",
                focus: "{$this->focus} focus:text-sky-500 dark:focus:text-sky-400 focus:ring-sky-500 focus:bg-sky-50",
            ),
            'blue' => new Color(
                base: 'text-blue-500 border border-blue-500 dark:text-blue-400 dark:border-blue-400',
                hover: "{$this->hover} hover:text-blue-500 dark:hover:text-blue-400 hover:border-blue-500 hover:bg-blue-50",
                focus: "{$this->focus} focus:text-blue-500 dark:focus:text-blue-400 focus:ring-blue-500 focus:bg-blue-50",
            ),
            'indigo' => new Color(
                base: 'text-indigo-500 border border-indigo-500 dark:text-indigo-400 dark:border-indigo-400',
                hover: "{$this->hover} hover:text-indigo-500 dark:hover:text-indigo-400 hover:border-indigo-500 hover:bg-indigo-50",
                focus: "{$this->focus} focus:text-indigo-500 dark:focus:text-indigo-400 focus:ring-indigo-500 focus:bg-indigo-50",
            ),
            'violet' => new Color(
                base: 'text-violet-500 border border-violet-500 dark:text-violet-400 dark:border-violet-400',
                hover: "{$this->hover} hover:text-violet-500 dark:hover:text-violet-400 hover:border-violet-500 hover:bg-violet-50",
                focus: "{$this->focus} focus:text-violet-500 dark:focus:text-violet-400 focus:ring-violet-500 focus:bg-violet-50",
            ),
            'purple' => new Color(
                base: 'text-purple-500 border border-purple-500 dark:text-purple-400 dark:border-purple-400',
                hover: "{$this->hover} hover:text-purple-500 dark:hover:text-purple-400 hover:border-purple-500 hover:bg-purple-50",
                focus: "{$this->focus} focus:text-purple-500 dark:focus:text-purple-400 focus:ring-purple-500 focus:bg-purple-50",
            ),
            'fuchsia' => new Color(
                base: 'text-fuchsia-500 border border-fuchsia-500 dark:text-fuchsia-400 dark:border-fuchsia-400',
                hover: "{$this->hover} hover:text-fuchsia-500 dark:hover:text-fuchsia-400 hover:border-fuchsia-500 hover:bg-fuchsia-50",
                focus: "{$this->focus} focus:text-fuchsia-500 dark:focus:text-fuchsia-400 focus:ring-fuchsia-500 focus:bg-fuchsia-50",
            ),
            'pink' => new Color(
                base: 'text-pink-500 border border-pink-500 dark:text-pink-400 dark:border-pink-400',
                hover: "{$this->hover} hover:text-pink-500 dark:hover:text-pink-400 hover:border-pink-500 hover:bg-pink-50",
                focus: "{$this->focus} focus:text-pink-500 dark:focus:text-pink-400 focus:ring-pink-500 focus:bg-pink-50",
            ),
            'rose' => new Color(
                base: 'text-rose-500 border border-rose-500 dark:text-rose-400 dark:border-rose-400',
                hover: "{$this->hover} hover:text-rose-500 dark:hover:text-rose-400 hover:border-rose-500 hover:bg-rose-50",
                focus: "{$this->focus} focus:text-rose-500 dark:focus:text-rose-400 focus:ring-rose-500 focus:bg-rose-50",
            ),
        ];
    }
}
