<?php

namespace Tests\Browser\DatetimePicker;

class Component extends \Livewire\Component
{
    public ?string $withoutTimezone = '2021-05-22T02:48';

    public ?string $utcTimezone = '2021-07-22 00:30';

    public ?string $tokyoTimezone = '2021-07-26 10:00';

    public ?string $customFormat = '29-2021-09 59:13';

    public ?string $dateAndTime = '2021-12-25 00:00';

    public function render()
    {
        return <<<BLADE
        <div>
            <h1>Datetime Picker test</h1>

            // test it_should_select_date_without_timezone_difference
            <div id="withoutTimezone">
                <x-datetime-picker
                    wire:model="withoutTimezone"
                    without-timezone
                    label="Without Timezone"
                    display-format="YYYY-MM-DD HH:mm"
                />
                <span dusk="withoutTimezone">{{ \$withoutTimezone }}</span>
            </div>

            // test it_should_select_date_with_utc_timezone_difference
            <div id="utcTimezone">
                <x-datetime-picker
                    wire:model="utcTimezone"
                    label="UTC Timezone"
                    {{-- the user's timezone is automatic, but I need to mock the timezone in the tests --}}
                    user-timezone="America/Sao_Paulo"
                    display-format="YYYY-MM-DD HH:mm"
                />
                <span dusk="utcTimezone">{{ \$utcTimezone }}</span>
            </div>

            // test it_should_select_date_with_default_timezone_and_auto_user_timezone
            <div id="tokyoTimezone">
                <x-datetime-picker
                    wire:model="tokyoTimezone"
                    timezone="Asia/Tokyo"
                    {{-- the user's timezone is automatic, but I need to mock the timezone in the tests --}}
                    user-timezone="America/Sao_Paulo"
                    label="Asia/Tokyo Timezone"
                    display-format="YYYY-MM-DD HH:mm"
                />
                <span dusk="tokyoTimezone">{{ \$tokyoTimezone }}</span>
            </div>

            // test it_should_parse_date_in_custom_format
            <div id="customFormat">
                <x-datetime-picker
                    wire:model="customFormat"
                    parse-format="DD-YYYY-MM mm:HH"
                    without-timezone
                    label="Custom Format Parse"
                    display-format="DD-YYYY-MM mm:HH"
                />
                <span dusk="customFormat">{{ \$customFormat }}</span>
            </div>

            // test it_should_select_date_and_time
            <div id="dateAndTime">
                <x-datetime-picker
                    wire:model="dateAndTime"
                    without-timezone
                    label="Date and Time"
                    display-format="DD-MM-YYYY HH:mm"
                />
                <span dusk="dateAndTime">{{ \$dateAndTime }}</span>
            </div>
        </div>
        BLADE;
    }
}
