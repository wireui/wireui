@if ($errors->any())
    <div {{ $attributes->class($getCardClasses()) }}>
        @isset($header)
            <div {{ $header->attributes }}>
                {{ $header }}
            </div>
        @elseif($title)
            <div class="{{ $getHeaderClasses() }}">
                @if ($icon)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        class="w-5 h-5 mr-3 shrink-0 text-negative-400 dark:text-negative-600"
                        :name="$icon"
                    />
                @endif

                <h3 class="{{ $getTitleClasses() }}">
                    {{ str($title)->replace('{errors}', $errors->count()) }}
                </h3>

                @isset($action)
                    <div {{ $action->attributes }}>
                        {{ $action }}
                    </div>
                @endisset
            </div>
        @endisset

        <div {{ $attributes->class($getMainClasses()) }}>
            <ul class="space-y-1 text-sm list-disc text-negative-700 dark:text-negative-600">
                @foreach ($getErrorMessages($errors) as $message)
                    <li>{{ head($message) }}</li>
                @endforeach
            </ul>
        </div>

        @isset($footer)
            <div {{ $footer->attributes->class($getFooterClasses()) }}>
                {{ $footer }}
            </div>
        @endisset
    </div>
@else
    <div class="hidden"></div>
@endif

