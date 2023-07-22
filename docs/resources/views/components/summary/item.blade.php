@props(['href', 'label'])

<li>
    <a href="{{ $href }}">
        <span class="mr-1 text-primary-600">#</span>
        {{ $label }}
    </a>
</li>
