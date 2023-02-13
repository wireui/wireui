<div>
    <h1>Time Picker test</h1>

    // test it_should_select_time_and_clear_am_pm_time
    <x-time-picker placeholder="12:00 AM" wire:model="timeAmPm" label="Time AM/PM" />
    <span dusk="timeAmPm">{{ $timeAmPm }}</span>

    // test it_should_select_time_and_clear_24h_time
    <x-time-picker format="24" placeholder="12:00" wire:model="time24H" label="Time 24H" />
    <span dusk="time24H">{{ $time24H }}</span>

    // test it_should_select_time_using_model_property_datetime
    <button dusk="refresh" wire:click="$refresh">$refresh</button>
    <x-time-picker placeholder="12:00" wire:model.defer="user.birthday" label="Model Property" />
    <span dusk="user.birthday">{{ $user ??= $user->birthday->format('H:i') }}</span>
</div>
