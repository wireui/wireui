<?php

namespace WireUi\Traits\Customization;

use Exception;
use WireUi\Support\ComponentPack;

trait HasSetupIcon
{
    public mixed $icon = null;

    public bool $iconless = false;

    public mixed $iconSize = null;

    public mixed $rightIcon = null;

    public mixed $iconClasses = null;

    private mixed $iconResolve = null;

    protected function setIconSizeResolve(string $class): void
    {
        $this->iconResolve = $class;
    }

    protected function setupIcon(array &$component): void
    {
        throw_if(!$this->iconResolve, new Exception('You must define a icon resolve.'));

        $icons = config("wireui.{$this->config}.icon-sizes");

        /** @var ComponentPack $iconPack */
        $iconPack = $icons ? resolve($icons) : resolve_wireui($this->iconResolve);

        $this->icon = $this->getIcon();

        $this->iconless = $this->getIconless();

        $this->iconSize = $this->getIconSize();

        $this->rightIcon = $this->getRightIcon();

        $this->getIconClasses($iconPack);

        $this->setIconVariables($component);

        $this->smart(['icon', 'iconless', 'iconSize', 'rightIcon', 'iconClasses']);
    }

    private function getIcon(): mixed
    {
        if ($this->data->has('icon')) {
            return $this->data->get('icon');
        }

        return config("wireui.{$this->config}.icon");
    }

    private function getIconless(): bool
    {
        if ($this->data->has('iconless')) {
            return (bool) $this->data->get('iconless');
        }

        return (bool) (config("wireui.{$this->config}.iconless") ?? false);
    }

    private function getIconSize(): mixed
    {
        if ($this->data->has('iconSize')) {
            return $this->data->get('iconSize');
        }

        if ($this->data->has('icon-size')) {
            return $this->data->get('icon-size');
        }

        if (property_exists($this, 'size')) {
            return $this->size;
        }

        return config("wireui.{$this->config}.icon-size");
    }

    private function getRightIcon(): mixed
    {
        if ($this->data->has('rightIcon')) {
            return $this->data->get('rightIcon');
        }

        if ($this->data->has('right-icon')) {
            return $this->data->get('right-icon');
        }

        return config("wireui.{$this->config}.right-icon");
    }

    private function getIconClasses(mixed $iconPack): void
    {
        $this->iconClasses = $iconPack->get($this->iconSize);

        $this->iconClasses = check_result($this->iconClasses);
    }

    private function setIconVariables(array &$component): void
    {
        $component['icon'] = $this->icon;

        $component['iconless'] = $this->iconless;

        $component['iconSize'] = $this->iconSize;

        $component['rightIcon'] = $this->rightIcon;

        $component['iconClasses'] = $this->iconClasses;
    }
}
