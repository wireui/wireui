<?php

namespace Tests\Browser\Errors;

use Livewire\Volt\Volt;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    public function test_it_should_render_all_errors_and_render_filtered_errors()
    {
        Volt::test('Errors.view')
            ->call('addErrors')
            ->assertSee('first error')
            ->assertSee('second error')
            ->assertSee('third error')
            ->assertHasErrors(['first', 'second', 'third'])
            ->call('addFilterErrors')
            ->assertSee('first error')
            ->assertSee('second error')
            ->assertDontSee('third error')
            ->assertHasErrors(['first', 'second', 'third']);
    }
}
