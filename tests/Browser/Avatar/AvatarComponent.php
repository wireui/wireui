<?php

namespace Tests\Browser\Avatar;

class AvatarComponent extends \Livewire\Component
{
    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Avatar test</h1>

            <x-avatar/>

            <x-avatar xs />
            <x-avatar xs squared />
            <x-avatar xs border />
            <x-avatar xs text ><span class="text-md font-medium leading-none text-white">TW</span></x-avatar>

            <x-avatar sm />
            <x-avatar sm squared />
            <x-avatar sm border />
            <x-avatar sm text ><span class="text-md font-medium leading-none text-white">TW</span></x-avatar>

            <x-avatar md />
            <x-avatar md squared />
            <x-avatar md border />
            <x-avatar md text ><span class="text-md font-medium leading-none text-white">TW</span></x-avatar>

            <x-avatar lg />
            <x-avatar lg squared />
            <x-avatar lg border />
            <x-avatar lg text ><span class="text-md font-medium leading-none text-white">TW</span></x-avatar>

            <x-avatar xl />
            <x-avatar xl squared />
            <x-avatar xl border />
            <x-avatar xl text ><span class="text-md font-medium leading-none text-white">TW</span></x-avatar>

            <x-avatar full />
            <x-avatar full squared />
            <x-avatar full border />
            <x-avatar full text ><span class="text-md font-medium leading-none text-white">TW</span></x-avatar>
        </div>
        BLADE;
    }
}
