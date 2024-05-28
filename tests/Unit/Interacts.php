<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\File;
use Illuminate\Support\{Arr, Collection, Str};
use Illuminate\View\{Component, ComponentAttributeBag};
use ReflectionClass;
use Symfony\Component\Finder\SplFileInfo;

trait Interacts
{
    /**
     * Get random icon from Heroicons.
     */
    public function getRandomIcon(): string
    {
        return $this->getIcons()->random();
    }

    /**
     * Set attributes in specific component class.
     */
    public function setAttributes(Component &$component, array $attributes): void
    {
        $component->attributes = new ComponentAttributeBag($attributes);
    }

    /**
     * Run own function in specific component class.
     */
    public function runWireUiComponent(Component &$component): void
    {
        $this->invokeMethod($component, 'runWireUiComponent', [$component->data()]);
    }

    /**
     * Transform colors to css classes.
     */
    public function serializeColorClasses(array $colors): array
    {
        return collect($colors)->transform(
            fn ($color) => Arr::toCssClasses($color),
        )->toArray();
    }

    /**
     * Get all icons from Heroicons.
     */
    public function getIcons(): Collection
    {
        $files = File::allFiles(__DIR__ . '/../../vendor/wireui/heroicons/src/views/components/outline');

        return collect($files)->map(function (SplFileInfo $file) {
            return Str::of($file->getFilename())->before('.blade.php')->toString();
        })->sort();
    }

    /**
     * Get random pack from WireUi.
     */
    public function getRandomPack(string $pack, array $except = []): array
    {
        return collect((new $pack())->all())
            ->when(filled($except), fn ($values) => $values->except($except))
            ->map(fn ($value, $key) => [
                'key'     => $key,
                'classes' => $value,
            ])->random();
    }

    /**
     * Get random variant pack from WireUi.
     */
    public function getVariantRandomPack(string $variant, array $except = []): array
    {
        $variant = collect((new $variant())->all())->map(fn ($value, $key) => [
            'pack'    => $value,
            'variant' => $key,
        ])->random();

        $pack = $this->getRandomPack(data_get($variant, 'pack'), $except);

        return data_set($pack, 'variant', data_get($variant, 'variant'));
    }

    /**
     * Call protected/private method of a class.
     */
    public function invokeMethod(mixed $object, string $method, array $parameters = []): mixed
    {
        $reflection = new ReflectionClass(get_class($object));

        $method = $reflection->getMethod($method);

        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * Get protected/private property value of a class.
     */
    public function invokeProperty(mixed $object, string $property): mixed
    {
        $reflection = new ReflectionClass(get_class($object));

        $property = $reflection->getProperty($property);

        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
