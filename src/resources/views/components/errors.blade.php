@if ((bool)$count($errors))
    <x-dynamic-component
        :component="WireUi::component('alert')"
        color="negative"
        title="{{ str($title)->replace('{errors}', $count($errors)) }}"
        :icon="$icon"
        :undivided="$undivided"
        :iconless="$iconless"
    >
        @if(isset($action))
            @slot('action', null, $action->attributes->getAttributes())
                {{ $action }}
            @endslot
        @endif

        <ul class="space-y-1 text-sm list-disc text-negative-700 dark:text-negative-600">
            @foreach ($getErrorMessages($errors) as $message)
                <li>{{ head($message) }}</li>
            @endforeach
        </ul>

        @if(isset($footer))
            @slot('footer', null, $footer->attributes->getAttributes())
                {{ $footer }}
            @endslot
        @endif
    </x-dynamic-component>
@else
    <div class="hidden"></div>
@endif

