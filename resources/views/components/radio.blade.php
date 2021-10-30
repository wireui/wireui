<x-dynamic-component
    :component="WireUiComponent::resolve('checkbox')"
    {{ $attributes->merge(['type' => 'radio', 'class' => '!rounded-full form-radio
']) }}
    :label="$label"
    :left-label="$leftLabel"
    :md="$md"
    :lg="$lg"
/>
