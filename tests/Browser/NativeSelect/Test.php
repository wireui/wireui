<?php

namespace Tests\Browser\NativeSelect;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_select_with_slot_options_and_show_error_message()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSelectHasOptions('model', ['Slot Option 1', 'Slot Option 2', 'Slot Option 3'])
                ->select('model', 'Slot Option 2')
                ->assertSelected('model', 'Slot Option 2')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@value', 'Slot Option 2'))
                ->select('model', '')
                ->click('@validate')
                ->waitUsing(5, 75, fn () => $browser->assertSeeNothingIn('@value')->assertSee('select a value'));
        });
    }

    /** @test */
    public function it_should_render_select_with_give_array_options()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSelectHasOptions('arrayOptionsModel', Component::ARRAY_OPTIONS);
        });
    }

    /** @test */
    public function it_should_render_select_with_give_collection_options()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSelectHasOptions('collectionOptionsModel', Component::collectionOptions()->values()->toArray());
        });
    }

    /** @test */
    public function it_should_render_select_with_give_array_options_with_label_and_option_keys()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSelectHasOptions('arrayWithLabelAndValueKeys', [
                    'Label Option 1' => 1,
                    'Label Option 2' => 2,
                    'Label Option 3' => 3,
                ]);
        });
    }

    /** @test */
    public function it_should_render_select_with_give_array_options_using_key_as_value()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSelectHasOptions('option-key-value', [
                    'Array Option 1' => 0,
                    'Array Option 2' => 1,
                    'Array Option 3' => 2,
                ]);
        });
    }

    /** @test */
    public function it_should_render_select_with_give_array_options_using_key_as_label()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSelectHasOptions('option-key-label', [
                    0 => 'Array Option 1',
                    1 => 'Array Option 2',
                    2 => 'Array Option 3',
                ]);
        });
    }
}
