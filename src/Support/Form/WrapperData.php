<?php

namespace WireUi\Support\Form;

use Illuminate\Support\{Collection, Str};

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
                    && !in_array($property, $this->except);
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
            'label',
            'corner',
            'description',
            'prefix',
            'suffix',
            'icon',
            'right-icon',
            'invalidated',
            'with-validation-colors',
            'errorless',
            'borderless',
            'shadowless',
        ];
    }
}
