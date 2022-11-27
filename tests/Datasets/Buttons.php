<?php

use Illuminate\Support\Collection;
use WireUi\Support\Buttons\Colors\{ColorPack, Flat, Outline, Solid};
use WireUi\Support\Buttons\Sizes\Base;

dataset('buttons::variant-color', function () {
    return collect([Solid::class, Outline::class, Flat::class])
        ->flatMap(function (string $class): Collection {
            /** @var ColorPack $colorPack */
            $colorPack = new $class();

            return collect($colorPack->keys())->map(function (string $color) use ($class): array {
                $variant = strtolower(class_basename($class));

                return [$class, $variant, $color];
            });
        })
        ->toArray();
});

dataset('buttons::sizes', fn () => (new Base())->keys());
