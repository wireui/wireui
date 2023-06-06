<?php

namespace WireUi\WireUi\Modal;

use WireUi\Support\ComponentPack;

class Types extends ComponentPack
{
    protected function default(): mixed
    {
        return config('wireui.modal.type') ?? 'base';
    }

    public function all(): array
    {
        return [
            'base' => [
                'root'     => 'fixed inset-0 overflow-y-auto z-50 p-4',
                'backdrop' => <<<EOT
                    fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60
                    dark:bg-opacity-60 transform transition-opacity
                EOT,
                'main' => 'w-full min-h-full transform flex items-end justify-center mx-auto',
            ],
        ];
    }
}
