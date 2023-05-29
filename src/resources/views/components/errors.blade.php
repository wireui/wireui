@if ((bool)$count($errors))
    <x-dynamic-component
        :component="WireUi::component('alert')"
        color="negative"
        title="{{ $getTitle($errors) }}"
        :icon="$icon"
        :iconless="$iconless"
        :borderless="$borderless"
        {{ $attributes }}
    >
        @if(isset($action))
            @slot('action', null, $action->attributes->getAttributes())
                {{ $action }}
            @endslot
        @endif

        <ul class="space-y-1 list-disc text-negative-700 dark:text-negative-600">
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

