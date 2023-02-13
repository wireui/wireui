<?php

use WireUi\Support\Alerts\{Config, Values};

it('should return a json string with the values passed', function () {
    $data = new Config(
        icon: 'icon',
        iconColor: 'iconColor',
        textColor: 'textColor',
        borderColor: 'borderColor',
        backgroundColor: 'backgroundColor',
    );

    $expect = json_encode([
        'icon'            => 'icon',
        'iconColor'       => 'iconColor',
        'textColor'       => 'textColor',
        'borderColor'     => 'borderColor',
        'backgroundColor' => 'backgroundColor',
    ]);

    expect((string) $data)->toBe($expect);

    expect($data->toString())->toBe($expect);
});

it('should return the a default color', function () {
    $values = new Values();

    $expect = json_encode([
        'icon'            => 'bell',
        'iconColor'       => 'text-primary-400 dark:text-primary-600',
        'textColor'       => 'text-primary-800 dark:text-primary-600',
        'borderColor'     => 'border-primary-200 dark:border-primary-600',
        'backgroundColor' => 'bg-primary-50 dark:bg-secondary-800',
    ]);

    expect($values->default()->toString())->toBe($expect);
    expect($values->get(null)->toString())->toBe($expect);
    expect($values->get('default')->toString())->toBe($expect);
});

it('should return the all colors', function () {
    $values = new Values();

    expect($values->all())->toBeTruthy();

    $positive = json_encode([
        'icon'            => 'check-circle',
        'iconColor'       => 'text-positive-400 dark:text-positive-600',
        'textColor'       => 'text-positive-800 dark:text-positive-600',
        'borderColor'     => 'border-positive-200 dark:border-positive-600',
        'backgroundColor' => 'bg-positive-50 dark:bg-secondary-800',
    ]);

    $negative = json_encode([
        'icon'            => 'x-circle',
        'iconColor'       => 'text-negative-400 dark:text-negative-600',
        'textColor'       => 'text-negative-800 dark:text-negative-600',
        'borderColor'     => 'border-negative-200 dark:border-negative-600',
        'backgroundColor' => 'bg-negative-50 dark:bg-secondary-800',
    ]);

    $warning = json_encode([
        'icon'            => 'exclamation-triangle',
        'iconColor'       => 'text-warning-400 dark:text-warning-600',
        'textColor'       => 'text-warning-800 dark:text-warning-600',
        'borderColor'     => 'border-warning-200 dark:border-warning-600',
        'backgroundColor' => 'bg-warning-50 dark:bg-secondary-800',
    ]);

    $info = json_encode([
        'icon'            => 'information-circle',
        'iconColor'       => 'text-info-400 dark:text-info-600',
        'textColor'       => 'text-info-800 dark:text-info-600',
        'borderColor'     => 'border-info-200 dark:border-info-600',
        'backgroundColor' => 'bg-info-50 dark:bg-secondary-800',
    ]);

    expect($values->get('positive')->toString())->toBe($positive);
    expect($values->get('negative')->toString())->toBe($negative);
    expect($values->get('warning')->toString())->toBe($warning);
    expect($values->get('info')->toString())->toBe($info);
});

it('should return the the colors keys', function () {
    $values = new Values();

    expect($values->keys())
        ->toBeTruthy()
        ->toBeArray()
        ->toBe(['positive', 'negative', 'warning', 'info']);
});
