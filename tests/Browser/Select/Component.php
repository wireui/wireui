<?php

namespace Tests\Browser\Select;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public const ARRAY_OPTIONS = [
        'Array Option 1',
        'Array Option 2',
        'Array Option 3',
    ];

    public const LABEL_VALUE_OPTIONS = [
        ['label' => 'Label Option 1', 'value' => 1],
        ['label' => 'Label Option 2', 'value' => 2],
        ['label' => 'Label Option 3', 'value' => 3],
    ];

    public const READONLY_DISABLED_OPTIONS = [
        ['label' => 'Disabled Option 1', 'value' => 'disabled', 'disabled' => true],
        ['label' => 'Readonly Option 2', 'value' => 'readonly', 'readonly' => true],
        ['label' => 'Normal Option 3', 'value' => 'normal'],
    ];

    protected array $rules = ['model' => 'required'];

    protected array $messages = ['model.required' => 'Select any value'];

    public $model = null;

    public $model2 = null;

    public $model3 = [];

    public $model4 = null;

    public $model5 = null;

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function validateSelect(): void
    {
        $this->validate();
    }

    public function resetInputValidation(): void
    {
        $this->resetValidation();
    }

    public function collectionOptions(): Collection
    {
        return collect([
            ['label' => 'Option A', 'value' => 'A'],
            ['label' => 'Option B', 'value' => 'B'],
            ['label' => 'Option C', 'value' => 'C'],
        ]);
    }
}
