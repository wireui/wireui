<?php

namespace Tests\Unit\Actions;

use WireUi\Enum\Icon;

dataset('dialog::event', [
    ['home', 'home'],
    [null, Icon::INFO->value],
]);

dataset('dialog::confirm::event', [
    ['home', 'home'],
    [null, Icon::QUESTION->value],
]);

dataset('simple::dialog::event', [
    [Icon::SUCCESS->value],
    [Icon::ERROR->value],
    [Icon::INFO->value],
    [Icon::WARNING->value],
]);

dataset('notification::event', [
    ['home', 'home'],
    [null, Icon::QUESTION->value],
]);

dataset('simple::notification::event', [
    [Icon::SUCCESS->value],
    [Icon::ERROR->value],
    [Icon::INFO->value],
    [Icon::WARNING->value],
]);
