<?php

namespace Tests\Browser\Skeleton;

class SkeletonComponent extends \Livewire\Component
{
    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Skeleton test</h1>

            <x-skeleton/>
            <x-skeleton name="default"/>
            <x-skeleton name="image"/>
            <x-skeleton name="text"/>
            <x-skeleton name="card"/>
            <x-skeleton name="testimonial"/>
        </div>
        BLADE;
    }
}
