<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class SelectTest extends BrowserTestCase
{
    public function component(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $model = null;

            public $model2 = null;

            public $model3 = [];

            public $model4 = null;

            public $model5 = null;

            public $asyncModel = null;

            public $collectionOptions = null;

            public $asyncModelNestedData = null;

            public $options = [
                'Array Option 1',
                'Array Option 2',
                'Array Option 3',
            ];

            public $labelOptions = [
                ['label' => 'Label Option 1', 'value' => 1],
                ['label' => 'Label Option 2', 'value' => 2],
                ['label' => 'Label Option 3', 'value' => 3],
            ];

            public $disableOptions = [
                ['label' => 'Disabled Option 1', 'value' => 'disabled', 'disabled' => true],
                ['label' => 'Readonly Option 2', 'value' => 'readonly', 'readonly' => true],
                ['label' => 'Normal Option 3', 'value' => 'normal'],
            ];

            protected $rules = [
                'model' => 'required',
            ];

            protected $messages = [
                'model.required' => 'Select any value',
            ];

            public function mount()
            {
                $this->collectionOptions = collect([
                    ['label' => 'Option A', 'value' => 'A'],
                    ['label' => 'Option B', 'value' => 'B'],
                    ['label' => 'Option C', 'value' => 'C'],
                ]);
            }

            public function validateSelect()
            {
                $this->validate();
            }

            public function resetInputValidation()
            {
                $this->resetValidation();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Select test</h1>

                    <span dusk="model">{{ $model }}</span>
                    <span dusk="model2">{{ $model2 }}</span>
                    <span dusk="model3">{{ implode(',', $model3) }}</span>
                    <span dusk="model4">{{ $model4 }}</span>
                    <span dusk="model5">{{ $model5 }}</span>
                    <span dusk="asyncModel">{{ $asyncModel }}</span>

                    <button dusk="validate" wire:click="validateSelect">validate</button>

                    // test it_should_show_validation_message
                    // test it_should_select_one_option_from_simples_options_list
                    <x-select
                        :options="$options"
                        placeholder="Select Single Value"
                        label="Single Select"
                        wire:model.live="model"
                    />

                    // test it_should_select_one_option_from_labeled_options_list
                    <x-select
                        :options="$labelOptions"
                        placeholder="Select Single Value"
                        label="Single Select"
                        wire:model.live="model2"
                        option-label="label"
                        option-value="value"
                    />

                    // test it_should_select_and_unselect_multiples_options
                    <x-select
                        :options="$collectionOptions"
                        placeholder="Select Multiples Values"
                        multiselect
                        label="Multiple Select"
                        wire:model.live="model3"
                        option-label="label"
                        option-value="value"
                    />

                    // test it_should_select_from_slot_list
                    <x-select
                        placeholder="Slot Select"
                        label="Slot Select"
                        wire:model.live="model4"
                    >
                        <x-select.option label="Option D" value="D" />
                        <x-select.option label="Option E" value="E" />
                        <x-select.option label="Option F" value="F" />
                    </x-select>

                    // test it_should_cannot_select_readonly_and_disabled_options
                    <x-select
                        :options="$disableOptions"
                        placeholder="Select With Readonly/Disabled"
                        label="Select With Readonly/Disabled"
                        wire:model.live="model5"
                        option-label="label"
                        option-value="value"
                    />

                    // test it_should_load_and_search_options_from_the_api
                    <x-select
                        label="Select From Async data"
                        {{-- async-data="/api/options" --}}
                        :async-data="route('api.options')"
                        wire:model.live="asyncModel"
                        option-value="id"
                        option-label="name"
                        wire:key="asyncModel"
                    />

                    // test it_should_load_from_the_api_with_nested_data
                    <x-select
                        label="Select From Async data"
                        {{-- async-data="/api/options" --}}
                        :async-data="['api' => route('api.options.nested'), 'optionsPath' => 'data.nested']"
                        wire:model.live="asyncModelNestedData"
                        option-value="id"
                        option-label="name"
                        wire:key="asyncModelNestedData"
                    />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_show_validation_message(): void
    {
        $this->component()
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Select any value'));
    }

    public function test_it_should_select_one_option_from_simples_options_list(): void
    {
        $this->component()
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelector('input[name="model"]').click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('[name="wireui.select.options.model"] > ul', 'Array Option 2'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelectorAll('[name="wireui.select.options.model"] [select-option]')[1].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model', 'Array Option 2'))
            ->tap(fn (Browser $browser) => $browser->openSelect('model'))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('[name="wireui.select.options.model"] > ul', 'Array Option 1'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelectorAll('[name="wireui.select.options.model"] [select-option]')[0].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model', 'Array Option 1'));
    }

    public function test_it_should_select_one_option_from_labeled_options_list(): void
    {
        $this->component()
            ->tap(fn (Browser $browser) => $browser->openSelect('model2'))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('[name="wireui.select.options.model2"]', 'Label Option 2'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelectorAll('[name="wireui.select.options.model2"] [select-option]')[1].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model2', '2'))
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model2', '2'))
            ->tap(fn (Browser $browser) => $browser->openSelect('model2'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelectorAll('[name="wireui.select.options.model2"] [select-option]')[0].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model2', '1'));
    }

    public function test_it_should_select_and_unselect_multiples_options(): void
    {
        $this->component()
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelector('input[name="model3"]').click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSee('A'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                const el = document.querySelector('div[name="wireui.select.options.model3"]');
                el.querySelectorAll('[select-option]')[0].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model3', 'A'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                const el = document.querySelector('div[name="wireui.select.options.model3"]');
                el.querySelectorAll('[select-option]')[1].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model3', 'A,B'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                const el = document.querySelector('div[name="wireui.select.options.model3"]');
                el.querySelectorAll('[select-option]')[0].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model3', 'B'));
    }

    public function test_it_should_select_from_slot_list(): void
    {
        $this->component()
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelector('input[name="model4"]').click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Option E'))
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                const el = document.querySelector('div[name="wireui.select.options.model4"]');

                el.querySelectorAll('[select-option]')[1].click();
            JS))
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@model4', 'E'));
    }

    public function test_it_should_cannot_select_readonly_and_disabled_options(): void
    {
        $this->component()
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                document.querySelector('input[name="model5"]').click();
            JS))
            ->waitForText('Normal Option 3')
            ->assertSee('Normal Option 3')
            ->tap(fn (Browser $browser) => $browser->script(<<<JS
                const el = document.querySelector('div[name="wireui.select.options.model5"]');

                el.querySelectorAll('[select-option]')[2].click();
                el.querySelectorAll('[select-option]')[1].click();
                el.querySelectorAll('[select-option]')[0].click();
            JS))
            ->waitForTextIn('@model5', 'normal')
            ->assertSeeIn('@model5', 'normal');
    }

    public function test_it_should_load_and_search_options_from_the_api(): void
    {
        $this->component()
            ->openSelect('asyncModel')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Pedro'))
            ->wireuiSelectValue('asyncModel', 0)
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@asyncModel', 1))
            ->openSelect('asyncModel')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Pedro'))
            ->typeSlowly('div[wire\\:key="asyncModel"] input[x-ref="search"]', 'kei')
            ->pause(1000)
            ->assertSee('Keithy')
            ->wireuiSelectValue('asyncModel', 0)
            ->waitTo(fn (Browser $browser) => $browser->assertSeeIn('@asyncModel', 2));
    }

    public function test_it_should_load_from_the_api_with_nested_data(): void
    {
        $this->component()
            ->openSelect('asyncModelNestedData')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Tommy'));
    }
}
