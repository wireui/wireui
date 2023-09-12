<?php

namespace Tests\Unit\Actions;

use WireUi\Enum\Actions;

dataset('dialog::event', [
    ['home', 'home'],
    [null, Actions::INFO->value],
]);

dataset('dialog::confirm::event', [
    ['home', 'home'],
    [null, Actions::QUESTION->value],
]);

dataset('simple::dialog::event', [
    [Actions::SUCCESS->value],
    [Actions::ERROR->value],
    [Actions::INFO->value],
    [Actions::WARNING->value],
]);

dataset('notification::event', [
    ['home', 'home'],
    [null, Actions::QUESTION->value],
]);

dataset('simple::notification::event', [
    [Actions::SUCCESS->value],
    [Actions::ERROR->value],
    [Actions::INFO->value],
    [Actions::WARNING->value],
]);
