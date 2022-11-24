<?php

namespace WireUi\Support\Buttons\Colors;

class Flat extends ColorPack
{
    protected string $hover = 'dark:hover:bg-slate-700';

    protected string $focus = 'dark:focus:bg-slate-700 dark:focus:ring-offset-slate-800';

    public function default(): Color
    {
        return new Color(
            base: 'text-slate-500 dark:text-slate-400',
            hover: "{$this->hover} hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100",
            focus: [
                "{$this->focus} focus:text-slate-500 dark:focus:text-slate-400 focus:bg-slate-100",
                'focus:ring-slate-200 dark:focus:ring-slate-600',
            ],
        );
    }

    public function all(): array
    {
        return [
            'primary' => new Color(
                base: 'text-primary-600',
                hover: "{$this->hover} hover:text-primary-600 hover:bg-primary-100",
                focus: "{$this->focus} focus:text-primary-600 focus:bg-primary-100 focus:ring-primary-600 dark:focus:ring-primary-700",
            ),
            'secondary' => new Color(
                base: 'text-secondary-600 dark:text-secondary-400',
                hover: "{$this->hover} hover:text-secondary-600 dark:hover:text-secondary-400 hover:bg-secondary-100",
                focus: [
                    "{$this->focus} focus:text-secondary-600 dark:focus:text-secondary-400 focus:bg-secondary-100",
                    'focus:ring-secondary-600 dark:focus:ring-secondary-700',
                ],
            ),
            'positive' => new Color(
                base: 'text-positive-600',
                hover: "{$this->hover} hover:text-positive-600 hover:bg-positive-100",
                focus: "{$this->focus} focus:text-positive-600 focus:bg-positive-100 focus:ring-positive-500 dark:focus:ring-positive-700",
            ),
            'negative' => new Color(
                base: 'text-negative-600',
                hover: "{$this->hover} hover:text-negative-600 hover:bg-negative-100",
                focus: "{$this->focus} focus:text-negative-600 focus:bg-negative-100 focus:ring-negative-600 dark:focus:ring-negative-700",
            ),
            'warning' => new Color(
                base: 'text-warning-600',
                hover: "{$this->hover} hover:text-warning-600 hover:bg-warning-100",
                focus: "{$this->focus} focus:text-warning-600 focus:bg-warning-100 focus:ring-warning-500 dark:focus:ring-warning-700",
            ),
            'info' => new Color(
                base: 'text-info-600',
                hover: "{$this->hover} hover:text-info-600 hover:bg-info-100",
                focus: "{$this->focus} focus:text-info-600 focus:bg-info-100 focus:ring-info-600 dark:focus:ring-info-700",
            ),
            'dark' => new Color(
                base: 'text-slate-900 dark:text-slate-400',
                hover: "{$this->hover} hover:text-slate-900 dark:hover:text-slate-400 hover:bg-slate-200",
                focus: [
                    "{$this->focus} focus:bg-slate-200 focus:ring-slate-600 dark:focus:ring-dark-700",
                    'focus:text-slate-900 dark:focus:text-slate-400',
                ],
            ),
            'white' => new Color(
                base: 'text-white dark:text-slate-300',
                hover: "{$this->hover} hover:text-slate-500 dark:hover:text-slate-300 hover:bg-slate-100",
                focus: [
                    "{$this->focus} focus:bg-slate-100 focus:ring-slate-200 dark:focus:ring-slate-600",
                    'focus:text-slate-500 dark:focus:text-slate-300',
                ],
            ),
            'black' => new Color(
                base: 'text-black dark:text-slate-300',
                hover: "{$this->hover} hover:text-black dark:hover:text-slate-300 hover:bg-slate-100",
                focus: [
                    "{$this->focus} focus:bg-slate-100 focus:ring-black dark:focus:ring-slate-600",
                    'focus:text-black dark:focus:text-slate-300',
                ],
            ),
            'slate' => new Color(
                base: 'text-slate-600 dark:text-slate-400',
                hover: "{$this->hover} hover:text-slate-600 dark:hover:text-slate-400 hover:bg-slate-100",
                focus: [
                    "{$this->focus} focus:bg-slate-100 focus:ring-slate-500 dark:focus:ring-slate-700",
                    'focus:text-slate-600 dark:focus:text-slate-400',
                ],
            ),
            'gray' => new Color(
                base: 'text-gray-600 dark:text-gray-400',
                hover: "{$this->hover} hover:text-gray-600 dark:hover:text-gray-400 hover:bg-gray-100",
                focus: [
                    "{$this->focus} focus:bg-gray-100 focus:ring-gray-500 dark:focus:ring-gray-600",
                    'focus:text-gray-600 dark:focus:text-gray-400',
                ],
            ),
            'zinc' => new Color(
                base: 'text-zinc-600 dark:text-zinc-400',
                hover: "{$this->hover} hover:text-zinc-600 dark:hover:text-zinc-400 hover:bg-zinc-100",
                focus: [
                    "{$this->focus} focus:bg-zinc-100 focus:ring-zinc-500 dark:focus:ring-zinc-600",
                    'focus:text-zinc-600 dark:focus:text-zinc-400',
                ],
            ),
            'neutral' => new Color(
                base: 'text-neutral-600 dark:text-neutral-400',
                hover: "{$this->hover} hover:text-neutral-600 dark:hover:text-neutral-400 hover:bg-neutral-100",
                focus: [
                    "{$this->focus} focus:bg-neutral-100 focus:ring-neutral-500 dark:focus:ring-neutral-600",
                    'focus:text-neutral-600 dark:focus:text-neutral-400',
                ],
            ),
            'stone' => new Color(
                base: 'text-stone-600 dark:text-stone-400',
                hover: "{$this->hover} hover:text-stone-600 dark:hover:text-stone-400 hover:bg-stone-100",
                focus: [
                    "{$this->focus} focus:bg-stone-100 focus:ring-stone-500 dark:focus:ring-stone-600",
                    'focus:text-stone-600 dark:focus:text-stone-400',
                ],
            ),
            'red' => new Color(
                base: 'text-red-600',
                hover: "{$this->hover} hover:text-red-600 hover:bg-red-100",
                focus: "{$this->focus} focus:text-red-600 focus:bg-red-100 focus:ring-red-600 dark:focus:ring-red-700",
            ),
            'orange' => new Color(
                base: 'text-orange-600',
                hover: "{$this->hover} hover:text-orange-600 hover:bg-orange-100",
                focus: "{$this->focus} focus:text-orange-600 focus:bg-orange-100 focus:ring-orange-600 dark:focus:ring-orange-700",
            ),
            'amber' => new Color(
                base: 'text-amber-600',
                hover: "{$this->hover} hover:text-amber-600 hover:bg-amber-100",
                focus: "{$this->focus} focus:text-amber-600 focus:bg-amber-100 focus:ring-amber-500 dark:focus:ring-amber-700",
            ),
            'lime' => new Color(
                base: 'text-lime-600',
                hover: "{$this->hover} hover:text-lime-600 hover:bg-lime-100",
                focus: "{$this->focus} focus:text-lime-600 focus:bg-lime-100 focus:ring-lime-600 dark:focus:ring-lime-700",
            ),
            'green' => new Color(
                base: 'text-green-600',
                hover: "{$this->hover} hover:text-green-600 hover:bg-green-100",
                focus: "{$this->focus} focus:text-green-600 focus:bg-green-100 focus:ring-green-600 dark:focus:ring-green-700",
            ),
            'emerald' => new Color(
                base: 'text-emerald-600',
                hover: "{$this->hover} hover:text-emerald-600 hover:bg-emerald-100",
                focus: "{$this->focus} focus:text-emerald-600 focus:bg-emerald-100 focus:ring-emerald-600 dark:focus:ring-emerald-700",
            ),
            'teal' => new Color(
                base: 'text-teal-600',
                hover: "{$this->hover} hover:text-teal-600 hover:bg-teal-100",
                focus: "{$this->focus} focus:text-teal-600 focus:bg-teal-100 focus:ring-teal-600 dark:focus:ring-teal-700",
            ),
            'cyan' => new Color(
                base: 'text-cyan-600',
                hover: "{$this->hover} hover:text-cyan-600 hover:bg-cyan-100",
                focus: "{$this->focus} focus:text-cyan-600 focus:bg-cyan-100 focus:ring-cyan-600 dark:focus:ring-cyan-700",
            ),
            'sky' => new Color(
                base: 'text-sky-600',
                hover: "{$this->hover} hover:text-sky-600 hover:bg-sky-100",
                focus: "{$this->focus} focus:text-sky-600 focus:bg-sky-100 focus:ring-sky-600 dark:focus:ring-sky-700",
            ),
            'blue' => new Color(
                base: 'text-blue-600',
                hover: "{$this->hover} hover:text-blue-600 hover:bg-blue-100",
                focus: "{$this->focus} focus:text-blue-600 focus:bg-blue-100 focus:ring-blue-600 dark:focus:ring-blue-700",
            ),
            'indigo' => new Color(
                base: 'text-indigo-600',
                hover: "{$this->hover} hover:text-indigo-600 hover:bg-indigo-100",
                focus: "{$this->focus} focus:text-indigo-600 focus:bg-indigo-100 focus:ring-indigo-600 dark:focus:ring-indigo-700",
            ),
            'violet' => new Color(
                base: 'text-violet-600',
                hover: "{$this->hover} hover:text-violet-600 hover:bg-violet-100",
                focus: "{$this->focus} focus:text-violet-600 focus:bg-violet-100 focus:ring-violet-600 dark:focus:ring-violet-700",
            ),
            'purple' => new Color(
                base: 'text-purple-600',
                hover: "{$this->hover} hover:text-purple-600 hover:bg-purple-100",
                focus: "{$this->focus} focus:text-purple-600 focus:bg-purple-100 focus:ring-purple-600 dark:focus:ring-purple-700",
            ),
            'fuchsia' => new Color(
                base: 'text-fuchsia-600',
                hover: "{$this->hover} hover:text-fuchsia-600 hover:bg-fuchsia-100",
                focus: "{$this->focus} focus:text-fuchsia-600 focus:bg-fuchsia-100 focus:ring-fuchsia-600 dark:focus:ring-fuchsia-700",
            ),
            'pink' => new Color(
                base: 'text-pink-600',
                hover: "{$this->hover} hover:text-pink-600 hover:bg-pink-100",
                focus: "{$this->focus} focus:text-pink-600 focus:bg-pink-100 focus:ring-pink-600 dark:focus:ring-pink-700",
            ),
            'rose' => new Color(
                base: 'text-rose-600',
                hover: "{$this->hover} hover:text-rose-600 hover:bg-rose-100",
                focus: "{$this->focus} focus:text-rose-600 focus:bg-rose-100 focus:ring-rose-600 dark:focus:ring-rose-700",
            ),
        ];
    }
}
