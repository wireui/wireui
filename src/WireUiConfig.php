<?php

namespace WireUi;

use WireUi\Enum\Packs;
use WireUi\View\Components;

class WireUiConfig
{
    /**
     * Default Configuration to Components.
     */
    public static function alert(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => GLOBAL_STYLE,
                'rounded' => GLOBAL_STYLE,
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
                'color'   => GLOBAL_STYLE,
                'rounded' => GLOBAL_STYLE,
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
                'color'   => GLOBAL_STYLE,
                'rounded' => GLOBAL_STYLE,
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
                'rounded' => GLOBAL_STYLE,
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
                'height'   => Packs\Height::X3L,
                'position' => Packs\Position::RIGHT,
            ],
            'packs' => [
                'widths'    => WireUi\Dropdown\Width::class,
                'heights'   => WireUi\Dropdown\Height::class,
                'positions' => WireUi\Dropdown\Position::class,
            ],
        ], $options);
    }

    public static function icon(array $options = []): array
    {
        return self::mix([
            'variant' => Packs\Icon::OUTLINE,
        ], $options);
    }

    public static function modal(array $options = []): array
    {
        return self::mix([
            'default' => [
                'blur'  => Packs\Blur::NONE,
                'type'  => Packs\Type::BASE,
                'width' => Packs\Width::X2L,
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
                'position' => Packs\Position::TOP_RIGHT,
            ],
            'packs' => [
                'positions' => WireUi\Notification\Position::class,
            ],
        ], $options);
    }

    public static function wrapper(array $options = []): array
    {
        return self::mix([
            'default' => [
                'color'   => GLOBAL_STYLE,
                'shadow'  => GLOBAL_STYLE,
                'rounded' => GLOBAL_STYLE,
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
            'input-currency' => [
                'class' => Components\Input\Currency::class,
                'alias' => 'input-currency',
            ],
            'input-maskable' => [
                'class' => Components\Input\MaskableInput::class,
                'alias' => 'input-maskable',
            ],
            'input-number' => [
                'class' => Components\Input\Number::class,
                'alias' => 'input-number',
            ],
            'input-password' => [
                'class' => Components\Input\Password::class,
                'alias' => 'input-password',
            ],
            'input-phone' => [
                'class' => Components\Input\Phone::class,
                'alias' => 'input-phone',
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
