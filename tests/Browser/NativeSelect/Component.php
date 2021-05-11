<?php

namespace Tests\Browser\NativeSelect;

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

    protected array $rules = ['model' => 'required'];

    protected array $messages = ['model.required' => 'select a value'];

    public array $options = self::ARRAY_OPTIONS;

    public Collection $collectionOptions;

    public $model = null;

    public $arrayOptionsModel = null;

    public $collectionOptionsModel = null;

    public $arrayWithLabelAndValueKeys = null;

    public function mount()
    {
        $this->collectionOptions = self::collectionOptions();
    }

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

    public static function collectionOptions(): Collection
    {
        return collect([
            'Collection Option 1',
            'Collection Option 2',
            'Collection Option 3',
        ]);
    }
}
