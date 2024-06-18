<x-dynamic-component
    :component="WireUi::component('text-field')"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class', 'group-invalidated'])"
>
    @include('wireui-wrapper::components.slots')

    <x-wireui-wrapper::element :attributes="$attrs->except(['wire:key', 'x-data', 'class', 'group-invalidated'])" />
</x-dynamic-component>
