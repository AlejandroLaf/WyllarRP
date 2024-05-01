@props(['active' , 'navigate'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center hover:text-orange-500 text-xl text-white'
            : 'inline-flex items-center hover:text-orange-500 text-xl text-white';
@endphp

<a {{ $navigate ?? true ? 'wire:navigate' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
