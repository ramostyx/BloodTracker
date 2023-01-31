@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-red-500/90 focus:ring-red-500/90 rounded-md shadow-sm']) !!}>
