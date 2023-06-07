<?php

namespace WireUi\WireUi\Toggle;

use WireUi\Support\ComponentPack;

class Colors extends ComponentPack
{
    protected function default(): string
    {
        return 'primary';
    }

    public function all(): array
    {
        return [
            'primary' => <<<EOT
                toggle primary
            EOT,
            'secondary' => <<<EOT
                toggle secondary
            EOT,
            'positive' => <<<EOT
                toggle positive
            EOT,
            'negative' => <<<EOT
                toggle negative
            EOT,
            'warning' => <<<EOT
                toggle warning
            EOT,
            'info' => <<<EOT
                toggle info
            EOT,
        ];
    }
}
