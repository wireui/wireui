@props(['language', 'clean' => false, 'noCopy' => false, 'lineNumbers' => true, 'color' => false])

<div x-cloak x-data="wireui_code_preview()"
    {{ $attributes->class([
        'relative shadow-md dark:shadow-none border-2 dark:border-0 rounded-lg' => !$clean,
        'mt-3 mb-6',
    ]) }}>
    <div x-show="!code" @class([
        'bg-gray-100 dark:bg-secondary-700' => $color && !$clean,
        'bg-white dark:bg-secondary-800' => !$color && !$clean,
        'p-6 rounded-lg' => !$clean,
    ])>
        @if (check_slot($slot))
            <div {{ $slot->attributes }}>
                {!! Blade::render(serialize_slot($slot), get_attributes($this)) !!}
            </div>
        @else
            {!! Blade::render(serialize_slot($slot), get_attributes($this)) !!}
        @endif
    </div>

    <div x-ref="code" x-show="code" class="torchlight">
        <x-docs-code :language="$language" :contents="serialize_slot($slot)" :line-numbers="$lineNumbers" />
    </div>

    <div class="absolute top-0 right-0 p-1">
        <div class="flex items-center space-x-2">
            @if (!$noCopy)
                <x-button-mini x-show="code" x-ref="copy" primary flat focus="none" xs>
                    <x-icon x-show="!copy" name="document" class="w-4 h-4 stroke-current" outline />

                    <x-icon x-show="copy" name="document-check" class="w-4 h-4 stroke-current" outline />
                </x-button-mini>
            @endif

            <x-button-mini x-on:click="toggle" primary flat focus="none" xs>
                <x-icon x-show="code" name="eye" class="w-4 h-4 stroke-current" outline />

                <x-icon x-show="!code" name="code-bracket" class="w-4 h-4 stroke-current" outline />
            </x-button-mini>
        </div>
    </div>
</div>
