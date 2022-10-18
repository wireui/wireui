<?php

use Illuminate\Support\Facades\Blade;

it('should render the badge slot', function () {
    $html = Blade::render('<x-badge><b>Label From Slot</b></x-badge>');

    expect($html)->toContain('<b>Label From Slot</b>');
});

it('should render the badge default', function () {
    $html = Blade::render('<x-badge label="default" />');

    expect($html)->toContain('default')->toContain('text-slate-500');
});

it('should render the badge primary', function () {
    $html = Blade::render('<x-badge label="primary" primary />');

    expect($html)->toContain('primary')->toContain('bg-primary-500');
});

it('should render the badge secondary', function () {
    $html = Blade::render('<x-badge label="secondary" secondary />');

    expect($html)->toContain('secondary')->toContain('bg-secondary-500');
});

it('should render the badge positive', function () {
    $html = Blade::render('<x-badge label="positive" positive />');

    expect($html)->toContain('positive')->toContain('bg-positive-500');
});

it('should render the badge negative', function () {
    $html = Blade::render('<x-badge label="negative" negative />');

    expect($html)->toContain('negative')->toContain('bg-negative-500');
});

it('should render the badge warning', function () {
    $html = Blade::render('<x-badge label="warning" warning />');

    expect($html)->toContain('warning')->toContain('bg-warning-500');
});

it('should render the badge info', function () {
    $html = Blade::render('<x-badge label="info" info />');

    expect($html)->toContain('info')->toContain('bg-info-500');
});

it('should render the badge dark', function () {
    $html = Blade::render('<x-badge label="dark" dark />');

    expect($html)->toContain('dark')->toContain('bg-gray-700');
});

it('should render the badge white', function () {
    $html = Blade::render('<x-badge label="white" white />');

    expect($html)->toContain('white')->toContain('bg-white');
});

it('should render the badge with prepend', function () {
    $html = <<<EOT
        <x-badge primary label="Prepend">
            <x-slot name="prepend">
                <b>Add Prepend</b>
            </x-slot>
        </x-badge>
    EOT;

    $html = Blade::render($html);

    expect($html)->toContain('Prepend')->toContain('<b>Add Prepend</b>');
});

it('should render the badge with append', function () {
    $html = <<<EOT
        <x-badge primary label="Append">
            <x-slot name="append">
                <b>Add Append</b>
            </x-slot>
        </x-badge>
    EOT;

    $html = Blade::render($html);

    expect($html)->toContain('Append')->toContain('<b>Add Append</b>');
});
