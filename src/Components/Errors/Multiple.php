<?php

namespace WireUi\Components\Errors;

use Illuminate\Contracts\View\View;
use Illuminate\Support\{Collection, Str};
use WireUi\Facades\WireUi;
use WireUi\Traits\Components\InteractsWithErrors;
use WireUi\View\WireUiComponent;

class Multiple extends WireUiComponent
{
    use InteractsWithErrors;

    protected array $props = [
        'only'  => [],
        'title' => null,
    ];

    protected function processed(array $data): void
    {
        $this->initOnly();

        $this->title ??= data_get($data, 'title');
    }

    private function initOnly(): void
    {
        if (is_string($this->only)) {
            $this->only = str($this->only)->explode('|');

            $this->only->transform(fn (string $name) => trim($name));
        }

        $this->only = collect($this->only);
    }

    public function count(): int
    {
        return $this->getErrorMessages()->count();
    }

    public function getArray(mixed $title): array
    {
        return WireUi::checkSlot($title) ? [
            'color' => 'negative',
        ] : [
            'color' => 'negative',
            'title' => $this->getTitle(),
        ];
    }

    public function getErrorMessages(): Collection
    {
        $messages = $this->errors()->getMessages();

        return $this->only->isNotEmpty() ? collect($messages)->only($this->only) : collect($messages);
    }

    private function getTitle(): string
    {
        $title = $this->title ?? trans_choice('wireui::messages.errors.title', $this->count());

        return Str::replace('{errors}', $this->count(), $title);
    }

    public function blade(): View
    {
        return view('wireui-errors::multiple');
    }
}
