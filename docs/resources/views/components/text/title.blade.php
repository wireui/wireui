@props(['title'])

<div {{ $attributes->class('mt-4 mb-2') }}>
    <p class="text-base font-extrabold leading-7 text-secondary-500 dark:text-secondary-400">
        {{ $title ?? $slot }}
    </p>
</div>
