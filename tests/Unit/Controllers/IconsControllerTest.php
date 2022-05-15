<?php

namespace Tests\Unit\Controllers;

use Illuminate\Support\{Collection, Str};
use Symfony\Component\Finder\{Finder, SplFileInfo};
use Tests\Unit\UnitTestCase;

class IconsControllerTest extends UnitTestCase
{
    public function test_it_should_assert_icon_is_found()
    {
        $this->getJson(route('wireui.icons', ['style' => 'outline', 'icon' => 'user']))
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/svg+xml; charset=utf-8')
            ->assertHeader('Cache-Control', 'max-age=31536000, only-if-cached, public')
            ->assertSee('<svg', escape: false);
    }

    /**
     * @test
     * @dataProvider iconsProvider
     */
    public function test_it_should_ensure_($style, $icon)
    {
        $this->getJson(route('wireui.icons', ['style' => $style, 'icon' => $icon]))
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'image/svg+xml; charset=utf-8')
            ->assertHeader('Cache-Control', 'max-age=31536000, only-if-cached, public')
            ->assertSee('<svg', escape: false);
    }

    public function iconsProvider(): array
    {
        return collect([
            $this->mapIcons('solid'),
            $this->mapIcons('outline'),
        ])->collapse()->toArray();
    }

    public function mapIcons(string $style): Collection
    {
        $files = (new Finder())->files()->in(__DIR__ . "/../../../resources/views/components/icons/{$style}");

        return collect($files)->map(fn (SplFileInfo $file) => [
            'style' => $style,
            'icon'  => Str::before($file->getFilename(), '.blade.php'),
        ]);
    }

    public function test_it_should_assert_icon_is_not_found()
    {
        $this->getJson(route('wireui.icons', ['style' => 'outline', 'icon' => 'invalid-icon-name']))
            ->assertStatus(404)
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeader('Cache-Control', 'no-cache, private')
            ->assertExactJson([
                'message' => 'Icon "invalid-icon-name" not found.',
            ]);
    }
}
