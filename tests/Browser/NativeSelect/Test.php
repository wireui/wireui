<?php

namespace Tests\Browser\NativeSelect;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    public function test_it_should_render_select_with_slot_options_and_show_error_message()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'NativeSelect.view')
                ->assertSelectHasOptions('model', ['Slot Option 1', 'Slot Option 2', 'Slot Option 3'])
                ->select('model', 'Slot Option 2')
                ->assertSelected('model', 'Slot Option 2')
                ->waitForTextIn('@value', 'Slot Option 2')
                ->select('model', '')
                ->assertSelected('model', '')
                ->click('@validate')
                ->waitUsing(7, 100, fn () => $browser->assertSeeNothingIn('@value'))
                ->waitForText('select a value')
                ->assertSee('select a value');
        });
    }

    public function test_it_should_render_select_with_give_array_options()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'NativeSelect.view')
                ->assertSelectHasOptions('arrayOptionsModel', [
                    'Array Option 1',
                    'Array Option 2',
                    'Array Option 3',
                ]);
        });
    }

    public function test_it_should_render_select_with_give_collection_options()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'NativeSelect.view')
                ->assertSelectHasOptions('collectionOptionsModel', collect([
                    'Collection Option 1',
                    'Collection Option 2',
                    'Collection Option 3',
                ])->values()->toArray());
        });
    }

    public function test_it_should_render_select_with_give_array_options_with_label_and_option_keys()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'NativeSelect.view')
                ->assertSelectHasOptions('arrayWithLabelAndValueKeys', [
                    'Label Option 1' => 1,
                    'Label Option 2' => 2,
                    'Label Option 3' => 3,
                ]);
        });
    }

    public function test_it_should_render_select_with_give_array_options_using_key_as_value()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'NativeSelect.view')
                ->assertSelectHasOptions('option-key-value', [
                    'Array Option 1' => 0,
                    'Array Option 2' => 1,
                    'Array Option 3' => 2,
                ]);
        });
    }

    public function test_it_should_render_select_with_give_array_options_using_key_as_label()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'NativeSelect.view')
                ->assertSelectHasOptions('option-key-label', [
                    0 => 'Array Option 1',
                    1 => 'Array Option 2',
                    2 => 'Array Option 3',
                ]);
        });
    }
}
