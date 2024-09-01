@if ($invalidated)
    <label {{ $attributes->class('text-sm text-negative-600') }}>
        {{ $slot->isEmpty() ? $message : $slot }}
    </label>
@endif
