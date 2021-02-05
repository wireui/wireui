@props(['name', 'size' => 5])

<x-dynamic-component
    :component="\PH7JACK\WireUi\WireUiServiceProvider::PACKAGE_NAME.'.icons.'.$name"
    {{ $attributes->merge(['class' => 'h-.'.$size.' w-'.$size]) }} />
