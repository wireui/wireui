<?php

namespace WireUi\Components\DatetimePicker\tests\Unit;

use Illuminate\Support\Carbon;
use WireUi\Components\DatetimePicker\Picker as DatetimePicker;
use WireUi\Components\Wrapper\WireUi\Color;
use WireUi\Components\Wrapper\WireUi\Rounded;
use WireUi\WireUi\Shadow;

beforeEach(function () {
    $this->component = (new DatetimePicker)->withName('datetime-picker');
});

test('it should have array properties', function () {
    $packs = $this->invokeProperty($this->component, 'packs');

    expect($packs)->toBe([]);

    $props = $this->invokeProperty($this->component, 'props');

    expect($props)->toBe([
        'max' => null,
        'min' => null,
        'label' => null,
        'interval' => 10,
        'max-time' => 24,
        'min-time' => 0,
        'multiple' => false,
        'timezone' => null,
        'clearable' => true,
        'right-icon' => 'calendar',
        'time-format' => 12,
        'multiple-max' => 0,
        'parse-format' => null,
        'without-time' => false,
        'without-tips' => false,
        'allowed-dates' => [],
        'start-of-week' => Carbon::SUNDAY,
        'user-timezone' => null,
        'disabled-dates' => [],
        'disabled-years' => [],
        'display-format' => null,
        'disabled-months' => [],
        'without-timezone' => false,
        'disabled-weekdays' => [],
        'disable-past-dates' => false,
        'without-time-seconds' => false,
        'requires-confirmation' => false,
    ]);
});

test('it should have properties in component', function () {
    $this->runWireUiComponent($this->component);

    expect($this->component)->toHaveProperties([
        // Props
        'max',
        'min',
        'maxTime',
        'minTime',
        'interval',
        'multiple',
        'timezone',
        'clearable',
        'rightIcon',
        'timeFormat',
        'multipleMax',
        'parseFormat',
        'startOfWeek',
        'withoutTime',
        'withoutTips',
        'allowedDates',
        'userTimezone',
        'displayFormat',
        'disabledDates',
        'disabledYears',
        'disabledMonths',
        'withoutTimezone',
        'disabledWeekdays',
        'disablePastDates',
        'withoutTimeSeconds',
        'requiresConfirmation',
        // Packs
        'color',
        'rounded',
        'squared',
        'colorClasses',
        'roundedClasses',
    ]);

    expect($this->component->rightIcon)->toBe('calendar');
});

test('it should set random color in component', function () {
    $pack = $this->getRandomPack(Color::class);

    $this->setAttributes($this->component, [
        'color' => $color = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->color)->toBe($color);
    expect($this->component->colorClasses)->toBe($class);

    expect('<x-datetime-picker :$color />')
        ->render(compact('color'))
        ->toContain(data_get($class, 'input'));
});

test('it should set random shadow in component', function () {
    $pack = $this->getRandomPack(Shadow::class);

    $this->setAttributes($this->component, [
        'shadow' => $shadow = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    expect('<x-datetime-picker :$shadow />')
        ->render(compact('shadow'))
        ->toContain(data_get($pack, 'class'));
});

test('it should set random rounded in component', function () {
    $pack = $this->getRandomPack(Rounded::class);

    $this->setAttributes($this->component, [
        'rounded' => $rounded = data_get($pack, 'key'),
    ]);

    $this->runWireUiComponent($this->component);

    $class = data_get($pack, 'class');

    expect($this->component->squared)->toBeFalse();
    expect($this->component->rounded)->toBe($rounded);
    expect($this->component->roundedClasses)->toBe($class);

    expect('<x-datetime-picker :$rounded />')
        ->render(compact('rounded'))
        ->toContain(data_get($class, 'input'));
});
