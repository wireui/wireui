<?php

namespace Tests\Browser\MaskableInput;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_start_input_with_formatted_value()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSeeIn('@singleMaskValue', '1234')
                ->assertInputValue('singleMask', '12.34');
        });
    }

    /** @test */
    public function it_should_type_input_value_and_emit_formatted_value()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->type('singleFormattedMask', '3245ABCD')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser
                        ->assertSeeIn('@singleFormattedMaskValue', '32.45.AB')
                        ->assertInputValue('singleFormattedMask', '32.45.AB');
                });
        });
    }

    /** @test */
    public function it_should_type_input_value_and_apply_multiples_masks()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->type('multipleMask', '9876')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@multipleMaskValue', '98.76');
                })
                ->type('multipleMask', '987662')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@multipleMaskValue', '98.76.62');
                })->type('multipleMask', '9876624')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSeeIn('@multipleMaskValue', '98.76.624');
                });
        });
    }
}
