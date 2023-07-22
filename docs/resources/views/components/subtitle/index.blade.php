@props(['id', 'title', 'href' => null])

@php
    $href ??= isset($id) ? "#{$id}" : $href;
@endphp

<div @isset($id) id="{{ $id }}" @endisset class="mt-5 mb-3">
    <a @if ($href) href="{{ $href }}" @endif
        class="text-lg font-extrabold leading-8 tracking-tight cursor-pointer text-primary-600">
        {{ $title }}
    </a>
</div>
