<?php

namespace WireUi\Components\TextField\tests\Browser;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class PasswordTest extends BrowserTestCase
{
    public function test_it_should_see_label_and_corner(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-password label="Input 1" corner="Corner 1" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    public function test_it_should_see_description_and_prefix_and_not_see_suffix(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-password
                        label="Input 1"
                        corner="Corner 1"
                        prefix="Prefix 1"
                        suffix="Suffix 1"
                        description="Description 1"
                    />
                </div>
                BLADE;
            }
        })
            ->assertSee('Prefix 1')
            ->assertSee('Description 1')
            ->assertDontSee('Suffix 1');
    }

    public function test_it_should_not_see_prepend_and_append_slots(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-password>
                        <x-slot name="prepend">
                            <a>prepend 1</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 1</a>
                        </x-slot>
                    </x-password>
                </div>
                BLADE;
            }
        })
            ->assertSee('prepend 1')
            ->assertDontSee('append 1')
            ->assertSeeHtml('<a>prepend 1</a>')
            ->assertDontSeeHtml('<a>append 1</a>');
    }

    public function test_it_should_see_prefix_and_not_see_suffix_instead_append_or_prepend_slots(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-password prefix="prefix 2" suffix="suffix 2">
                        <x-slot name="prepend">
                            <a>prepend 2</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 2</a>
                        </x-slot>
                    </x-password>
                </div>
                BLADE;
            }
        })
            ->assertDontSee('prefix 2')
            ->assertDontSee('suffix 2')
            ->assertSeeHtml('<a>prepend 2</a>')
            ->assertDontSeeHtml('<a>append 2</a>');
    }

    public function test_it_should_see_input_error(): void
    {
        Livewire::test(new class extends Component
        {
            #[Validate('required', message: 'input cant be empty')]
            public $model = null;

            public function save(): void
            {
                $this->validate();
            }

            public function clear(): void
            {
                $this->resetValidation();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-password wire:model.live="model" label="Model Input" />
                </div>
                BLADE;
            }
        })
            ->call('save')
            ->assertSee('input cant be empty')
            ->call('clear')
            ->assertDontSee('input cant be empty');
    }

    public function test_it_should_set_model_value_to_livewire(): void
    {
        Livewire::visit(new class extends Component
        {
            public $password = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$password" />

                    <x-password wire:model.live="password" label="Model Input" />
                </div>
                BLADE;
            }
        })
            ->type('password', 'password')
            ->waitForTextIn('@value', 'password');
    }

    public function test_it_should_change_the_input_type_when_clicking_on_the_view_password_icon(): void
    {
        Livewire::visit(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-password wire:key="password" name="password" label="Show Password" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Show Password')
            ->assertAttribute('input[name="password"]', 'type', 'password')
            ->assertInputValue('password', '')
            ->type('password', 'secret')
            ->assertDontSee('secret')
            ->click('div[wire\\:key="password"] > label > div[name="form.wrapper.container.append"] > button > svg:not([style*=\'none\'])')
            ->assertAttribute('input[name="password"]', 'type', 'text')
            ->assertInputValue('password', 'secret');
    }
}
