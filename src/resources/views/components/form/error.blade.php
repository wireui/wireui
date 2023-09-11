@props(['message' => null])

<label {{ $attributes->class('text-sm text-negative-600') }}>
    {{ $message ?? $slot }}
</label>
