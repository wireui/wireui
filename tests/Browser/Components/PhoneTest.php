<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class PhoneTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $phone = null;

            public $customPhone = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Phone Browser test</h1>

                    // test it_should_type_formatted_phone_number
                    <span dusk="phone">{{ $phone }}</span>

                    <x-phone
                        label="Phone"
                        wire:model.live="phone"
                        emit-formatted
                   />

                   // test it_should_type_custom_masked_phone_number
                    <span dusk="customPhone">{{ $customPhone }}</span>

                    <x-phone
                        label="Custom Phone"
                        wire:model.live="customPhone"
                        :mask="['(##) ####-####', '(##) #####-####']"
                        emit-formatted
                   />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_type_formatted_phone_number(): void
    {
        $this->browser()
            ->type('phone', '0123456789')
            ->waitTo(function (Browser $browser) {
                return $browser->assertSeeIn('@phone', '(012) 345-6789');
            })
            ->type('phone', '01234567890')
            ->waitTo(function (Browser $browser) {
                return $browser->assertSeeIn('@phone', '+0 123 456-7890');
            })->type('phone', '012345678901')
            ->waitTo(function (Browser $browser) {
                return $browser->assertSeeIn('@phone', '+01 23 4567-8901');
            });
    }

    public function test_it_should_type_custom_masked_phone_number(): void
    {
        $this->browser()
            ->type('customPhone', '0123456789')
            ->waitTo(function (Browser $browser) {
                return $browser->assertSeeIn('@customPhone', '(01) 2345-6789');
            })
            ->type('customPhone', '01234567890')
            ->waitTo(function (Browser $browser) {
                return $browser->assertSeeIn('@customPhone', '(01) 23456-7890');
            });
    }
}
