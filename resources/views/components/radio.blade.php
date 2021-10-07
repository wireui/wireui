<x-dynamic-component
    :component="\WireUi\Facades\WireUiComponent::resolve('checkbox')"
    {{ $attributes->merge(['type' => 'radio', 'class' => '!rounded-full']) }}
    :label="$label"
    :left-label="$leftLabel"
    :md="$md"
    :lg="$lg"
/>
