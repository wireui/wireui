<?php

namespace WireUi\Components\Badge\WireUi\Color;

use WireUi\Enum\Packs\Color;
use WireUi\Support\ComponentPack;

class Solid extends ComponentPack
{
    public function default(): string
    {
        return config('wireui.style.color') ?? Color::BASE;
    }

    public function all(): array
    {
        return [
            Color::BASE => 'text-slate-500 border dark:text-slate-400 dark:border-slate-500',
            Color::PRIMARY => 'text-white bg-primary-500 dark:bg-primary-700',
            Color::SECONDARY => 'text-white bg-secondary-500 dark:bg-secondary-700',
            Color::POSITIVE => 'text-white bg-positive-500 dark:bg-positive-700',
            Color::NEGATIVE => 'text-white bg-negative-500 dark:bg-negative-700',
            Color::WARNING => 'text-white bg-warning-500 dark:bg-warning-700',
            Color::INFO => 'text-white bg-info-500 dark:bg-info-700',
            Color::DARK => 'text-white bg-gray-700 dark:bg-gray-700',
            Color::WHITE => 'text-slate-500 bg-white border dark:text-slate-200 dark:border-slate-700 dark:bg-slate-700',
            Color::BLACK => 'text-slate-100 bg-black dark:bg-slate-700 dark:border-slate-700',
            Color::SLATE => 'text-white bg-slate-500 dark:bg-slate-700',
            Color::GRAY => 'text-white bg-gray-500 dark:bg-gray-700',
            Color::ZINC => 'text-white bg-zinc-500 dark:bg-zinc-700',
            Color::NEUTRAL => 'text-white bg-neutral-500 dark:bg-neutral-700',
            Color::STONE => 'text-white bg-stone-500 dark:bg-stone-700',
            Color::RED => 'text-white bg-red-500 dark:bg-red-700',
            Color::ORANGE => 'text-white bg-orange-500 dark:bg-orange-700',
            Color::AMBER => 'text-white bg-amber-500 dark:bg-amber-700',
            Color::LIME => 'text-white bg-lime-500 dark:bg-lime-700',
            Color::GREEN => 'text-white bg-green-500 dark:bg-green-700',
            Color::EMERALD => 'text-white bg-emerald-500 dark:bg-emerald-700',
            Color::TEAL => 'text-white bg-teal-500 dark:bg-teal-700',
            Color::CYAN => 'text-white bg-cyan-500 dark:bg-cyan-700',
            Color::SKY => 'text-white bg-sky-500 dark:bg-sky-700',
            Color::BLUE => 'text-white bg-blue-500 dark:bg-blue-700',
            Color::INDIGO => 'text-white bg-indigo-500 dark:bg-indigo-700',
            Color::VIOLET => 'text-white bg-violet-500 dark:bg-violet-700',
            Color::PURPLE => 'text-white bg-purple-500 dark:bg-purple-700',
            Color::FUCHSIA => 'text-white bg-fuchsia-500 dark:bg-fuchsia-700',
            Color::PINK => 'text-white bg-pink-500 dark:bg-pink-700',
            Color::ROSE => 'text-white bg-rose-500 dark:bg-rose-700',
        ];
    }
}
