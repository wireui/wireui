@props(['except' => []])

@foreach($__laravel_slots as $key => $value)
    @unless(in_array($key, $except))
        @slot($key, $value)
    @endunless
@endforeach
