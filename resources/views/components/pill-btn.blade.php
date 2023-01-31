@props(['label'])
@php $active =  in_array('active', explode(' ', $attributes['class'])) ; @endphp

<button {{$attributes->merge(['class' => $active ? 'bg-red-100 border-b border-red-500':''])}} >
    {{$label}}
</button>
