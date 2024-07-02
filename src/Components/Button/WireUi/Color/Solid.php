<?php

namespace WireUi\Components\Button\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Solid extends ComponentPack
{
    private string $base = 'text-white';

    private string $hover = 'hover:text-white';

    private string $focus = 'focus:text-white focus:ring-offset-2';

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
                'base' => 'border border-slate-300 text-slate-500 dark:border-slate-600 dark:text-slate-400',
                'hover' => 'hover:text-slate-500 500 hover:bg-slate-100 dark:hover:text-slate-400 dark:hover:bg-slate-700',
                'focus' => [
                    "{$this->focus} focus:text-slate-500 focus:bg-slate-100 focus:ring-slate-200",
                    'dark:focus:text-slate-400 400 dark:focus:bg-slate-700 dark:focus:ring-slate-600',
                ],
            ],
            Color::INVALIDATED => [
                'base' => "{$this->base} invalidated:bg-negative-500 invalidated:dark:bg-negative-700",
                'hover' => "{$this->hover} invalidated:hover:bg-negative-600 invalidated:dark:hover:bg-negative-600",
                'focus' => [
                    "{$this->focus} invalidated:focus:bg-negative-600 invalidated:focus:ring-negative-600",
                    'invalidated:dark:focus:bg-negative-600 invalidated:dark:focus:ring-negative-600',
                ],
            ],
            Color::PRIMARY => [
                'base' => "{$this->base} bg-primary-500 dark:bg-primary-700",
                'hover' => "{$this->hover} hover:bg-primary-600 dark:hover:bg-primary-600",
                'focus' => [
                    "{$this->focus} focus:bg-primary-600 focus:ring-primary-600",
                    'dark:focus:bg-primary-600 dark:focus:ring-primary-600',
                ],
            ],
            Color::SECONDARY => [
                'base' => "{$this->base} bg-secondary-500 dark:bg-secondary-700",
                'hover' => "{$this->hover} hover:bg-secondary-600 dark:hover:bg-secondary-600",
                'focus' => [
                    "{$this->focus} focus:bg-secondary-600 focus:ring-secondary-600",
                    'dark:focus:bg-secondary-600 dark:focus:ring-secondary-600',
                ],
            ],
            Color::POSITIVE => [
                'base' => "{$this->base} bg-positive-500 dark:bg-positive-700",
                'hover' => "{$this->hover} hover:bg-positive-600 dark:hover:bg-positive-600",
                'focus' => [
                    "{$this->focus} focus:bg-positive-600 focus:ring-positive-600",
                    'dark:focus:bg-positive-600 dark:focus:ring-positive-600',
                ],
            ],
            Color::NEGATIVE => [
                'base' => "{$this->base} bg-negative-500 dark:bg-negative-700",
                'hover' => "{$this->hover} hover:bg-negative-600 dark:hover:bg-negative-600",
                'focus' => [
                    "{$this->focus} focus:bg-negative-600 focus:ring-negative-600",
                    'dark:focus:bg-negative-600 dark:focus:ring-negative-600',
                ],
            ],
            Color::WARNING => [
                'base' => "{$this->base} bg-warning-500 dark:bg-warning-700",
                'hover' => "{$this->hover} hover:bg-warning-600 dark:hover:bg-warning-600",
                'focus' => [
                    "{$this->focus} focus:bg-warning-600 focus:ring-warning-600",
                    'dark:focus:bg-warning-600 dark:focus:ring-warning-600',
                ],
            ],
            Color::INFO => [
                'base' => "{$this->base} bg-info-500 dark:bg-info-700",
                'hover' => "{$this->hover} hover:bg-info-600 dark:hover:bg-info-600",
                'focus' => [
                    "{$this->focus} focus:bg-info-600 focus:ring-info-600",
                    'dark:focus:bg-info-600 dark:focus:ring-info-600',
                ],
            ],
            Color::WHITE => [
                'base' => 'bg-white text-slate-500 dark:text-slate-100 dark:bg-white dark:text-slate-700',
                'hover' => 'hover:text-slate-600 hover:bg-slate-50 dark:hover:text-black dark:hover:bg-white',
                'focus' => [
                    'focus:text-slate-600 focus:bg-slate-50 focus:ring-white focus:ring-offset-background-dark',
                    'dark:focus:bg-white dark:focus:ring-white',
                ],
            ],
            Color::BLACK => [
                'base' => 'bg-black text-white dark:border-slate-700 dark:bg-slate-700',
                'hover' => "{$this->hover} hover:bg-slate-900 dark:hover:bg-slate-600",
                'focus' => [
                    "{$this->focus} focus:bg-slate-900 focus:ring-black",
                    'dark:focus:bg-slate-600 dark:focus:ring-slate-600',
                ],
            ],
            Color::SLATE => [
                'base' => "{$this->base} bg-slate-500 dark:bg-slate-700",
                'hover' => "{$this->hover} hover:bg-slate-600 dark:hover:bg-slate-600",
                'focus' => [
                    "{$this->focus} focus:bg-slate-600 focus:ring-slate-600",
                    'dark:focus:bg-slate-600 dark:focus:ring-slate-600',
                ],
            ],
            Color::GRAY => [
                'base' => "{$this->base} bg-gray-500 dark:bg-gray-700",
                'hover' => "{$this->hover} hover:bg-gray-600 dark:hover:bg-gray-600",
                'focus' => [
                    "{$this->focus} focus:bg-gray-600 focus:ring-gray-600",
                    'dark:focus:bg-gray-600 dark:focus:ring-gray-600',
                ],
            ],
            Color::ZINC => [
                'base' => "{$this->base} bg-zinc-500 dark:bg-zinc-700",
                'hover' => "{$this->hover} hover:bg-zinc-600 dark:hover:bg-zinc-600",
                'focus' => [
                    "{$this->focus} focus:bg-zinc-600 focus:ring-zinc-600",
                    'dark:focus:bg-zinc-600 dark:focus:ring-zinc-600',
                ],
            ],
            Color::NEUTRAL => [
                'base' => "{$this->base} bg-neutral-500 dark:bg-neutral-700",
                'hover' => "{$this->hover} hover:bg-neutral-600 dark:hover:bg-neutral-600",
                'focus' => [
                    "{$this->focus} focus:bg-neutral-600 focus:ring-neutral-600",
                    'dark:focus:bg-neutral-600 dark:focus:ring-neutral-600',
                ],
            ],
            Color::STONE => [
                'base' => "{$this->base} bg-stone-500 dark:bg-stone-700",
                'hover' => "{$this->hover} hover:bg-stone-600 dark:hover:bg-stone-600",
                'focus' => [
                    "{$this->focus} focus:bg-stone-600 focus:ring-stone-600",
                    'dark:focus:bg-stone-600 dark:focus:ring-stone-600',
                ],
            ],
            Color::RED => [
                'base' => "{$this->base} bg-red-500 dark:bg-red-700",
                'hover' => "{$this->hover} hover:bg-red-600 dark:hover:bg-red-600",
                'focus' => [
                    "{$this->focus} focus:bg-red-600 focus:ring-red-600",
                    'dark:focus:bg-red-600 dark:focus:ring-red-600',
                ],
            ],
            Color::ORANGE => [
                'base' => "{$this->base} bg-orange-500 dark:bg-orange-700",
                'hover' => "{$this->hover} hover:bg-orange-600 dark:hover:bg-orange-600",
                'focus' => [
                    "{$this->focus} focus:bg-orange-600 focus:ring-orange-600",
                    'dark:focus:bg-orange-600 dark:focus:ring-orange-600',
                ],
            ],
            Color::YELLOW => [
                'base' => "{$this->base} bg-yellow-500 dark:bg-yellow-700",
                'hover' => "{$this->hover} hover:bg-yellow-600 dark:hover:bg-yellow-600",
                'focus' => [
                    "{$this->focus} focus:bg-yellow-600 focus:ring-yellow-600",
                    'dark:focus:bg-yellow-600 dark:focus:ring-yellow-600',
                ],
            ],
            Color::AMBER => [
                'base' => "{$this->base} bg-amber-500 dark:bg-amber-700",
                'hover' => "{$this->hover} hover:bg-amber-600 dark:hover:bg-amber-600",
                'focus' => [
                    "{$this->focus} focus:bg-amber-600 focus:ring-amber-600",
                    'dark:focus:bg-amber-600 dark:focus:ring-amber-600',
                ],
            ],
            Color::LIME => [
                'base' => "{$this->base} bg-lime-500 dark:bg-lime-700",
                'hover' => "{$this->hover} hover:bg-lime-600 dark:hover:bg-lime-600",
                'focus' => [
                    "{$this->focus} focus:bg-lime-600 focus:ring-lime-600",
                    'dark:focus:bg-lime-600 dark:focus:ring-lime-600',
                ],
            ],
            Color::GREEN => [
                'base' => "{$this->base} bg-green-500 dark:bg-green-700",
                'hover' => "{$this->hover} hover:bg-green-600 dark:hover:bg-green-600",
                'focus' => [
                    "{$this->focus} focus:bg-green-600 focus:ring-green-600",
                    'dark:focus:bg-green-600 dark:focus:ring-green-600',
                ],
            ],
            Color::EMERALD => [
                'base' => "{$this->base} bg-emerald-500 dark:bg-emerald-700",
                'hover' => "{$this->hover} hover:bg-emerald-600 dark:hover:bg-emerald-600",
                'focus' => [
                    "{$this->focus} focus:bg-emerald-600 focus:ring-emerald-600",
                    'dark:focus:bg-emerald-600 dark:focus:ring-emerald-600',
                ],
            ],
            Color::TEAL => [
                'base' => "{$this->base} bg-teal-500 dark:bg-teal-700",
                'hover' => "{$this->hover} hover:bg-teal-600 dark:hover:bg-teal-600",
                'focus' => [
                    "{$this->focus} focus:bg-teal-600 focus:ring-teal-600",
                    'dark:focus:bg-teal-600 dark:focus:ring-teal-600',
                ],
            ],
            Color::CYAN => [
                'base' => "{$this->base} bg-cyan-500 dark:bg-cyan-700",
                'hover' => "{$this->hover} hover:bg-cyan-600 dark:hover:bg-cyan-600",
                'focus' => [
                    "{$this->focus} focus:bg-cyan-600 focus:ring-cyan-600",
                    'dark:focus:bg-cyan-600 dark:focus:ring-cyan-600',
                ],
            ],
            Color::SKY => [
                'base' => "{$this->base} bg-sky-500 dark:bg-sky-700",
                'hover' => "{$this->hover} hover:bg-sky-600 dark:hover:bg-sky-600",
                'focus' => [
                    "{$this->focus} focus:bg-sky-600 focus:ring-sky-600",
                    'dark:focus:bg-sky-600 dark:focus:ring-sky-600',
                ],
            ],
            Color::BLUE => [
                'base' => "{$this->base} bg-blue-500 dark:bg-blue-700",
                'hover' => "{$this->hover} hover:bg-blue-600 dark:hover:bg-blue-600",
                'focus' => [
                    "{$this->focus} focus:bg-blue-600 focus:ring-blue-600",
                    'dark:focus:bg-blue-600 dark:focus:ring-blue-600',
                ],
            ],
            Color::INDIGO => [
                'base' => "{$this->base} bg-indigo-500 dark:bg-indigo-700",
                'hover' => "{$this->hover} hover:bg-indigo-600 dark:hover:bg-indigo-600",
                'focus' => [
                    "{$this->focus} focus:bg-indigo-600 focus:ring-indigo-600",
                    'dark:focus:bg-indigo-600 dark:focus:ring-indigo-600',
                ],
            ],
            Color::VIOLET => [
                'base' => "{$this->base} bg-violet-500 dark:bg-violet-700",
                'hover' => "{$this->hover} hover:bg-violet-600 dark:hover:bg-violet-600",
                'focus' => [
                    "{$this->focus} focus:bg-violet-600 focus:ring-violet-600",
                    'dark:focus:bg-violet-600 dark:focus:ring-violet-600',
                ],
            ],
            Color::PURPLE => [
                'base' => "{$this->base} bg-purple-500 dark:bg-purple-700",
                'hover' => "{$this->hover} hover:bg-purple-600 dark:hover:bg-purple-600",
                'focus' => [
                    "{$this->focus} focus:bg-purple-600 focus:ring-purple-600",
                    'dark:focus:bg-purple-600 dark:focus:ring-purple-600',
                ],
            ],
            Color::FUCHSIA => [
                'base' => "{$this->base} bg-fuchsia-500 dark:bg-fuchsia-700",
                'hover' => "{$this->hover} hover:bg-fuchsia-600 dark:hover:bg-fuchsia-600",
                'focus' => [
                    "{$this->focus} focus:bg-fuchsia-600 focus:ring-fuchsia-600",
                    'dark:focus:bg-fuchsia-600 dark:focus:ring-fuchsia-600',
                ],
            ],
            Color::PINK => [
                'base' => "{$this->base} bg-pink-500 dark:bg-pink-700",
                'hover' => "{$this->hover} hover:bg-pink-600 dark:hover:bg-pink-600",
                'focus' => [
                    "{$this->focus} focus:bg-pink-600 focus:ring-pink-600",
                    'dark:focus:bg-pink-600 dark:focus:ring-pink-600',
                ],
            ],
            Color::ROSE => [
                'base' => "{$this->base} bg-rose-500 dark:bg-rose-700",
                'hover' => "{$this->hover} hover:bg-rose-600 dark:hover:bg-rose-600",
                'focus' => [
                    "{$this->focus} focus:bg-rose-600 focus:ring-rose-600",
                    'dark:focus:bg-rose-600 dark:focus:ring-rose-600',
                ],
            ],
        ];
    }
}
