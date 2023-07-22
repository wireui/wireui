@props(['language', 'clean' => false, 'noCopy' => false, 'lineNumbers' => true, 'render' => false])

<div x-cloak x-data="wireui_code_preview()"
    {{ $attributes->class([
        'relative shadow-md dark:shadow-none border-2 dark:border-0 rounded-lg' => !$clean,
        'mt-3 mb-6',
    ]) }}>
    @if($render)
        @if (check_slot($slot))
            <div {{ $slot->attributes }}>
                {!! Blade::render(serialize_slot($slot), get_attributes($this)) !!}
            </div>
        @else
            {!! Blade::render(serialize_slot($slot), get_attributes($this)) !!}
        @endif
    @endif

    <div x-ref="code" class="torchlight">
        <x-docs-code :language="$language" :contents="serialize_slot($slot)" :line-numbers="$lineNumbers" />
    </div>

    @if (!$noCopy)
        <div class="absolute top-0 right-0 p-1">
            <x-button-mini x-ref="copy" primary flat focus="none" xs>
                <x-icon x-show="!copy" name="document" class="w-4 h-4 stroke-current" outline />

                <x-icon x-show="copy" name="document-check" class="w-4 h-4 stroke-current" outline />
            </x-button-mini>
        </div>
    @endif
</div>
