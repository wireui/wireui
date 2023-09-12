<?php

use function Livewire\Volt\{state};

state(['only' => []]);

$addErrors = function () {
    $this->addError('first', 'first error');
    $this->addError('second', 'second error');
    $this->addError('third', 'third error');
};

$addFilterErrors = function () {
    $this->only = ['first', 'second'];

    $this->addErrors();
};

?>

<div>
    <h1>Errors test</h1>

    <x-errors :only="$only" />
</div>
