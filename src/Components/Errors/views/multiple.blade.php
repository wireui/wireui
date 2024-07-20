@if ((bool) $count())
    <x-dynamic-component
        :component="WireUi::component('alert')"
        :attributes="$attributes->merge([
            'title' => $title,
            'color' => 'negative',
        ])"
    >
        <ul class="space-y-1 list-disc">
            @foreach ($getErrorMessages() as $message)
                <li>{{ head($message) }}</li>
            @endforeach
        </ul>

        @foreach($__laravel_slots as $key => $value)
            @slot($key, $value)
        @endforeach
    </x-dynamic-component>
@else
    <div class="hidden" hidden></div>
@endif
