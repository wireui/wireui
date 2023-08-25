@if ((bool) $count($errors))
    <x-dynamic-component
        :component="WireUi::component('alert')"
        {{ $attributes->merge($getArray($title, $errors)) }}
    >
        @if(check_slot($title))
            @slot('title', null, $title->attributes->getAttributes())
                {{ $title }}
            @endslot
        @endif

        @isset($action)
            @slot('action', null, $action->attributes->getAttributes())
                {{ $action }}
            @endslot
        @endisset

        <ul class="space-y-1 list-disc">
            @foreach ($getErrorMessages($errors) as $message)
                <li>{{ head($message) }}</li>
            @endforeach
        </ul>

        @isset($footer)
            @slot('footer', null, $footer->attributes->getAttributes())
                {{ $footer }}
            @endslot
        @endisset
    </x-dynamic-component>
@else
    <div class="hidden"></div>
@endif
