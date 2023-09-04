<?php

namespace Tests\Browser\Badge;

use Livewire\Volt\Volt;

test('it should render badges without errors', function () {
    Volt::test('Badge.view')
        ->assertSee('Label')
        ->assertSee('Primary')
        ->assertSee('Secondary')
        ->assertSee('Positive')
        ->assertSee('Negative')
        ->assertSee('Info')
        ->assertSee('Dark');
});
