<?php

namespace Tests\Browser\Badge;

use Livewire\Livewire;

test('it should render badges without errors', function () {
    Livewire::test(Component::class)
        ->assertSee('Label')
        ->assertSee('Primary')
        ->assertSee('Secondary')
        ->assertSee('Positive')
        ->assertSee('Negative')
        ->assertSee('Info')
        ->assertSee('Dark');
});
