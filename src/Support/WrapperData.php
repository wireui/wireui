<?php

namespace WireUi\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class WrapperData
{
    private Collection $data;

    private array $except = [];

    public function __construct(Collection|array $data)
    {
        $this->data = collect($data);
    }

    public function toArray(): array
    {
        return $this->data
            ->filter(function ($value, string $key) {
                $property = Str::kebab($key);

                return in_array($property, self::attributes())
                    && ! in_array($property, $this->except);
            })
            ->mapWithKeys(fn ($value, string $key) => [
                Str::camel($key) => $value,
            ])
            ->toArray();
    }

    public function except(array $array): self
    {
        $this->except = $array;

        return $this;
    }

    public static function attributes(): array
    {
        return [
            ...self::shared(),
            ...self::extractable(),
        ];
    }

    public static function shared(): array
    {
        return ['id', 'name', 'disabled', 'readonly'];
    }

    public static function extractable(): array
    {
        return [
            'icon',
            'color',
            'label',
            'corner',
            'prefix',
            'shadow',
            'suffix',
            'padding',
            'rounded',
            'errorless',
            'left-label',
            'right-icon',
            'shadowless',
            'description',
            'invalidated',
            'with-validation-colors',
            // Classes
            'color-classes',
            'shadow-classes',
            'rounded-classes',
        ];
    }
}
