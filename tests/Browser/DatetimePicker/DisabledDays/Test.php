<?php

namespace Tests\Browser\DatetimePicker\DisabledDays;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /**
     * @test
     * @dataProvider datesProvider
     */
    public function it_should_not_select_disabled_days(
        bool $disabled,
        int $day,
        string $model,
        string $input
    ) {
        $this->browse(function (Browser $browser) use ($disabled, $day, $model, $input) {
            /** @var Browser|TestableLivewire $component */
            $component = $this->visit($browser, Component::class)
                ->click('[name="model"]')
                ->tap(fn () => $browser->assertScript(<<<EOT
                    [...document.querySelectorAll('.picker-days button')]
                        .find(day => day.innerText == {$day})
                        .hasAttribute('disabled')
                EOT, $disabled))
                ->tap(fn () => $this->selectDate($browser, $day));

            if (!$disabled) {
                $component
                    ->waitForTextIn('@value', $model)
                    ->assertInputValue('model', $input);
            }
        });
    }

    public function datesProvider(): array
    {
        return [
            ['disabled' => true,  'day' => 9,   'model' => '',                     'input' => ''],
            ['disabled' => false, 'day' => 13,  'model' => '2021-06-13T10:30:00Z', 'input' => '6/13/2021, 10:30 AM'],
            ['disabled' => true,  'day' => 14,  'model' => '',                     'input' => ''],
            ['disabled' => true,  'day' => 15,  'model' => '',                     'input' => ''],
            ['disabled' => false, 'day' => 16,  'model' => '2021-06-16T10:30:00Z', 'input' => '6/16/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 17,  'model' => '2021-06-17T10:30:00Z', 'input' => '6/17/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 18,  'model' => '2021-06-18T10:30:00Z', 'input' => '6/18/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 19,  'model' => '2021-06-19T10:30:00Z', 'input' => '6/19/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 20,  'model' => '2021-06-20T10:30:00Z', 'input' => '6/20/2021, 10:30 AM'],
            ['disabled' => true,  'day' => 21,  'model' => '',                     'input' => ''],
        ];
    }

    private function selectDate(Browser $browser, int $day): array
    {
        return $browser->script(<<<EOT
            [...document.querySelectorAll('.picker-days button')]
                .find(day => day.innerText == {$day})
                .click()
        EOT);
    }
}
