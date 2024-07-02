<?php

namespace WireUi\Components\Button\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Light extends ComponentPack
{
    protected string $base = 'bg-opacity-60 dark:bg-opacity-30';

    protected string $hover = 'hover:bg-opacity-60 dark:hover:bg-opacity-30';

    protected string $focus = 'focus:bg-opacity-60 dark:focus:bg-opacity-30 focus:ring-offset-2';

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
                'base' => "{$this->base} text-slate-600 bg-slate-200 dark:bg-slate-600 dark:text-slate-400",
                'hover' => [
                    "{$this->hover} hover:text-slate-800 hover:bg-slate-300",
                    'dark:hover:text-slate-400 dark:hover:bg-slate-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-slate-800 focus:bg-slate-300 focus:ring-slate-300",
                    'dark:focus:text-slate-400 dark:focus:bg-slate-500 dark:focus:ring-slate-700',
                ],
            ],
            Color::INVALIDATED => [
                'base' => "{$this->base} invalidated:text-negative-600 invalidated:bg-negative-300 invalidated:dark:bg-negative-600 invalidated:dark:text-negative-500",
                'hover' => [
                    "{$this->hover} invalidated:hover:text-negative-800 invalidated:hover:bg-negative-400",
                    'invalidated:dark:hover:text-negative-400 invalidated:dark:hover:bg-negative-500',
                ],
                'focus' => [
                    "{$this->focus} invalidated:focus:text-negative-800 invalidated:focus:bg-negative-400 invalidated:focus:ring-negative-400",
                    'invalidated:dark:focus:text-negative-400 invalidated:dark:focus:bg-negative-500 invalidated:dark:focus:ring-negative-700',
                ],
            ],
            Color::PRIMARY => [
                'base' => "{$this->base} text-primary-600 bg-primary-300 dark:bg-primary-600 dark:text-primary-400",
                'hover' => [
                    "{$this->hover} hover:text-primary-800 hover:bg-primary-400",
                    'dark:hover:text-primary-400 dark:hover:bg-primary-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-primary-800 focus:bg-primary-400 focus:ring-primary-400",
                    'dark:focus:text-primary-400 dark:focus:bg-primary-500 dark:focus:ring-primary-700',
                ],
            ],
            Color::SECONDARY => [
                'base' => "{$this->base} text-secondary-600 bg-secondary-300 dark:bg-secondary-600 dark:text-secondary-400",
                'hover' => [
                    "{$this->hover} hover:text-secondary-800 hover:bg-secondary-400",
                    'dark:hover:text-secondary-400 dark:hover:bg-secondary-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-secondary-800 focus:bg-secondary-400 focus:ring-secondary-400",
                    'dark:focus:text-secondary-400 dark:focus:bg-secondary-500 dark:focus:ring-secondary-700',
                ],
            ],
            Color::POSITIVE => [
                'base' => "{$this->base} text-positive-600 bg-positive-300 dark:bg-positive-600 dark:text-positive-500",
                'hover' => [
                    "{$this->hover} hover:text-positive-800 hover:bg-positive-400",
                    'dark:hover:text-positive-400 dark:hover:bg-positive-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-positive-800 focus:bg-positive-400 focus:ring-positive-400",
                    'dark:focus:text-positive-400 dark:focus:bg-positive-500 dark:focus:ring-positive-700',
                ],
            ],
            Color::NEGATIVE => [
                'base' => "{$this->base} text-negative-600 bg-negative-300 dark:bg-negative-600 dark:text-negative-500",
                'hover' => [
                    "{$this->hover} hover:text-negative-800 hover:bg-negative-400",
                    'dark:hover:text-negative-400 dark:hover:bg-negative-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-negative-800 focus:bg-negative-400 focus:ring-negative-400",
                    'dark:focus:text-negative-400 dark:focus:bg-negative-500 dark:focus:ring-negative-700',
                ],
            ],
            Color::WARNING => [
                'base' => "{$this->base} text-warning-600 bg-warning-300 dark:bg-warning-600 dark:text-warning-500",
                'hover' => [
                    "{$this->hover} hover:text-warning-800 hover:bg-warning-400",
                    'dark:hover:text-warning-400 dark:hover:bg-warning-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-warning-800 focus:bg-warning-400 focus:ring-warning-400",
                    'dark:focus:text-warning-400 dark:focus:bg-warning-500 dark:focus:ring-warning-700',
                ],
            ],
            Color::INFO => [
                'base' => "{$this->base} text-info-600 bg-info-300 dark:bg-info-600 dark:text-info-400",
                'hover' => [
                    "{$this->hover} hover:text-info-800 hover:bg-info-400",
                    'dark:hover:text-info-400 dark:hover:bg-info-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-info-800 focus:bg-info-400 focus:ring-info-400",
                    'dark:focus:text-info-400 dark:focus:bg-info-500 dark:focus:ring-info-700',
                ],
            ],
            Color::WHITE => [
                'base' => "{$this->base} text-white bg-white/20",
                'hover' => "{$this->hover} hover:bg-white/30",
                'focus' => "{$this->focus} focus:bg-white/35 focus:ring-white/60",
            ],
            Color::BLACK => [
                'base' => "{$this->base} text-black bg-black/20",
                'hover' => "{$this->hover} hover:bg-black/30",
                'focus' => "{$this->focus} focus:bg-black/35 focus:ring-black/60",
            ],
            Color::SLATE => [
                'base' => "{$this->base} text-slate-600 bg-slate-300 dark:bg-slate-500 dark:text-slate-400",
                'hover' => [
                    "{$this->hover} hover:text-slate-800 hover:bg-slate-400",
                    'dark:hover:text-slate-400 dark:hover:bg-slate-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-slate-800 focus:bg-slate-400 focus:ring-slate-400",
                    'dark:focus:text-slate-400 dark:focus:bg-slate-400 dark:focus:ring-slate-700',
                ],
            ],
            Color::GRAY => [
                'base' => "{$this->base} text-gray-600 bg-gray-300 dark:bg-gray-500 dark:text-gray-400",
                'hover' => [
                    "{$this->hover} hover:text-gray-800 hover:bg-gray-400",
                    'dark:hover:text-gray-400 dark:hover:bg-gray-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-gray-800 focus:bg-gray-400 focus:ring-gray-400",
                    'dark:focus:text-gray-400 dark:focus:bg-gray-400 dark:focus:ring-gray-700',
                ],
            ],
            Color::ZINC => [
                'base' => "{$this->base} text-zinc-600 bg-zinc-300 dark:bg-zinc-500 dark:text-zinc-400",
                'hover' => [
                    "{$this->hover} hover:text-zinc-800 hover:bg-zinc-400",
                    'dark:hover:text-zinc-400 dark:hover:bg-zinc-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-zinc-800 focus:bg-zinc-400 focus:ring-zinc-400",
                    'dark:focus:text-zinc-400 dark:focus:bg-zinc-400 dark:focus:ring-zinc-700',
                ],
            ],
            Color::NEUTRAL => [
                'base' => "{$this->base} text-neutral-600 bg-neutral-300 dark:bg-neutral-500 dark:text-neutral-400",
                'hover' => [
                    "{$this->hover} hover:text-neutral-800 hover:bg-neutral-400",
                    'dark:hover:text-neutral-400 dark:hover:bg-neutral-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-neutral-800 focus:bg-neutral-400 focus:ring-neutral-400",
                    'dark:focus:text-neutral-400 dark:focus:bg-neutral-400 dark:focus:ring-neutral-700',
                ],
            ],
            Color::STONE => [
                'base' => "{$this->base} text-stone-600 bg-stone-300 dark:bg-stone-500 dark:text-stone-400",
                'hover' => [
                    "{$this->hover} hover:text-stone-800 hover:bg-stone-400",
                    'dark:hover:text-stone-400 dark:hover:bg-stone-400',
                ],
                'focus' => [
                    "{$this->focus} focus:text-stone-800 focus:bg-stone-400 focus:ring-stone-400",
                    'dark:focus:text-stone-400 dark:focus:bg-stone-400 dark:focus:ring-stone-700',
                ],
            ],
            Color::RED => [
                'base' => "{$this->base} text-red-600 bg-red-300 dark:bg-red-600 dark:text-red-500",
                'hover' => [
                    "{$this->hover} hover:text-red-800 hover:bg-red-400",
                    'dark:hover:text-red-400 dark:hover:bg-red-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-red-800 focus:bg-red-400 focus:ring-red-400",
                    'dark:focus:text-red-400 dark:focus:bg-red-500 dark:focus:ring-red-700',
                ],
            ],
            Color::ORANGE => [
                'base' => "{$this->base} text-orange-600 bg-orange-300 dark:bg-orange-600 dark:text-orange-400",
                'hover' => [
                    "{$this->hover} hover:text-orange-800 hover:bg-orange-400",
                    'dark:hover:text-orange-400 dark:hover:bg-orange-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-orange-800 focus:bg-orange-400 focus:ring-orange-400",
                    'dark:focus:text-orange-400 dark:focus:bg-orange-500 dark:focus:ring-orange-700',
                ],
            ],
            Color::YELLOW => [
                'base' => "{$this->base} text-yellow-600 bg-yellow-300 dark:bg-yellow-600 dark:text-yellow-500",
                'hover' => [
                    "{$this->hover} hover:text-yellow-800 hover:bg-yellow-400",
                    'dark:hover:text-yellow-400 dark:hover:bg-yellow-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-yellow-800 focus:bg-yellow-400 focus:ring-yellow-400",
                    'dark:focus:text-yellow-400 dark:focus:bg-yellow-500 dark:focus:ring-yellow-700',
                ],
            ],
            Color::AMBER => [
                'base' => "{$this->base} text-amber-600 bg-amber-300 dark:bg-amber-600 dark:text-amber-500",
                'hover' => [
                    "{$this->hover} hover:text-amber-800 hover:bg-amber-400",
                    'dark:hover:text-amber-400 dark:hover:bg-amber-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-amber-800 focus:bg-amber-400 focus:ring-amber-400",
                    'dark:focus:text-amber-400 dark:focus:bg-amber-500 dark:focus:ring-amber-700',
                ],
            ],
            Color::LIME => [
                'base' => "{$this->base} text-lime-600 bg-lime-300 dark:bg-lime-600 dark:text-lime-400",
                'hover' => [
                    "{$this->hover} hover:text-lime-800 hover:bg-lime-400",
                    'dark:hover:text-lime-400 dark:hover:bg-lime-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-lime-800 focus:bg-lime-400 focus:ring-lime-400",
                    'dark:focus:text-lime-400 dark:focus:bg-lime-500 dark:focus:ring-lime-700',
                ],
            ],
            Color::GREEN => [
                'base' => "{$this->base} text-green-600 bg-green-300 dark:bg-green-600 dark:text-green-400",
                'hover' => [
                    "{$this->hover} hover:text-green-800 hover:bg-green-400",
                    'dark:hover:text-green-400 dark:hover:bg-green-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-green-800 focus:bg-green-400 focus:ring-green-400",
                    'dark:focus:text-green-400 dark:focus:bg-green-500 dark:focus:ring-green-700',
                ],
            ],
            Color::EMERALD => [
                'base' => "{$this->base} text-emerald-600 bg-emerald-300 dark:bg-emerald-600 dark:text-emerald-400",
                'hover' => [
                    "{$this->hover} hover:text-emerald-800 hover:bg-emerald-400",
                    'dark:hover:text-emerald-400 dark:hover:bg-emerald-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-emerald-800 focus:bg-emerald-400 focus:ring-emerald-400",
                    'dark:focus:text-emerald-400 dark:focus:bg-emerald-500 dark:focus:ring-emerald-700',
                ],
            ],
            Color::TEAL => [
                'base' => "{$this->base} text-teal-600 bg-teal-300 dark:bg-teal-600 dark:text-teal-400",
                'hover' => [
                    "{$this->hover} hover:text-teal-800 hover:bg-teal-400",
                    'dark:hover:text-teal-400 dark:hover:bg-teal-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-teal-800 focus:bg-teal-400 focus:ring-teal-400",
                    'dark:focus:text-teal-400 dark:focus:bg-teal-500 dark:focus:ring-teal-700',
                ],
            ],
            Color::CYAN => [
                'base' => "{$this->base} text-cyan-600 bg-cyan-300 dark:bg-cyan-600 dark:text-cyan-400",
                'hover' => [
                    "{$this->hover} hover:text-cyan-800 hover:bg-cyan-400",
                    'dark:hover:text-cyan-400 dark:hover:bg-cyan-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-cyan-800 focus:bg-cyan-400 focus:ring-cyan-400",
                    'dark:focus:text-cyan-400 dark:focus:bg-cyan-500 dark:focus:ring-cyan-700',
                ],
            ],
            Color::SKY => [
                'base' => "{$this->base} text-sky-600 bg-sky-300 dark:bg-sky-600 dark:text-sky-400",
                'hover' => [
                    "{$this->hover} hover:text-sky-800 hover:bg-sky-400",
                    'dark:hover:text-sky-400 dark:hover:bg-sky-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-sky-800 focus:bg-sky-400 focus:ring-sky-400",
                    'dark:focus:text-sky-400 dark:focus:bg-sky-500 dark:focus:ring-sky-700',
                ],
            ],
            Color::BLUE => [
                'base' => "{$this->base} text-blue-600 bg-blue-300 dark:bg-blue-600 dark:text-blue-400",
                'hover' => [
                    "{$this->hover} hover:text-blue-800 hover:bg-blue-400",
                    'dark:hover:text-blue-400 dark:hover:bg-blue-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-blue-800 focus:bg-blue-400 focus:ring-blue-400",
                    'dark:focus:text-blue-400 dark:focus:bg-blue-500 dark:focus:ring-blue-700',
                ],
            ],
            Color::INDIGO => [
                'base' => "{$this->base} text-indigo-600 bg-indigo-300 dark:bg-indigo-600 dark:text-indigo-400",
                'hover' => [
                    "{$this->hover} hover:text-indigo-800 hover:bg-indigo-400",
                    'dark:hover:text-indigo-400 dark:hover:bg-indigo-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-indigo-800 focus:bg-indigo-400 focus:ring-indigo-400",
                    'dark:focus:text-indigo-400 dark:focus:bg-indigo-500 dark:focus:ring-indigo-700',
                ],
            ],
            Color::VIOLET => [
                'base' => "{$this->base} text-violet-600 bg-violet-300 dark:bg-violet-600 dark:text-violet-400",
                'hover' => [
                    "{$this->hover} hover:text-violet-800 hover:bg-violet-400",
                    'dark:hover:text-violet-400 dark:hover:bg-violet-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-violet-800 focus:bg-violet-400 focus:ring-violet-400",
                    'dark:focus:text-violet-400 dark:focus:bg-violet-500 dark:focus:ring-violet-700',
                ],
            ],
            Color::PURPLE => [
                'base' => "{$this->base} text-purple-600 bg-purple-300 dark:bg-purple-600 dark:text-purple-400",
                'hover' => [
                    "{$this->hover} hover:text-purple-800 hover:bg-purple-400",
                    'dark:hover:text-purple-400 dark:hover:bg-purple-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-purple-800 focus:bg-purple-400 focus:ring-purple-400",
                    'dark:focus:text-purple-400 dark:focus:bg-purple-500 dark:focus:ring-purple-700',
                ],
            ],
            Color::FUCHSIA => [
                'base' => "{$this->base} text-fuchsia-600 bg-fuchsia-300 dark:bg-fuchsia-600 dark:text-fuchsia-400",
                'hover' => [
                    "{$this->hover} hover:text-fuchsia-800 hover:bg-fuchsia-400",
                    'dark:hover:text-fuchsia-400 dark:hover:bg-fuchsia-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-fuchsia-800 focus:bg-fuchsia-400 focus:ring-fuchsia-400",
                    'dark:focus:text-fuchsia-400 dark:focus:bg-fuchsia-500 dark:focus:ring-fuchsia-700',
                ],
            ],
            Color::PINK => [
                'base' => "{$this->base} text-pink-600 bg-pink-300 dark:bg-pink-600 dark:text-pink-400",
                'hover' => [
                    "{$this->hover} hover:text-pink-800 hover:bg-pink-400",
                    'dark:hover:text-pink-400 dark:hover:bg-pink-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-pink-800 focus:bg-pink-400 focus:ring-pink-400",
                    'dark:focus:text-pink-400 dark:focus:bg-pink-500 dark:focus:ring-pink-700',
                ],
            ],
            Color::ROSE => [
                'base' => "{$this->base} text-rose-600 bg-rose-300 dark:bg-rose-600 dark:text-rose-400",
                'hover' => [
                    "{$this->hover} hover:text-rose-800 hover:bg-rose-400",
                    'dark:hover:text-rose-400 dark:hover:bg-rose-500',
                ],
                'focus' => [
                    "{$this->focus} focus:text-rose-800 focus:bg-rose-400 focus:ring-rose-400",
                    'dark:focus:text-rose-400 dark:focus:bg-rose-500 dark:focus:ring-rose-700',
                ],
            ],
        ];
    }
}
