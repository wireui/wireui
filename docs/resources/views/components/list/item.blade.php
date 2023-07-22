@props(['text' => null])

<li {{ $attributes->class('my-2 pl-1') }}>
    {{ $text ?? $slot }}
</li>
