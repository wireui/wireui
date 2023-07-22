@props(['href', 'label'])

<div>
    <a @isset($href) href="{{ $href }}" @endisset class="font-semibold text-secondary-700 text-md dark:text-secondary-500">
        <span class="text-primary-600">#</span>
        {{ $label }}
    </a>

    @isset($slot)
        <ul class="pl-4 mt-1 space-y-2 text-sm font-medium text-secondary-600 dark:text-secondary-500">
            {{ $slot }}
        </ul>
    @endisset
</div>
