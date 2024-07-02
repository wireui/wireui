<?php

namespace WireUi\Components\Badge\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Outline extends ComponentPack
{
    public function default(): string
    {
        return config('wireui.style.color') ?? Color::BASE;
    }

    public function all(): array
    {
        return [
            Color::BASE => 'text-slate-500 border dark:text-slate-400 dark:border-slate-500',
            Color::PRIMARY => 'text-primary-500 border border-primary-500',
            Color::SECONDARY => 'text-secondary-600 border border-secondary-600 dark:text-secondary-400 dark:border-secondary-400',
            Color::POSITIVE => 'text-positive-500 border border-positive-500',
            Color::NEGATIVE => 'text-negative-500 border border-negative-500',
            Color::WARNING => 'text-warning-600 border border-warning-600',
            Color::INFO => 'text-info-600 border border-info-600',
            Color::DARK => 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
            Color::WHITE => 'text-white border border-white dark:text-slate-200 dark:border-slate-400',
            Color::BLACK => 'text-black border border-black dark:text-slate-200 dark:border-slate-400',
            Color::SLATE => 'text-slate-600 border border-slate-600 dark:text-slate-400 dark:border-slate-400',
            Color::GRAY => 'text-gray-500 border border-gray-500 dark:text-gray-400 dark:border-gray-400',
            Color::ZINC => 'text-zinc-500 border border-zinc-500 dark:text-zinc-400 dark:border-zinc-400',
            Color::NEUTRAL => 'text-neutral-500 border border-neutral-500 dark:text-neutral-400 dark:border-neutral-400',
            Color::STONE => 'text-stone-500 border border-stone-500 dark:text-stone-400 dark:border-stone-400',
            Color::RED => 'text-red-500 border border-red-500',
            Color::ORANGE => 'text-orange-500 border border-orange-500',
            Color::AMBER => 'text-amber-600 border border-amber-600',
            Color::LIME => 'text-lime-500 border border-lime-500 ring-lime-500',
            Color::GREEN => 'text-green-500 border border-green-500 ring-green-500',
            Color::EMERALD => 'text-emerald-500 border border-emerald-500',
            Color::TEAL => 'text-teal-500 border border-teal-500 ring-teal-500',
            Color::CYAN => 'text-cyan-500 border border-cyan-500 ring-cyan-500',
            Color::SKY => 'text-sky-500 border border-sky-500 ring-sky-500',
            Color::BLUE => 'text-blue-500 border border-blue-500 ring-blue-500',
            Color::INDIGO => 'text-indigo-500 border border-indigo-500 ring-indigo-500',
            Color::VIOLET => 'text-violet-500 border border-violet-500 ring-violet-500',
            Color::PURPLE => 'text-purple-500 border border-purple-500 ring-purple-500',
            Color::FUCHSIA => 'text-fuchsia-500 border border-fuchsia-500 ring-fuchsia-500',
            Color::PINK => 'text-pink-500 border border-pink-500 ring-pink-500',
            Color::ROSE => 'text-rose-500 border border-rose-500 ring-rose-500',
        ];
    }
}
