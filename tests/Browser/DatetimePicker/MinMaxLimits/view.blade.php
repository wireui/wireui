<div>
    <span dusk="value">{{ $model }}</span>

    <x-datetime-picker
        wire:model="model"
        without-timezone
        :min="$date->copy()->subDays(7)->setHour(12)->toISOString()"
        :max="$date->copy()->addDays(7)->setHour(15)->toISOString()"
    />
</div>
