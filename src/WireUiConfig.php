<?php

namespace WireUi;

use WireUi\Components\{Alert, Avatar, Badge, Button, Card, ColorPicker, DatetimePicker, Dialog, Dropdown, Errors, Icon, Label, Link, Modal, Notifications, Popover, Select, Switcher, TextField, Textarea, TimePicker, Wrapper};

class WireUiConfig
{
    public static function alert(array $options = []): array
    {
        return self::mix([
            'default' => [
                'variant' => 'flat',
                'color'   => 'global',
                'rounded' => 'global',
                'padding' => 'medium',
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'rounders' => WireUi\Rounded::class,
                'paddings' => Alert\WireUi\Padding::class,
                'variants' => Alert\WireUi\Variant::class,
            ],
        ], $options);
    }

    public static function avatar(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'    => 'md',
                'border'  => 'thin',
                'rounded' => 'full',
                'color'   => 'secondary',
            ],
            'packs' => [
                'rounders'   => WireUi\Rounded::class,
                'sizes'      => Avatar\WireUi\Size::class,
                'colors'     => Avatar\WireUi\Color::class,
                'borders'    => Avatar\WireUi\Border::class,
                'icon-sizes' => Avatar\WireUi\IconSize::class,
            ],
        ], $options);
    }

    public static function badge(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'    => 'sm',
                'variant' => 'solid',
                'color'   => 'global',
                'rounded' => 'global',
            ],
            'packs' => [
                'rounders'   => WireUi\Rounded::class,
                'variants'   => Badge\WireUi\Variant::class,
                'icon-sizes' => Badge\WireUi\IconSize::class,
                'sizes'      => Badge\WireUi\Size\Base::class,
            ],
        ], $options);
    }

    public static function miniBadge(array $options = []): array
    {
        return self::badge(self::mix([
            'packs' => [
                'sizes' => Badge\WireUi\Size\Mini::class,
            ],
        ], $options));
    }

    public static function button(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'    => 'md',
                'variant' => 'solid',
                'color'   => 'global',
                'rounded' => 'global',
            ],
            'packs' => [
                'rounders'   => WireUi\Rounded::class,
                'variants'   => Button\WireUi\Variant::class,
                'icon-sizes' => Button\WireUi\IconSize::class,
                'sizes'      => Button\WireUi\Size\Base::class,
            ],
        ], $options);
    }

    public static function miniButton(array $options = []): array
    {
        return self::button(self::mix([
            'packs' => [
                'sizes' => Button\WireUi\Size\Mini::class,
            ],
        ], $options));
    }

    public static function card(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => 'base',
                'variant' => 'flat',
                'rounded' => 'global',
                'padding' => 'medium',
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'colors'   => Card\WireUi\Color::class,
                'paddings' => Card\WireUi\Padding::class,
                'rounders' => Card\WireUi\Rounded::class,
            ],
        ], $options);
    }

    public static function dropdown(array $options = []): array
    {
        return self::mix([
            'default' => [
                'width'    => 'lg',
                'height'   => '3xl',
                'position' => 'bottom-start',
            ],
            'packs' => [
                'widths'  => Dropdown\WireUi\Width::class,
                'heights' => Dropdown\WireUi\Height::class,
            ],
        ], $options);
    }

    public static function icon(array $options = []): array
    {
        return self::mix([
            'variant' => 'outline',
        ], $options);
    }

    public static function link(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'      => 'md',
                'underline' => 'hover',
                'color'     => 'primary',
            ],
            'packs' => [
                'sizes'      => Link\WireUi\Size::class,
                'colors'     => Link\WireUi\Color::class,
                'underlines' => Link\WireUi\Underline::class,
            ],
        ], $options);
    }

    public static function modal(array $options = []): array
    {
        return self::mix([
            'default' => [
                'width' => '2xl',
                'blur'  => 'none',
                'type'  => 'base',
                'align' => 'start',
            ],
            'packs' => [
                'blurs'  => Modal\WireUi\Blur::class,
                'types'  => Modal\WireUi\Type::class,
                'widths' => Modal\WireUi\Width::class,
                'aligns' => Modal\WireUi\Align::class,
            ],
        ], $options);
    }

    public static function notifications(array $options = []): array
    {
        return self::mix([
            'default' => [
                'z-index'  => 'z-50',
                'position' => 'top-end',
            ],
            'packs' => [
                'positions' => Notifications\WireUi\Position::class,
            ],
        ], $options);
    }

    public static function dateTimePicker(array $options = []): array
    {
        return self::wrapper(self::mix([
            'default' => [
                'interval'         => 10,
                'time-format'      => 12,
                'timezone'         => null,
                'parse-format'     => null,
                'user-timezone'    => null,
                'display-format'   => null,
                'without-timezone' => false,
                'without-time'     => false,
                'without-tips'     => false,
                'right-icon'       => 'calendar',
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
                'squared'         => false,
                'borderless'      => false,
                'shadowless'      => false,
                'military-time'   => false,
                'without-seconds' => false,
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
                'size'    => 'sm',
                'rounded' => 'base',
                'color'   => 'global',
            ],
            'packs' => [
                'sizes'    => Switcher\WireUi\Checkbox\Size::class,
                'colors'   => Switcher\WireUi\Checkbox\Color::class,
                'rounders' => WireUi\Rounded::class,
            ],
        ], $options);
    }

    public static function toggle(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'    => 'sm',
                'rounded' => 'full',
                'color'   => 'global',
            ],
            'packs' => [
                'rounders' => WireUi\Rounded::class,
                'sizes'    => Switcher\WireUi\Toggle\Size::class,
                'colors'   => Switcher\WireUi\Toggle\Color::class,
            ],
        ], $options);
    }

    public static function radio(array $options = []): array
    {
        return self::mix([
            'default' => [
                'size'    => 'sm',
                'rounded' => 'full',
                'color'   => 'global',
            ],
            'packs' => [
                'rounders' => WireUi\Rounded::class,
                'colors'   => Switcher\WireUi\Radio\Color::class,
                'sizes'    => Switcher\WireUi\Radio\Size::class,
            ],
        ], $options);
    }

    public static function wrapper(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => 'global',
                'shadow'  => 'global',
                'rounded' => 'global',
            ],
            'packs' => [
                'shadows'  => WireUi\Shadow::class,
                'colors'   => Wrapper\WireUi\Color::class,
                'rounders' => Wrapper\WireUi\Rounded::class,
            ],
        ], $options);
    }

    public static function defaultComponents(array $options = []): array
    {
        return self::mix([
            'alert' => [
                'class' => Alert\Index::class,
                'alias' => 'alert',
            ],
            'avatar' => [
                'class' => Avatar\Index::class,
                'alias' => 'avatar',
            ],
            'badge' => [
                'class' => Badge\Base::class,
                'alias' => 'badge',
            ],
            'mini-badge' => [
                'class' => Badge\Mini::class,
                'alias' => 'mini-badge',
            ],
            'button' => [
                'class' => Button\Base::class,
                'alias' => 'button',
            ],
            'mini-button' => [
                'class' => Button\Mini::class,
                'alias' => 'mini-button',
            ],
            'card' => [
                'class' => Card\Index::class,
                'alias' => 'card',
            ],
            'checkbox' => [
                'class' => Switcher\Checkbox::class,
                'alias' => 'checkbox',
            ],
            'color-picker' => [
                'class' => ColorPicker\Picker::class,
                'alias' => 'color-picker',
            ],
            'datetime-picker' => [
                'class' => DatetimePicker\Picker::class,
                'alias' => 'datetime-picker',
            ],
            'dialog' => [
                'class' => Dialog\Index::class,
                'alias' => 'dialog',
            ],
            'dropdown' => [
                'class' => Dropdown\Base::class,
                'alias' => 'dropdown',
            ],
            'dropdown.item' => [
                'class' => Dropdown\Item::class,
                'alias' => 'dropdown.item',
            ],
            'dropdown.header' => [
                'class' => Dropdown\Header::class,
                'alias' => 'dropdown.header',
            ],
            'error' => [
                'class' => Errors\Single::class,
                'alias' => 'error',
            ],
            'errors' => [
                'class' => Errors\Multiple::class,
                'alias' => 'errors',
            ],
            'icon' => [
                'class' => Icon\Index::class,
                'alias' => 'icon',
            ],
            'input' => [
                'class' => TextField\Input::class,
                'alias' => 'input',
            ],
            'currency' => [
                'class' => TextField\Currency::class,
                'alias' => 'currency',
            ],
            'maskable' => [
                'class' => TextField\Maskable::class,
                'alias' => 'maskable',
            ],
            'number' => [
                'class' => TextField\Number::class,
                'alias' => 'number',
            ],
            'password' => [
                'class' => TextField\Password::class,
                'alias' => 'password',
            ],
            'phone' => [
                'class' => TextField\Phone::class,
                'alias' => 'phone',
            ],
            'label' => [
                'class' => Label\Index::class,
                'alias' => 'label',
            ],
            'link' => [
                'class' => Link\Index::class,
                'alias' => 'link',
            ],
            'modal' => [
                'class' => Modal\Index::class,
                'alias' => 'modal',
            ],
            'modal-card' => [
                'class' => Modal\Card::class,
                'alias' => 'modal-card',
            ],
            'native-select' => [
                'class' => Select\Native::class,
                'alias' => 'native-select',
            ],
            'notifications' => [
                'class' => Notifications\Index::class,
                'alias' => 'notifications',
            ],
            'radio' => [
                'class' => Switcher\Radio::class,
                'alias' => 'radio',
            ],
            'select' => [
                'class' => Select\Base::class,
                'alias' => 'select',
            ],
            'select.option' => [
                'class' => Select\Option::class,
                'alias' => 'select.option',
            ],
            'select.user-option' => [
                'class' => Select\UserOption::class,
                'alias' => 'select.user-option',
            ],
            'textarea' => [
                'class' => Textarea\Index::class,
                'alias' => 'textarea',
            ],
            'time-picker' => [
                'class' => TimePicker\Picker::class,
                'alias' => 'time-picker',
            ],
            'time-selector' => [
                'class' => TimePicker\Selector::class,
                'alias' => 'time-selector',
            ],
            'toggle' => [
                'class' => Switcher\Toggle::class,
                'alias' => 'toggle',
            ],
            /**
             * Popovers
             */
            'popover' => [
                'class' => Popover\Type1::class,
                'alias' => 'popover',
            ],
            'popover2' => [
                'class' => Popover\Type2::class,
                'alias' => 'popover2',
            ],
            /**
             * Wrappers
             */
            'switcher' => [
                'class' => Wrapper\Switcher::class,
                'alias' => 'switcher',
            ],
            'text-field' => [
                'class' => Wrapper\TextField::class,
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
