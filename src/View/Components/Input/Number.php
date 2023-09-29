<?php

namespace WireUi\View\Components\Input;

use Illuminate\Contracts\View\View;
use WireUi\Traits\Components\{HasSetupColor, HasSetupForm, HasSetupIcon, HasSetupRounded, HasSetupShadow};
use WireUi\View\Components\BaseComponent;
use WireUi\WireUi\Wrapper\Input\{Colors, Rounders, Shadows};

class Number extends BaseComponent
{
    use HasSetupColor;
    use HasSetupForm;
    use HasSetupIcon;
    use HasSetupRounded;
    use HasSetupShadow;

    public function __construct()
    {
        $this->setColorResolve(Colors::class);
        $this->setShadowResolve(Shadows::class);
        $this->setRoundedResolve(Rounders::class);
    }

    protected function blade(): View
    {
        return view('wireui::components.input.number');
    }
}
