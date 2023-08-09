<?php

namespace WireUi\View\Components;

use Illuminate\Support\{Collection, Str, ViewErrorBag};

class Errors extends BaseComponent
{
    public function __construct(
        public mixed $only = [],
        public ?string $title = null,
    ) {
        $this->initOnly();
    }

    private function initOnly(): void
    {
        if (is_string($this->only)) {
            $this->only = str($this->only)->explode('|');

            $this->only->transform(fn (string $name) => trim($name));
        }

        $this->only = collect($this->only);
    }

    public function count(ViewErrorBag $errors): int
    {
        return $this->getErrorMessages($errors)->count();
    }

    public function getArray(mixed $title, ViewErrorBag $errors): array
    {
        return check_slot($title) ? [
            'color' => 'negative',
        ] : [
            'color' => 'negative',
            'title' => $this->getTitle($errors),
        ];
    }

    public function getErrorMessages(ViewErrorBag $errors): Collection
    {
        $messages = $errors->getMessages();

        return $this->only->isNotEmpty() ? collect($messages)->only($this->only) : collect($messages);
    }

    public function getTitle(ViewErrorBag $errors): string
    {
        $title = $this->title ?? trans_choice('wireui::messages.errors.title', $this->count($errors));

        return Str::replace('{errors}', $this->count($errors), $title);
    }

    public function getView(): string
    {
        return 'wireui::components.errors';
    }
}
