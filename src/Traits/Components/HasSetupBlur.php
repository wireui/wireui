<?php

namespace WireUi\Traits\Components;

use Exception;

trait HasSetupBlur
{
    public mixed $blur = null;

    public bool $blurless = false;

    public mixed $blurClasses = null;

    protected mixed $blurResolve = null;

    protected function setBlurResolve(string $class): void
    {
        $this->blurResolve = $class;
    }

    protected function setupBlur(array &$component): void
    {
        throw_if(!$this->blurResolve, new Exception('You must define a blur resolve.'));

        $blurs = config("wireui.{$this->config}.blurs");

        $blurPack = $this->getResolve($blurs, 'blur');

        $this->blur = $this->getData('blur');

        $this->blurless = (bool) ($this->getData('blurless') ?? false);

        $this->blurClasses = $blurPack->get($this->blur);

        $this->setBlurVariables($component);
    }

    private function setBlurVariables(array &$component): void
    {
        $component['blur'] = $this->blur;

        $component['blurless'] = $this->blurless;

        $component['blurClasses'] = $this->blurClasses;
    }
}
