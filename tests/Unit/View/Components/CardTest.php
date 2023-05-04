<?php

use WireUi\View\Components\Card;

it('should get the default settings', function () {
    $card = new Card();

    expect($card->padding)->toBe(config('wireui.card.padding'));
    expect($card->shadow)->toBe(config('wireui.card.shadow'));
    expect($card->rounded)->toBe(config('wireui.card.rounded'));
    expect($card->color)->toBe(config('wireui.card.color'));
    expect($card->borderless)->toBe(config('wireui.card.borderless'));
});

it('should return card classes', function () {
    $alert = new Card();

    $expect = 'w-full flex flex-col shadow-md rounded-lg bg-white dark:bg-secondary-800';

    expect($alert->getCardClasses())->toBe($expect);
});

it('should return header classes', function () {
    $alert = new Card();

    $expect = 'px-4 py-2.5 flex justify-between items-center border-b border-secondary-200 dark:border-secondary-600';

    expect($alert->getHeaderClasses())->toBe($expect);
});

it('should return title classes', function () {
    $alert = new Card();

    $expect = 'font-medium text-base whitespace-normal text-secondary-700 dark:text-secondary-400';

    expect($alert->getTitleClasses())->toBe($expect);
});

it('should return main classes', function () {
    $alert = new Card();

    $expect = 'rounded-b-xl grow text-secondary-700 dark:text-secondary-400 px-2 py-5 md:px-4';

    expect($alert->getMainClasses())->toBe($expect);
});

it('should return footer classes', function () {
    $alert = new Card();

    $expect = 'bg-secondary-50 dark:bg-secondary-800 px-4 py-4 sm:px-6 rounded-t-none border-t border-secondary-200 dark:border-secondary-600 rounded-lg';

    expect($alert->getFooterClasses())->toBe($expect);
});
