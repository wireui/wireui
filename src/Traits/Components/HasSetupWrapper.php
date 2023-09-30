<?php

namespace WireUi\Traits\Components;

use WireUi\WireUi\Wrapper\{Colors, Rounders, Shadows};

trait HasSetupWrapper
{
    use HasSetupColor;
    use HasSetupForm;
    use HasSetupRounded;
    use HasSetupShadow;

    protected function setupWrapper(): void
    {
        $this->setColorResolve(Colors::class);
        $this->setShadowResolve(Shadows::class);
        $this->setRoundedResolve(Rounders::class);
    }
}
