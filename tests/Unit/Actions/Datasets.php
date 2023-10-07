<?php

namespace Tests\Unit\Actions;

use WireUi\Enum\Actions;

dataset('dialog::event', [
    ['home', 'home'],
    [null, Actions::INFO],
]);

dataset('dialog::confirm::event', [
    ['home', 'home'],
    [null, Actions::QUESTION],
]);

dataset('simple::dialog::event', [
    [Actions::SUCCESS],
    [Actions::ERROR],
    [Actions::INFO],
    [Actions::WARNING],
]);

dataset('notification::event', [
    ['home', 'home'],
    [null, Actions::QUESTION],
]);

dataset('simple::notification::event', [
    [Actions::SUCCESS],
    [Actions::ERROR],
    [Actions::INFO],
    [Actions::WARNING],
]);
