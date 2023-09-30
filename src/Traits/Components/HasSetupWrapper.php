<?php

namespace WireUi\Traits\Components;

use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\WireUi\Wrapper\{Colors, Rounders, Shadows};

trait HasSetupWrapper
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    protected function setupWrapper(): void
    {
        $this->setColorResolve(Colors::class);
        $this->setShadowResolve(Shadows::class);
        $this->setRoundedResolve(Rounders::class);
    }
}
