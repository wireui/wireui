<?php

namespace WireUi\Traits\Components;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupBlur
{
    public mixed $blur = null;

    public bool $blurless = false;

    public mixed $blurClasses = null;

    private mixed $blurResolve = null;

    protected function setBlurResolve(string $class): void
    {
        $this->blurResolve = $class;
    }

    protected function setupBlur(array &$component): void
    {
        throw_if(!$this->blurResolve, new Exception('You must define a blur resolve.'));

        $blurs = config("wireui.{$this->config}.blurs");

        /** @var ComponentPack $blurPack */
        $blurPack = $blurs ? resolve($blurs) : resolve($this->blurResolve);

        $this->blurless = $this->getBlurless();

        $this->blur = $this->data->get('blur') ?? config("wireui.{$this->config}.blur");

        $this->blurClasses = $blurPack->get($this->blur);

        $this->setBlurVariables($component);

        $this->smart(['blur', 'blurless']);
    }

    private function getBlurless(): bool
    {
        if ($this->data->has('blurless')) {
            return (bool) $this->data->get('blurless');
        }

        return (bool) (config("wireui.{$this->config}.blurless") ?? false);
    }

    private function setBlurVariables(array &$component): void
    {
        $component['blur'] = $this->blur;

        $component['blurless'] = $this->blurless;

        $component['blurClasses'] = $this->blurClasses;
    }
}
