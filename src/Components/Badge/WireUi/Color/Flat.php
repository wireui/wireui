<?php

namespace WireUi\Components\Badge\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Flat extends ComponentPack
{
    public function default(): string
    {
        return config('wireui.style.color') ?? Color::BASE;
    }

    public function all(): array
    {
        return [
            Color::BASE => 'text-slate-500 bg-slate-100 dark:text-slate-400 dark:bg-slate-700',
            Color::PRIMARY => 'text-primary-600 bg-primary-100 dark:bg-slate-700',
            Color::SECONDARY => 'text-secondary-600 bg-secondary-100 dark:text-secondary-400 dark:bg-slate-700',
            Color::POSITIVE => 'text-positive-600 bg-positive-100 dark:bg-slate-700',
            Color::NEGATIVE => 'text-negative-600 bg-negative-100 dark:bg-slate-700',
            Color::WARNING => 'text-warning-600 bg-warning-100 dark:bg-slate-700',
            Color::INFO => 'text-info-600 bg-info-100 dark:bg-slate-700',
            Color::DARK => 'text-slate-900 bg-slate-200 dark:text-slate-400 dark:bg-slate-700',
            Color::WHITE => 'text-slate-500 bg-white dark:text-slate-300 dark:bg-slate-700',
            Color::BLACK => 'text-black bg-slate-100 dark:text-slate-300 dark:bg-slate-700',
            Color::SLATE => 'text-slate-600 bg-slate-100 dark:text-slate-400 dark:bg-slate-700',
            Color::GRAY => 'text-gray-600 bg-gray-100 dark:text-gray-400 dark:bg-slate-700',
            Color::ZINC => 'text-zinc-600 bg-zinc-100 dark:text-zinc-400 dark:bg-slate-700',
            Color::NEUTRAL => 'text-neutral-600 bg-neutral-100 dark:text-neutral-400 dark:bg-slate-700',
            Color::STONE => 'text-stone-600 bg-stone-100 dark:text-stone-400 dark:bg-slate-700',
            Color::RED => 'text-red-600 bg-red-100 dark:bg-slate-700',
            Color::ORANGE => 'text-orange-600 bg-orange-100 dark:bg-slate-700',
            Color::AMBER => 'text-amber-600 bg-amber-100 dark:bg-slate-700',
            Color::LIME => 'text-lime-600 bg-lime-100 dark:bg-slate-700',
            Color::GREEN => 'text-green-600 bg-green-100 dark:bg-slate-700',
            Color::EMERALD => 'text-emerald-600 bg-emerald-100 dark:bg-slate-700',
            Color::TEAL => 'text-teal-600 bg-teal-100 dark:bg-slate-700',
            Color::CYAN => 'text-cyan-600 bg-cyan-100 dark:bg-slate-700',
            Color::SKY => 'text-sky-600 bg-sky-100 dark:bg-slate-700',
            Color::BLUE => 'text-blue-600 bg-blue-100 dark:bg-slate-700',
            Color::INDIGO => 'text-indigo-600 bg-indigo-100 dark:bg-slate-700',
            Color::VIOLET => 'text-violet-600 bg-violet-100 dark:bg-slate-700',
            Color::PURPLE => 'text-purple-600 bg-purple-100 dark:bg-slate-700',
            Color::FUCHSIA => 'text-fuchsia-600 bg-fuchsia-100 dark:bg-slate-700',
            Color::PINK => 'text-pink-600 bg-pink-100 dark:bg-slate-700',
            Color::ROSE => 'text-rose-600 bg-rose-100 dark:bg-slate-700',
        ];
    }
}
