<?php

namespace WireUi\Components\TextField\tests\Browser;

use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class PhoneTest extends BrowserTestCase
{
    public function test_it_should_type_formatted_phone_number(): void
    {
        Livewire::visit(new class extends Component
        {
            public $phone = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$phone" />

                    <x-phone dusk="phone" wire:model.live="phone" label="Phone" emit-formatted />
                </div>
                BLADE;
            }
        })
            ->type('@phone', '0123456789')
            ->waitForTextIn('@value', '(012) 345-6789')
            ->type('@phone', '01234567890')
            ->waitForTextIn('@value', '+0 123 456-7890')
            ->type('@phone', '012345678901')
            ->waitForTextIn('@value', '+01 23 4567-8901');
    }

    public function test_it_should_type_custom_masked_phone_number(): void
    {
        Livewire::visit(new class extends Component
        {
            public $phone = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$phone" />

                    <x-phone
                        dusk="phone"
                        wire:model.live="phone"
                        label="Phone"
                        :mask="['(##) ####-####', '(##) #####-####']"
                        emit-formatted
                    />
                </div>
                BLADE;
            }
        })
            ->type('@phone', '0123456789')
            ->waitForTextIn('@value', '(01) 2345-6789')
            ->type('@phone', '01234567890')
            ->waitForTextIn('@value', '(01) 23456-7890');
    }
}
