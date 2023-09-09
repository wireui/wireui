<?php

use Illuminate\Support\{MessageBag, Str, ViewErrorBag};
use WireUi\View\Components\Errors;

it('should return empty class', function () {
    $errors = new Errors();

    expect($errors->icon)->toBe(null);
    expect($errors->title)->toBe(null);
    expect($errors->iconless)->toBe(false);
    expect($errors->borderless)->toBe(null);
    expect($errors->only->toArray())->toBe([]);
});

it('should treat variable only correctly', function () {
    $errors = new Errors(only: 'name1|name2|name3');

    expect($errors->only->toArray())->toBe(['name1', 'name2', 'name3']);

    $errors = new Errors(only: ['name1', 'name2', 'name3']);

    expect($errors->only->toArray())->toBe(['name1', 'name2', 'name3']);
});

it('should return the errors number, error messages and title correctly', function () {
    $errors = new Errors();

    $errorBag = new ViewErrorBag();

    $messages = new MessageBag([
        'error1' => 'message1',
        'error2' => 'message2',
        'error3' => 'message3',
    ]);

    $errorBag->put('default', $messages);

    expect($errors->count($errorBag))->toBe(3);

    expect($errors->getErrorMessages($errorBag)->toArray())->toBe([
        'error1' => ['message1'],
        'error2' => ['message2'],
        'error3' => ['message3'],
    ]);

    $title = Str::replace('{errors}', 3, trans_choice('wireui::messages.errors.title', 3));

    expect($errors->getTitle($errorBag))->toBe($title);
});
