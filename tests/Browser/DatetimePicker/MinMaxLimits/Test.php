<?php

namespace Tests\Browser\DatetimePicker\MinMaxLimits;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /**
     * @test
     * @dataProvider datesProvider
     */
    public function it_should_select_only_the_dates_inside_a_range_min_and_max(
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

    /**
     * @test
     * @dataProvider timesProvider
     */
    public function it_should_select_only_times_inside_the_limit(
        int $day,
        string $time,
        bool $exists
    ) {
        $this->browse(
            fn (Browser $browser) => $this
                ->visit($browser, Component::class)
                ->click('[name="model"]')
                ->tap(fn () => $this->selectDate($browser, $day))
                ->waitUsing(7, 100, fn () => $browser->assertScript(
                    "!!document.querySelector('[name=\"times.{$time}\"]')",
                    $exists
                ))
        );
    }

    public function datesProvider(): array
    {
        return [
            ['disabled' => true,  'day' => 1,  'model' => '',                     'input' => ''],
            ['disabled' => true,  'day' => 7,  'model' => '',                     'input' => ''],
            ['disabled' => false, 'day' => 8,  'model' => '2021-12-08T10:30:00Z', 'input' => '12/8/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 16, 'model' => '2021-12-16T10:30:00Z', 'input' => '12/16/2021, 10:30 AM'],
            ['disabled' => false, 'day' => 22, 'model' => '2021-12-22T10:30:00Z', 'input' => '12/22/2021, 10:30 AM'],
            ['disabled' => true,  'day' => 23, 'model' => '',                     'input' => ''],
            ['disabled' => true,  'day' => 30, 'model' => '',                     'input' => ''],
        ];
    }

    public function timesProvider(): array
    {
        return [
            ['day' => 8,  'time' => '12:30', 'exists' => true],
            ['day' => 16, 'time' => '12:30', 'exists' => true],
            ['day' => 22, 'time' => '12:30', 'exists' => true],

            ['day' => 8,  'time' => '00:00', 'exists' => false],
            ['day' => 16, 'time' => '00:00', 'exists' => true],
            ['day' => 22, 'time' => '00:00', 'exists' => true],

            ['day' => 8,  'time' => '15:30', 'exists' => true],
            ['day' => 16, 'time' => '15:30', 'exists' => true],
            ['day' => 22, 'time' => '15:30', 'exists' => true],

            ['day' => 8,  'time' => '15:00', 'exists' => true],
            ['day' => 16, 'time' => '15:00', 'exists' => true],
            ['day' => 22, 'time' => '15:00', 'exists' => false],
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
