<?php

namespace Tests\Unit\Actions;

use WireUi\Enum\Icon;

dataset('dialog::event', [
    ['home', 'home'],
    [null, Icon::INFO],
]);

dataset('dialog::confirm::event', [
    ['home', 'home'],
    [null, Icon::QUESTION],
]);

dataset('simple::dialog::event', [
    [Icon::SUCCESS],
    [Icon::ERROR],
    [Icon::INFO],
    [Icon::WARNING],
]);

dataset('notification::event', [
    ['home', 'home'],
    [null, Icon::QUESTION],
]);

dataset('simple::notification::event', [
    [Icon::SUCCESS],
    [Icon::ERROR],
    [Icon::INFO],
    [Icon::WARNING],
]);
