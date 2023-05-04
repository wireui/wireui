<?php

use Illuminate\Support\HtmlString;
use WireUi\Support\Alerts\Values;
use WireUi\View\Components\Alert;

beforeEach(function () {
    $this->values = (array) json_decode((new Values())->get('default'));
});

it('should get the default settings', function () {
    $alert = new Alert();

    expect($alert->padding)->toBe(config('wireui.alert.padding'));
    expect($alert->shadow)->toBe(config('wireui.alert.shadow'));
    expect($alert->rounded)->toBe(config('wireui.alert.rounded'));
    expect($alert->borderless)->toBe(config('wireui.alert.borderless'));
});

it('should return alert classes', function () {
    $alert = new Alert();

    $expect = 'w-full flex flex-col p-4 dark:border bg-primary-50 dark:bg-secondary-800 border-primary-200 dark:border-primary-600 rounded-lg shadow-md';

    expect($alert->getAlertClasses($this->values))->toBe($expect);
});

it('should return header classes', function () {
    $alert = new Alert();

    $slot = new HtmlString('');

    $expect = 'flex justify-between items-center';

    expect($alert->getHeaderClasses($this->values, $slot))->toBe($expect);

    $slot = new HtmlString('test');

    $expect = 'border-b-2 border-primary-200 dark:border-primary-600 flex justify-between items-center pb-3';

    expect($alert->getHeaderClasses($this->values, $slot))->toBe($expect);
});

it('should return title classes', function () {
    $alert = new Alert();

    $expect = 'font-semibold text-sm whitespace-normal text-primary-800 dark:text-primary-600';

    expect($alert->getTitleClasses($this->values))->toBe($expect);
});

it('should return icon classes', function () {
    $alert = new Alert();

    $expect = 'w-5 h-5 mr-3 shrink-0 text-primary-400 dark:text-primary-600';

    expect($alert->getIconClasses($this->values))->toBe($expect);
});

it('should return main classes', function () {
    $alert = new Alert();

    $expect = 'text-primary-800 dark:text-primary-600 rounded-b-xl grow ml-5 text-sm pl-1 mt-2 ml-5';

    expect($alert->getMainClasses($this->values))->toBe($expect);
});

it('should return footer classes', function () {
    $alert = new Alert();

    $expect = 'mt-2 pt-2 rounded-t-none border-t-2 border-primary-200 dark:border-primary-600 rounded-lg';

    expect($alert->getFooterClasses($this->values))->toBe($expect);
});
