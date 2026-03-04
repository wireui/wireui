<?php

namespace Tests\Unit\Controllers;

use Illuminate\Support\{Collection, Str};
use Symfony\Component\Finder\{Finder, SplFileInfo};

test('it should assert icon is found', function () {
    $this->getJson(route('wireui.icons', ['style' => 'outline', 'icon' => 'user']))
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'image/svg+xml; charset=utf-8')
        ->assertHeader('Cache-Control', 'max-age=31536000, only-if-cached, public')
        ->assertSee('<svg', escape: false);
});

test('it should ensure icon can render', function (string $style, string $icon) {
    $this->getJson(route('wireui.icons', ['style' => $style, 'icon' => $icon]))
        ->assertStatus(200)
        ->assertHeader('Content-Type', 'image/svg+xml; charset=utf-8')
        ->assertHeader('Cache-Control', 'max-age=31536000, only-if-cached, public')
        ->assertSee('<svg', escape: false);
})->with((function (): array {
    $mapIcons = function (string $style): Collection {
        $files = (new Finder())->files()->in(__DIR__ . "/../../../resources/views/components/icons/{$style}");

        return collect($files)->map(fn (SplFileInfo $file) => [
            $style,
            Str::before($file->getFilename(), '.blade.php'),
        ]);
    };

    return collect([
        $mapIcons('solid'),
        $mapIcons('outline'),
    ])->collapse()->values()->all();
})());

test('it should assert icon is not found', function () {
    $this->getJson(route('wireui.icons', ['style' => 'outline', 'icon' => 'invalid-icon-name']))
        ->assertStatus(404)
        ->assertHeader('Content-Type', 'application/json')
        ->assertHeader('Cache-Control', 'no-cache, private')
        ->assertExactJson([
            'message' => 'Icon "invalid-icon-name" not found.',
        ]);
});
