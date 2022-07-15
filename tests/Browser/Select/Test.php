<?php

namespace Tests\Browser\Select;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_show_validation_message()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->click('@validate')
                ->waitUsing(7, 100, fn () => $browser->assertSee('Select any value'));
        });
    }

    /** @test */
    public function it_should_select_one_option_from_simples_options_list()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelector('input[name="model"]').click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('[name="wireui.select.options.model"]', 'Array Option 2'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelectorAll('[name="wireui.select.options.model"] li')[1].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model', 'Array Option 2'))
                ->tap(fn (Browser $browser) => $browser->openSelect('model'))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('[name="wireui.select.options.model"]', 'Array Option 1'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelectorAll('[name="wireui.select.options.model"] li')[0].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model', 'Array Option 1'));
        });
    }

    /** @test */
    public function it_should_select_one_option_from_labeled_options_list()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->openSelect('model2'))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('[name="wireui.select.options.model2"]', 'Label Option 2'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelectorAll('[name="wireui.select.options.model2"] li')[1].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model2', '2'))
                ->waitUsing(7, 100, fn () => $browser->assertInputValue('model2', '2'))
                ->tap(fn (Browser $browser) => $browser->openSelect('model2'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelectorAll('[name="wireui.select.options.model2"] li')[0].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model2', '1'));
        });
    }

    /** @test */
    public function it_should_select_and_unselect_multiples_options()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelector('input[name="model3"]').click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSee('A'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    const ul = document.querySelector('ul[name="wireui.select.options.model3"]');
                    ul.querySelectorAll('li')[0].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model3', 'A'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    const ul = document.querySelector('ul[name="wireui.select.options.model3"]');
                    ul.querySelectorAll('li')[1].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model3', 'A,B'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    const ul = document.querySelector('ul[name="wireui.select.options.model3"]');
                    ul.querySelectorAll('li')[0].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model3', 'B'));
        });
    }

    /** @test */
    public function it_should_select_from_slot_list()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelector('input[name="model4"]').click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSee('Option E'))
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    const ul = document.querySelector('ul[name="wireui.select.options.model4"]');

                    ul.querySelectorAll('li')[1].click();
                JS))
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@model4', 'E'));
        });
    }

    /** @test */
    public function it_should_cannot_select_readonly_and_disabled_options()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    document.querySelector('input[name="model5"]').click();
                JS))
                ->waitForText('Normal Option 3')
                ->assertSee('Normal Option 3')
                ->tap(fn (Browser $browser) => $browser->script(<<<JS
                    const ul = document.querySelector('ul[name="wireui.select.options.model5"]');

                    ul.querySelectorAll('li')[2].click();
                    ul.querySelectorAll('li')[1].click();
                    ul.querySelectorAll('li')[0].click();
                JS))
                ->waitForTextIn('@model5', 'normal')
                ->assertSeeIn('@model5', 'normal');
        });
    }

    /** @test */
    public function it_should_load_and_search_options_from_the_api()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->openSelect('asyncModel')
                ->waitUsing(7, 100, fn () => $browser->assertSee('Pedro'))
                ->wireuiSelectValue('asyncModel', 0)
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@asyncModel', 1))
                ->openSelect('asyncModel')
                ->waitUsing(7, 100, fn () => $browser->assertSee('Pedro'))
                ->typeSlowly('div[wire\\:key="asyncModel"] input[x-ref="search"]', 'kei')
                ->pause(1000)
                ->assertSee('Keithy')
                ->wireuiSelectValue('asyncModel', 0)
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@asyncModel', 2));
        });
    }
}
