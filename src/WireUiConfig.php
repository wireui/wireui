<?php

namespace WireUi;

use WireUi\Enum\Packs;
use WireUi\View\Components;

class WireUiConfig
{
    public const GLOBAL = 'global';

    /**
     * Default Configuration to Components.
     */
    public static function alert(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => self::GLOBAL,
                'rounded' => self::GLOBAL,
                'padding' => Packs\Padding::BASE,
                'variant' => Packs\Variant::FLAT,
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'rounders' => WireUi\Rounded::class,
                'paddings' => WireUi\Alert\Padding::class,
                'variants' => WireUi\Alert\Variant::class,
            ],
        ], $options);
    }

    public static function avatar(array $options = []): array
    {
        return self::mix([
            'default' => [
                'border'  => Packs\Border::THIN,
                'rounded' => Packs\Rounded::FULL,
                'color'   => Packs\Color::SECONDARY,
            ],
            'packs' => [
                'rounders'   => WireUi\Rounded::class,
                'sizes'      => WireUi\Avatar\Size::class,
                'colors'     => WireUi\Avatar\Color::class,
                'borders'    => WireUi\Avatar\Border::class,
                'icon-sizes' => WireUi\Avatar\IconSize::class,
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
                'variants'   => WireUi\Badge\Variant::class,
                'icon-sizes' => WireUi\Badge\IconSize::class,
                'sizes'      => WireUi\Badge\Size\Base::class,
            ],
        ], $options);
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
                'variants'   => WireUi\Button\Variant::class,
                'icon-sizes' => WireUi\Button\IconSize::class,
                'sizes'      => WireUi\Button\Size\Base::class,
            ],
        ], $options);
    }

    public static function card(array $options = []): array
    {
        return self::mix([
            'default' => [
                'rounded' => self::GLOBAL,
                'color'   => Packs\Color::BASE,
                'padding' => Packs\Padding::BASE,
                'variant' => Packs\Variant::FLAT,
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'rounders' => WireUi\Rounded::class,
                'colors'   => WireUi\Card\Color::class,
                'paddings' => WireUi\Card\Padding::class,
            ],
        ], $options);
    }

    public static function dropdown(array $options = []): array
    {
        return self::mix([
            'default' => [
                'width'    => Packs\Width::LG,
                'height'   => Packs\Height::XL3,
                'position' => Packs\Position::BOTTOM_END,
            ],
            'packs' => [
                'widths'  => WireUi\Dropdown\Width::class,
                'heights' => WireUi\Dropdown\Height::class,
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
                'sizes'      => WireUi\Link\Size::class,
                'colors'     => WireUi\Link\Color::class,
                'underlines' => WireUi\Link\Underline::class,
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
                'blurs'  => WireUi\Modal\Blur::class,
                'types'  => WireUi\Modal\Type::class,
                'widths' => WireUi\Modal\Width::class,
                'aligns' => WireUi\Modal\Align::class,
            ],
        ], $options);
    }

    public static function notifications(array $options = []): array
    {
        return self::mix([
            'default' => [
                'position' => Packs\Position::TOP_END,
            ],
            'packs' => [
                'positions' => WireUi\Notification\Position::class,
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
                'interval'         => Components\TimePicker::INTERVAL,
                'time-format'      => Components\TimePicker::DEFAULT_FORMAT,
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
                'format'     => Components\TimePicker::DEFAULT_FORMAT,
                'interval'   => Components\TimePicker::INTERVAL,
                'right-icon' => 'clock',
            ],
        ], $options));
    }

    public static function timeSelector(array $options = []): array
    {
        return self::mix(['default' => []], $options);
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
                'colors'   => WireUi\Wrapper\Color::class,
                'rounders' => WireUi\Wrapper\Rounded::class,
            ],
        ], $options);
    }

    /**
     * Default Components.
     */
    public static function defaultComponents(array $options = []): array
    {
        return self::mix([
            'alert' => [
                'class' => Components\Alert::class,
                'alias' => 'alert',
            ],
            'avatar' => [
                'class' => Components\Avatar::class,
                'alias' => 'avatar',
            ],
            'badge' => [
                'class' => Components\Badge\Base::class,
                'alias' => 'badge',
            ],
            'mini-badge' => [
                'class' => Components\Badge\Mini::class,
                'alias' => 'mini-badge',
            ],
            'button' => [
                'class' => Components\Button\Base::class,
                'alias' => 'button',
            ],
            'mini-button' => [
                'class' => Components\Button\Mini::class,
                'alias' => 'mini-button',
            ],
            'card' => [
                'class' => Components\Card::class,
                'alias' => 'card',
            ],
            'checkbox' => [
                'class' => Components\Checkbox::class,
                'alias' => 'checkbox',
            ],
            'color-picker' => [
                'class' => Components\ColorPicker::class,
                'alias' => 'color-picker',
            ],
            'datetime-picker' => [
                'class' => Components\DatetimePicker::class,
                'alias' => 'datetime-picker',
            ],
            'dialog' => [
                'class' => Components\Dialog::class,
                'alias' => 'dialog',
            ],
            'dropdown' => [
                'class' => Components\Dropdown\Base::class,
                'alias' => 'dropdown',
            ],
            'dropdown.item' => [
                'class' => Components\Dropdown\Item::class,
                'alias' => 'dropdown.item',
            ],
            'dropdown.header' => [
                'class' => Components\Dropdown\Header::class,
                'alias' => 'dropdown.header',
            ],
            'error' => [
                'class' => Components\Error::class,
                'alias' => 'error',
            ],
            'errors' => [
                'class' => Components\Errors::class,
                'alias' => 'errors',
            ],
            'icon' => [
                'class' => Components\Icon::class,
                'alias' => 'icon',
            ],
            'input' => [
                'class' => Components\Input\Base::class,
                'alias' => 'input',
            ],
            'currency' => [
                'class' => Components\Input\Currency::class,
                'alias' => 'currency',
            ],
            'maskable' => [
                'class' => Components\Input\MaskableInput::class,
                'alias' => 'maskable',
            ],
            'number' => [
                'class' => Components\Input\Number::class,
                'alias' => 'number',
            ],
            'password' => [
                'class' => Components\Input\Password::class,
                'alias' => 'password',
            ],
            'phone' => [
                'class' => Components\Input\Phone::class,
                'alias' => 'phone',
            ],
            'label' => [
                'class' => Components\Label::class,
                'alias' => 'label',
            ],
            'link' => [
                'class' => Components\Link::class,
                'alias' => 'link',
            ],
            'modal' => [
                'class' => Components\Modal::class,
                'alias' => 'modal',
            ],
            'modal-card' => [
                'class' => Components\ModalCard::class,
                'alias' => 'modal-card',
            ],
            'native-select' => [
                'class' => Components\NativeSelect::class,
                'alias' => 'native-select',
            ],
            'notifications' => [
                'class' => Components\Notifications::class,
                'alias' => 'notifications',
            ],
            'radio' => [
                'class' => Components\Radio::class,
                'alias' => 'radio',
            ],
            'select' => [
                'class' => Components\Select::class,
                'alias' => 'select',
            ],
            'select.option' => [
                'class' => Components\Select\Option::class,
                'alias' => 'select.option',
            ],
            'select.user-option' => [
                'class' => Components\Select\UserOption::class,
                'alias' => 'select.user-option',
            ],
            'textarea' => [
                'class' => Components\Textarea::class,
                'alias' => 'textarea',
            ],
            'time-picker' => [
                'class' => Components\TimePicker::class,
                'alias' => 'time-picker',
            ],
            'toggle' => [
                'class' => Components\Toggle::class,
                'alias' => 'toggle',
            ],
            'wrapper' => [
                'class' => Components\Wrapper\Base::class,
                'alias' => 'wrapper',
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
