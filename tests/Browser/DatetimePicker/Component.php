<?php

namespace Tests\Browser\DatetimePicker;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public ?string $withoutTimezone = '2021-05-22T02:48';

    public ?string $utcTimezone = '2021-07-22 00:30';

    public ?string $tokyoTimezone = '2021-07-26 10:00';

    public ?string $customFormat = '29-2021-09 59:13';

    public ?string $dateAndTime = '2021-12-25 00:00';

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}
