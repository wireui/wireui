<?php

namespace WireUi\Traits\Components;

use WireUi\Traits\Components\Concerns\IsFormComponent;
use WireUi\WireUi\Shadow;
use WireUi\WireUi\Wrapper\{Color, Rounded};

trait HasSetupWrapper
{
    use HasSetupColor;
    use HasSetupRounded;
    use HasSetupShadow;
    use IsFormComponent;

    protected function setupWrapper(): void
    {
        $this->setColorResolve(Color::class);
        $this->setShadowResolve(Shadow::class);
        $this->setRoundedResolve(Rounded::class);
    }
}
