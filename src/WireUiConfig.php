<?php

namespace WireUi;

use WireUi\Components as Test;
use WireUi\Enum\Packs;

class WireUiConfig
{
    public const GLOBAL = 'global';

    public static function alert(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'rounded' => self::GLOBAL,
                'variant' => Packs\Variant::FLAT,
                'padding' => Packs\Padding::MEDIUM,
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'rounders' => WireUi\Rounded::class,
                'paddings' => Test\Alert\WireUi\Padding::class,
                'variants' => Test\Alert\WireUi\Variant::class,
            ],
        ], $options);
    }

    public static function avatar(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'    => Packs\Size::MD,
                'border'  => Packs\Border::THIN,
                'rounded' => Packs\Rounded::FULL,
                'color'   => Packs\Color::SECONDARY,
            ],
            'packs' => [
                'rounders'   => WireUi\Rounded::class,
                'sizes'      => Test\Avatar\WireUi\Size::class,
                'colors'     => Test\Avatar\WireUi\Color::class,
                'borders'    => Test\Avatar\WireUi\Border::class,
                'icon-sizes' => Test\Avatar\WireUi\IconSize::class,
            ],
        ], $options);
    }

    public static function badge(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'rounded' => self::GLOBAL,
                'size'    => Packs\Size::SM,
                'variant' => Packs\Variant::SOLID,
            ],
            'packs' => [
                'rounders'   => WireUi\Rounded::class,
                'variants'   => Test\Badge\WireUi\Variant::class,
                'icon-sizes' => Test\Badge\WireUi\IconSize::class,
                'sizes'      => Test\Badge\WireUi\Size\Base::class,
            ],
        ], $options);
    }

    public static function miniBadge(array $options = []): array
    {
        return self::badge(self::mix([
            'packs' => [
                'sizes' => Test\Badge\WireUi\Size\Mini::class,
            ],
        ], $options));
    }

    public static function button(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'rounded' => self::GLOBAL,
                'size'    => Packs\Size::MD,
                'variant' => Packs\Variant::SOLID,
            ],
            'packs' => [
                'rounders'   => WireUi\Rounded::class,
                'variants'   => Test\Button\WireUi\Variant::class,
                'icon-sizes' => Test\Button\WireUi\IconSize::class,
                'sizes'      => Test\Button\WireUi\Size\Base::class,
            ],
        ], $options);
    }

    public static function miniButton(array $options = []): array
    {
        return self::button(self::mix([
            'packs' => [
                'sizes' => Test\Button\WireUi\Size\Mini::class,
            ],
        ], $options));
    }

    public static function card(array $options = []): array
    {
        return self::mix([
            'default' => [
                'rounded' => self::GLOBAL,
                'color'   => Packs\Color::BASE,
                'variant' => Packs\Variant::FLAT,
                'padding' => Packs\Padding::MEDIUM,
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'colors'   => Test\Card\WireUi\Color::class,
                'paddings' => Test\Card\WireUi\Padding::class,
                'rounders' => Test\Card\WireUi\Rounded::class,
            ],
        ], $options);
    }

    public static function dropdown(array $options = []): array
    {
        return self::mix([
            'default' => [
                'width'    => Packs\Width::LG,
                'height'   => Packs\Height::XL3,
                'position' => Packs\Position::BOTTOM_START,
            ],
            'packs' => [
                'widths'  => Test\Dropdown\WireUi\Width::class,
                'heights' => Test\Dropdown\WireUi\Height::class,
            ],
        ], $options);
    }

    public static function icon(array $options = []): array
    {
        return self::mix([
            'variant' => Packs\Icon::OUTLINE,
        ], $options);
    }

    public static function link(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'      => Packs\Size::MD,
                'color'     => Packs\Color::PRIMARY,
                'underline' => Packs\Underline::HOVER,
            ],
            'packs' => [
                'sizes'      => Test\Link\WireUi\Size::class,
                'colors'     => Test\Link\WireUi\Color::class,
                'underlines' => Test\Link\WireUi\Underline::class,
            ],
        ], $options);
    }

    public static function modal(array $options = []): array
    {
        return self::mix([
            'default' => [
                'blur'  => Packs\Blur::NONE,
                'type'  => Packs\Type::BASE,
                'width' => Packs\Width::XL2,
                'align' => Packs\Align::START,
            ],
            'packs' => [
                'blurs'  => Test\Modal\WireUi\Blur::class,
                'types'  => Test\Modal\WireUi\Type::class,
                'widths' => Test\Modal\WireUi\Width::class,
                'aligns' => Test\Modal\WireUi\Align::class,
            ],
        ], $options);
    }

    public static function notifications(array $options = []): array
    {
        return self::mix([
            'default' => [
                'z-index'  => 'z-50',
                'position' => Packs\Position::TOP_END,
            ],
            'packs' => [
                'positions' => Test\Actions\WireUi\Position::class,
            ],
        ], $options);
    }

    public static function dateTimePicker(array $options = []): array
    {
        return self::wrapper(self::mix([
            'default' => [
                'right-icon'       => 'calendar',
                'without-tips'     => false,
                'without-timezone' => false,
                'without-time'     => false,
                'interval'         => 10,
                'time-format'      => 12,
                'parse-format'     => null,
                'display-format'   => null,
                'timezone'         => null,
                'user-timezone'    => null,
            ],
        ], $options));
    }

    public static function timePicker(array $options = []): array
    {
        return self::wrapper(self::mix([
            'default' => [
                'military-time'   => false,
                'without-seconds' => false,
                'right-icon'      => 'clock',
            ],
        ], $options));
    }

    public static function timeSelector(array $options = []): array
    {
        return self::mix([
            'default' => [
                'military-time'   => false,
                'without-seconds' => false,
                'borderless'      => false,
                'squared'         => false,
                'shadowless'      => false,
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'rounders' => WireUi\Rounded::class,
            ],
        ], $options);
    }

    public static function checkbox(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'size'    => Packs\Size::SM,
                'rounded' => Packs\Rounded::BASE,
            ],
            'packs' => [
                'rounders' => WireUi\Rounded::class,
                'sizes'    => Test\Switcher\WireUi\Checkbox\Size::class,
                'colors'   => Test\Switcher\WireUi\Checkbox\Color::class,
            ],
        ], $options);
    }

    public static function toggle(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'size'    => Packs\Size::SM,
                'rounded' => Packs\Rounded::FULL,
            ],
            'packs' => [
                'rounders' => WireUi\Rounded::class,
                'sizes'    => Test\Switcher\WireUi\Toggle\Size::class,
                'colors'   => Test\Switcher\WireUi\Toggle\Color::class,
            ],
        ], $options);
    }

    public static function radio(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'size'    => Packs\Size::SM,
                'rounded' => Packs\Rounded::FULL,
            ],
            'packs' => [
                'rounders' => WireUi\Rounded::class,
                'colors'   => Test\Switcher\WireUi\Radio\Color::class,
                'sizes'    => Test\Switcher\WireUi\Radio\Size::class,
            ],
        ], $options);
    }

    public static function wrapper(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'shadow'  => self::GLOBAL,
                'rounded' => self::GLOBAL,
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'colors'   => Test\Wrapper\WireUi\Color::class,
                'rounders' => Test\Wrapper\WireUi\Rounded::class,
            ],
        ], $options);
    }

    public static function defaultComponents(array $options = []): array
    {
        return self::mix([
            'alert' => [
                'class' => Test\Alert\Index::class,
                'alias' => 'alert',
            ],
            'avatar' => [
                'class' => Test\Avatar\Index::class,
                'alias' => 'avatar',
            ],
            'badge' => [
                'class' => Test\Badge\Base::class,
                'alias' => 'badge',
            ],
            'mini-badge' => [
                'class' => Test\Badge\Mini::class,
                'alias' => 'mini-badge',
            ],
            'button' => [
                'class' => Test\Button\Base::class,
                'alias' => 'button',
            ],
            'mini-button' => [
                'class' => Test\Button\Mini::class,
                'alias' => 'mini-button',
            ],
            'card' => [
                'class' => Test\Card\Index::class,
                'alias' => 'card',
            ],
            'checkbox' => [
                'class' => Test\Switcher\Checkbox::class,
                'alias' => 'checkbox',
            ],
            'color-picker' => [
                'class' => Test\ColorPicker\Picker::class,
                'alias' => 'color-picker',
            ],
            'datetime-picker' => [
                'class' => Test\DatetimePicker\Picker::class,
                'alias' => 'datetime-picker',
            ],
            'dialog' => [
                'class' => Test\Actions\Dialog::class,
                'alias' => 'dialog',
            ],
            'dropdown' => [
                'class' => Test\Dropdown\Base::class,
                'alias' => 'dropdown',
            ],
            'dropdown.item' => [
                'class' => Test\Dropdown\Item::class,
                'alias' => 'dropdown.item',
            ],
            'dropdown.header' => [
                'class' => Test\Dropdown\Header::class,
                'alias' => 'dropdown.header',
            ],
            'error' => [
                'class' => Test\Errors\Single::class,
                'alias' => 'error',
            ],
            'errors' => [
                'class' => Test\Errors\Multiple::class,
                'alias' => 'errors',
            ],
            'icon' => [
                'class' => Test\Icon\Index::class,
                'alias' => 'icon',
            ],
            'input' => [
                'class' => Test\TextField\Input::class,
                'alias' => 'input',
            ],
            'currency' => [
                'class' => Test\TextField\Currency::class,
                'alias' => 'currency',
            ],
            'maskable' => [
                'class' => Test\TextField\Maskable::class,
                'alias' => 'maskable',
            ],
            'number' => [
                'class' => Test\TextField\Number::class,
                'alias' => 'number',
            ],
            'password' => [
                'class' => Test\TextField\Password::class,
                'alias' => 'password',
            ],
            'phone' => [
                'class' => Test\TextField\Phone::class,
                'alias' => 'phone',
            ],
            'label' => [
                'class' => Test\Label\Index::class,
                'alias' => 'label',
            ],
            'link' => [
                'class' => Test\Link\Index::class,
                'alias' => 'link',
            ],
            'modal' => [
                'class' => Test\Modal\Index::class,
                'alias' => 'modal',
            ],
            'modal-card' => [
                'class' => Test\Modal\Card::class,
                'alias' => 'modal-card',
            ],
            'native-select' => [
                'class' => Test\Select\Native::class,
                'alias' => 'native-select',
            ],
            'notifications' => [
                'class' => Test\Actions\Notifications::class,
                'alias' => 'notifications',
            ],
            'radio' => [
                'class' => Test\Switcher\Radio::class,
                'alias' => 'radio',
            ],
            'select' => [
                'class' => Test\Select\Base::class,
                'alias' => 'select',
            ],
            'select.option' => [
                'class' => Test\Select\Option::class,
                'alias' => 'select.option',
            ],
            'select.user-option' => [
                'class' => Test\Select\UserOption::class,
                'alias' => 'select.user-option',
            ],
            'textarea' => [
                'class' => Test\Textarea\Index::class,
                'alias' => 'textarea',
            ],
            'time-picker' => [
                'class' => Test\TimePicker\Picker::class,
                'alias' => 'time-picker',
            ],
            'time-selector' => [
                'class' => Test\TimePicker\Selector::class,
                'alias' => 'time-selector',
            ],
            'toggle' => [
                'class' => Test\Switcher\Toggle::class,
                'alias' => 'toggle',
            ],
            /**
             * Popovers
             */
            'popover' => [
                'class' => Test\Popover\Type1::class,
                'alias' => 'popover',
            ],
            'popover2' => [
                'class' => Test\Popover\Type2::class,
                'alias' => 'popover2',
            ],
            /**
             * Wrappers
             */
            'switcher' => [
                'class' => Test\Wrapper\Switcher::class,
                'alias' => 'switcher',
            ],
            'text-field' => [
                'class' => Test\Wrapper\TextField::class,
                'alias' => 'text-field',
            ],
        ], $options);
    }

    /**
     * Function to mix default configuration with custom configuration.
     */
    protected static function mix(array $default, array $options): array
    {
        collect($options)->dot()->each(function ($value, $key) use (&$default) {
            data_set($default, $key, $value);
        });

        return $default;
    }
}
