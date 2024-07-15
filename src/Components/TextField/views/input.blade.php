<x-dynamic-component
    :component="WireUi::component('text-field')"
    :config="$config"
    :attributes="$wrapper"
>
    @include('wireui-wrapper::components.slots')

    <x-wireui-wrapper::element :attributes="$attrs->except(['wire:key', 'x-data', 'class', 'group-invalidated'])" />
</x-dynamic-component>
