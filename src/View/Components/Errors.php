<?php

namespace WireUi\View\Components;

use Illuminate\Support\{Collection, Str, ViewErrorBag};
use WireUi\Traits\Components\HasSetupErrors;

class Errors extends BaseComponent
{
    use HasSetupErrors;

    public function count(ViewErrorBag $errors): int
    {
        return $this->getErrorMessages($errors)->count();
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
