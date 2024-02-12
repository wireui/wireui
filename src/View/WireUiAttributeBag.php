<?php

namespace WireUi\View;

use Illuminate\View\ComponentAttributeBag;

class WireUiAttributeBag extends ComponentAttributeBag
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes = collect($attributes)
            ->filter()
            ->mapWithKeys(static function ($value, string $key): array {
                if (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                }

                return [$key => $value];
            })
            ->toArray();
    }
}
