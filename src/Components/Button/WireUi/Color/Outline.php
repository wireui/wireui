<?php

namespace WireUi\Components\Button\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Outline extends ComponentPack
{
    private string $hover = 'hover:bg-opacity-25 dark:hover:bg-opacity-15';

    private string $focus = 'focus:bg-opacity-25 focus:border-transparent dark:focus:border-transparent dark:focus:bg-opacity-15 focus:ring-offset-0';

    public function default(): string
    {
        return config('wireui.style.color') ?? Color::BASE;
    }

    public function all(): array
    {
        return [
            Color::NONE => [
                'base' => '',
                'hover' => '',
                'focus' => '',
            ],
            Color::BASE => [
                'base' => 'text-slate-500 border border-slate-300 dark:border-slate-500 dark:text-slate-400',
                'hover' => [
                    "{$this->hover} hover:bg-slate-300",
                    'dark:hover:text-slate-300/90 dark:hover:bg-slate-400',
                ],
                'focus' => [
                    "{$this->focus} focus:bg-slate-100 focus:ring-slate-300",
                    'dark:focus:text-slate-300/90 dark:focus:bg-slate-400 dark:focus:ring-slate-600',
                ],
            ],
            Color::INVALIDATED => [
                'base' => 'invalidated:text-negative-600 invalidated:border invalidated:border-negative-600',
                'hover' => [
                    "{$this->hover} invalidated:hover:text-negative-700 invalidated:hover:bg-negative-400",
                    'invalidated:dark:hover:text-negative-500 invalidated:dark:hover:bg-negative-600',
                ],
                'focus' => [
                    "{$this->focus} invalidated:focus:text-negative-700 invalidated:focus:bg-negative-400 invalidated:focus:ring-negative-600",
                    'invalidated:dark:focus:text-negative-500 invalidated:dark:focus:bg-negative-600 invalidated:dark:focus:ring-negative-700',
                ],
            ],
            Color::PRIMARY => [
                'base' => 'text-primary-600 border border-primary-600',
                'hover' => [
                    "{$this->hover} hover:text-primary-700 hover:bg-primary-400",
                    'dark:hover:text-primary-500 dark:hover:bg-primary-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-primary-700 focus:bg-primary-400 focus:ring-primary-600",
                    'dark:focus:text-primary-500 dark:focus:bg-primary-600 dark:focus:ring-primary-700',
                ],
            ],
            Color::SECONDARY => [
                'base' => [
                    'text-secondary-600 border border-secondary-600',
                    'dark:text-secondary-400 dark:border-secondary-400',
                ],
                'hover' => [
                    "{$this->hover} hover:text-secondary-700 hover:bg-secondary-400",
                    'dark:hover:text-secondary-300/90 dark:hover:bg-secondary-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-secondary-700 focus:bg-secondary-400 focus:ring-secondary-600",
                    'dark:focus:text-secondary-300/90 dark:focus:bg-secondary-400 dark:focus:ring-secondary-500',
                ],
            ],
            Color::POSITIVE => [
                'base' => [
                    'text-positive-600 border border-positive-600',
                    'dark:text-positive-500/90 dark:border-positive-500/80',
                ],
                'hover' => [
                    "{$this->hover} hover:text-positive-700 hover:bg-positive-400",
                    'dark:hover:text-positive-500 dark:hover:bg-positive-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-positive-700 focus:bg-positive-400 focus:ring-positive-600",
                    'dark:focus:text-positive-500 dark:focus:bg-positive-600 dark:focus:ring-positive-700',
                ],
            ],
            Color::NEGATIVE => [
                'base' => 'text-negative-600 border border-negative-600',
                'hover' => [
                    "{$this->hover} hover:text-negative-700 hover:bg-negative-400",
                    'dark:hover:text-negative-500 dark:hover:bg-negative-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-negative-700 focus:bg-negative-400 focus:ring-negative-600",
                    'dark:focus:text-negative-500 dark:focus:bg-negative-600 dark:focus:ring-negative-700',
                ],
            ],
            Color::WARNING => [
                'base' => 'text-warning-600 border border-warning-600',
                'hover' => [
                    "{$this->hover} hover:text-warning-700 hover:bg-warning-400",
                    'dark:hover:text-warning-500 dark:hover:bg-warning-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-warning-700 focus:bg-warning-400 focus:ring-warning-600",
                    'dark:focus:text-warning-500 dark:focus:bg-warning-600 dark:focus:ring-warning-700',
                ],
            ],
            Color::INFO => [
                'base' => 'text-info-600 border border-info-600',
                'hover' => [
                    "{$this->hover} hover:text-info-700 hover:bg-info-400",
                    'dark:hover:text-info-500 dark:hover:bg-info-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-info-700 focus:bg-info-400 focus:ring-info-600",
                    'dark:focus:text-info-500 dark:focus:bg-info-600 dark:focus:ring-info-700',
                ],
            ],
            Color::WHITE => [
                'base' => 'text-white border border-white dark:border-white/80',
                'hover' => [
                    "{$this->hover} hover:text-white hover:bg-opacity-30 hover:bg-white",
                    'dark:hover:text-white dark:hover:bg-white',
                ],
                'focus' => [
                    "{$this->focus} focus:text-white focus:bg-slate-100 focus:ring-white",
                    'focus:ring-offset-background-dark',
                    'dark:focus:text-white dark:focus:bg-white dark:focus:ring-white/80',
                ],
            ],
            Color::BLACK => [
                'base' => 'text-black border border-black dark:border-black',
                'hover' => [
                    "{$this->hover} hover:text-black hover:bg-black/10",
                    'dark:hover:text-black dark:hover:bg-black',
                ],
                'focus' => [
                    "{$this->focus} focus:text-black focus:bg-black/10 focus:ring-black",
                    'dark:focus:text-black dark:focus:bg-black dark:focus:ring-black',
                ],
            ],
            Color::SLATE => [
                'base' => 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
                'hover' => [
                    "{$this->hover} hover:text-slate-700 hover:bg-slate-400",
                    'dark:hover:text-slate-300 dark:hover:bg-slate-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-slate-700 focus:bg-slate-400 focus:ring-slate-600",
                    'dark:focus:text-slate-300 dark:focus:bg-slate-400 dark:focus:ring-slate-400',
                ],
            ],
            Color::GRAY => [
                'base' => 'text-gray-600 border border-gray-600 dark:text-gray-400 dark:border-gray-400',
                'hover' => [
                    "{$this->hover} hover:text-gray-700 hover:bg-gray-400",
                    'dark:hover:text-gray-300 dark:hover:bg-gray-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-gray-700 focus:bg-gray-400 focus:ring-gray-600",
                    'dark:focus:text-gray-300 dark:focus:bg-gray-400 dark:focus:ring-gray-400',
                ],
            ],
            Color::ZINC => [
                'base' => 'text-zinc-600 border border-zinc-600 dark:text-zinc-400 dark:border-zinc-400',
                'hover' => [
                    "{$this->hover} hover:text-zinc-700 hover:bg-zinc-400",
                    'dark:hover:text-zinc-300 dark:hover:bg-zinc-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-zinc-700 focus:bg-zinc-400 focus:ring-zinc-600",
                    'dark:focus:text-zinc-300 dark:focus:bg-zinc-400 dark:focus:ring-zinc-400',
                ],
            ],
            Color::NEUTRAL => [
                'base' => 'text-neutral-600 border border-neutral-600 dark:text-neutral-400 dark:border-neutral-400',
                'hover' => [
                    "{$this->hover} hover:text-neutral-700 hover:bg-neutral-400",
                    'dark:hover:text-neutral-300 dark:hover:bg-neutral-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-neutral-700 focus:bg-neutral-400 focus:ring-neutral-600",
                    'dark:focus:text-neutral-300 dark:focus:bg-neutral-400 dark:focus:ring-neutral-400',
                ],
            ],
            Color::STONE => [
                'base' => 'text-stone-600 border border-stone-600 dark:text-stone-400 dark:border-stone-400',
                'hover' => [
                    "{$this->hover} hover:text-stone-700 hover:bg-stone-400",
                    'dark:hover:text-stone-300 dark:hover:bg-stone-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-stone-700 focus:bg-stone-400 focus:ring-stone-600",
                    'dark:focus:text-stone-300 dark:focus:bg-stone-400 dark:focus:ring-stone-400',
                ],
            ],
            Color::RED => [
                'base' => 'text-red-600 border border-red-600',
                'hover' => [
                    "{$this->hover} hover:text-red-700 hover:bg-red-400",
                    'dark:hover:text-red-500 dark:hover:bg-red-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-red-700 focus:bg-red-400 focus:ring-red-600",
                    'dark:focus:text-red-500 dark:focus:bg-red-600 dark:focus:ring-red-700',
                ],
            ],
            Color::ORANGE => [
                'base' => 'text-orange-600 border border-orange-600',
                'hover' => [
                    "{$this->hover} hover:text-orange-700 hover:bg-orange-400",
                    'dark:hover:text-orange-500 dark:hover:bg-orange-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-orange-700 focus:bg-orange-400 focus:ring-orange-600",
                    'dark:focus:text-orange-500 dark:focus:bg-orange-600 dark:focus:ring-orange-700',
                ],
            ],
            Color::YELLOW => [
                'base' => 'text-yellow-600 border border-yellow-600',
                'hover' => [
                    "{$this->hover} hover:text-yellow-700 hover:bg-yellow-400",
                    'dark:hover:text-yellow-500 dark:hover:bg-yellow-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-yellow-700 focus:bg-yellow-400 focus:ring-yellow-600",
                    'dark:focus:text-yellow-500 dark:focus:bg-yellow-600 dark:focus:ring-yellow-700',
                ],
            ],
            Color::AMBER => [
                'base' => 'text-amber-600 border border-amber-600',
                'hover' => [
                    "{$this->hover} hover:text-amber-700 hover:bg-amber-400",
                    'dark:hover:text-amber-500 dark:hover:bg-amber-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-amber-700 focus:bg-amber-400 focus:ring-amber-600",
                    'dark:focus:text-amber-500 dark:focus:bg-amber-600 dark:focus:ring-amber-700',
                ],
            ],
            Color::LIME => [
                'base' => 'text-lime-600 border border-lime-600',
                'hover' => [
                    "{$this->hover} hover:text-lime-700 hover:bg-lime-400",
                    'dark:hover:text-lime-500 dark:hover:bg-lime-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-lime-700 focus:bg-lime-400 focus:ring-lime-600",
                    'dark:focus:text-lime-500 dark:focus:bg-lime-600 dark:focus:ring-lime-700',
                ],
            ],
            Color::GREEN => [
                'base' => 'text-green-600 border border-green-600',
                'hover' => [
                    "{$this->hover} hover:text-green-700 hover:bg-green-400",
                    'dark:hover:text-green-500 dark:hover:bg-green-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-green-700 focus:bg-green-400 focus:ring-green-600",
                    'dark:focus:text-green-500 dark:focus:bg-green-600 dark:focus:ring-green-700',
                ],
            ],
            Color::EMERALD => [
                'base' => [
                    'text-emerald-600 border border-emerald-600',
                    'dark:text-emerald-500/90 dark:border-emerald-500/80',
                ],
                'hover' => [
                    "{$this->hover} hover:text-emerald-700 hover:bg-emerald-400",
                    'dark:hover:text-emerald-500 dark:hover:bg-emerald-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-emerald-700 focus:bg-emerald-400 focus:ring-emerald-600",
                    'dark:focus:text-emerald-500 dark:focus:bg-emerald-600 dark:focus:ring-emerald-700',
                ],
            ],
            Color::TEAL => [
                'base' => [
                    'text-teal-600 border border-teal-600',
                    'dark:text-teal-500/90 dark:border-teal-500/80',
                ],
                'hover' => [
                    "{$this->hover} hover:text-teal-700 hover:bg-teal-400",
                    'dark:hover:text-teal-500 dark:hover:bg-teal-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-teal-700 focus:bg-teal-400 focus:ring-teal-600",
                    'dark:focus:text-teal-500 dark:focus:bg-teal-600 dark:focus:ring-teal-500/80',
                ],
            ],
            Color::CYAN => [
                'base' => 'text-cyan-600 border border-cyan-600',
                'hover' => [
                    "{$this->hover} hover:text-cyan-700 hover:bg-cyan-400",
                    'dark:hover:text-cyan-500 dark:hover:bg-cyan-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-cyan-700 focus:bg-cyan-400 focus:ring-cyan-600",
                    'dark:focus:text-cyan-500 dark:focus:bg-cyan-600 dark:focus:ring-cyan-700',
                ],
            ],
            Color::SKY => [
                'base' => 'text-sky-600 border border-sky-600',
                'hover' => [
                    "{$this->hover} hover:text-sky-700 hover:bg-sky-400",
                    'dark:hover:text-sky-500 dark:hover:bg-sky-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-sky-700 focus:bg-sky-400 focus:ring-sky-600",
                    'dark:focus:text-sky-500 dark:focus:bg-sky-600 dark:focus:ring-sky-700',
                ],
            ],
            Color::BLUE => [
                'base' => 'text-blue-600 border border-blue-600',
                'hover' => [
                    "{$this->hover} hover:text-blue-700 hover:bg-blue-400",
                    'dark:hover:text-blue-500 dark:hover:bg-blue-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-blue-700 focus:bg-blue-400 focus:ring-blue-600",
                    'dark:focus:text-blue-500 dark:focus:bg-blue-600 dark:focus:ring-blue-700',
                ],
            ],
            Color::INDIGO => [
                'base' => 'text-indigo-600 border border-indigo-600',
                'hover' => [
                    "{$this->hover} hover:text-indigo-700 hover:bg-indigo-400",
                    'dark:hover:text-indigo-500 dark:hover:bg-indigo-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-indigo-700 focus:bg-indigo-400 focus:ring-indigo-600",
                    'dark:focus:text-indigo-500 dark:focus:bg-indigo-600 dark:focus:ring-indigo-700',
                ],
            ],
            Color::VIOLET => [
                'base' => 'text-violet-600 border border-violet-600',
                'hover' => [
                    "{$this->hover} hover:text-violet-700 hover:bg-violet-400",
                    'dark:hover:text-violet-500 dark:hover:bg-violet-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-violet-700 focus:bg-violet-400 focus:ring-violet-600",
                    'dark:focus:text-violet-500 dark:focus:bg-violet-600 dark:focus:ring-violet-700',
                ],
            ],
            Color::PURPLE => [
                'base' => 'text-purple-600 border border-purple-600',
                'hover' => [
                    "{$this->hover} hover:text-purple-700 hover:bg-purple-400",
                    'dark:hover:text-purple-500 dark:hover:bg-purple-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-purple-700 focus:bg-purple-400 focus:ring-purple-600",
                    'dark:focus:text-purple-500 dark:focus:bg-purple-600 dark:focus:ring-purple-700',
                ],
            ],
            Color::FUCHSIA => [
                'base' => 'text-fuchsia-600 border border-fuchsia-600',
                'hover' => [
                    "{$this->hover} hover:text-fuchsia-700 hover:bg-fuchsia-400",
                    'dark:hover:text-fuchsia-500 dark:hover:bg-fuchsia-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-fuchsia-700 focus:bg-fuchsia-400 focus:ring-fuchsia-600",
                    'dark:focus:text-fuchsia-500 dark:focus:bg-fuchsia-600 dark:focus:ring-fuchsia-700',
                ],
            ],
            Color::PINK => [
                'base' => 'text-pink-600 border border-pink-600',
                'hover' => [
                    "{$this->hover} hover:text-pink-700 hover:bg-pink-400",
                    'dark:hover:text-pink-500 dark:hover:bg-pink-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-pink-700 focus:bg-pink-400 focus:ring-pink-600",
                    'dark:focus:text-pink-500 dark:focus:bg-pink-600 dark:focus:ring-pink-700',
                ],
            ],
            Color::ROSE => [
                'base' => 'text-rose-600 border border-rose-600',
                'hover' => [
                    "{$this->hover} hover:text-rose-700 hover:bg-rose-400",
                    'dark:hover:text-rose-500 dark:hover:bg-rose-600',
                ],
                'focus' => [
                    "{$this->focus} focus:text-rose-700 focus:bg-rose-400 focus:ring-rose-600",
                    'dark:focus:text-rose-500 dark:focus:bg-rose-600 dark:focus:ring-rose-700',
                ],
            ],
        ];
    }
}
