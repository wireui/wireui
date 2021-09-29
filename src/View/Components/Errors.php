<?php

namespace WireUi\View\Components;

use Illuminate\Support\ViewErrorBag;

class Errors extends Component
{
    public string $title;

    public array $only;

    /**
     * @param string $title
     * @param string|array|null $only
     */
    public function __construct(
        ?string $title = null,
        $only = []
    ) {
        if (is_string($only)) {
            $only = explode('|', $only);
            $only = array_map(fn (string $name) => trim($name), $only);
        }

        $this->title = $title ?? __('wireui::messages.errors.title');
        $this->only  = $only;
    }

    public function render()
    {
        return view('wireui::components.errors');
    }

    public function hasErrors(ViewErrorBag $errors): bool
    {
        return (bool) $this->count($errors);
    }

    public function count(ViewErrorBag $errors): int
    {
        return count($this->getErrorMessages($errors));
    }

    public function getErrorMessages(ViewErrorBag $errors): array
    {
        $messages = $errors->getMessages();

        if (!$this->only) {
            return $messages;
        }

        return array_filter($messages, fn ($name) => in_array($name, $this->only), ARRAY_FILTER_USE_KEY);
    }
}
