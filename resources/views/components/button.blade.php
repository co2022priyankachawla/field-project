@props(['variant' => 'primary'])

@php
    $classes = match($variant) {
        'primary' => 'bg-gradient-to-r from-primary to-primary-dark text-white hover:shadow-glow hover:-translate-y-0.5',
        'secondary' => 'bg-gradient-to-r from-secondary to-secondary/80 text-white hover:shadow-lg hover:-translate-y-0.5',
        'outline' => 'border-2 border-primary/20 text-primary hover:border-primary hover:bg-primary/5 hover:-translate-y-0.5',
        'danger' => 'bg-gradient-to-r from-red-500 to-red-600 text-white hover:shadow-lg hover:-translate-y-0.5',
        default => 'bg-primary text-white hover:bg-opacity-90',
    };
@endphp

<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-xl px-8 py-3.5 text-center font-semibold tracking-wide transition-all duration-300 ease-out focus:outline-none focus:ring-4 focus:ring-primary/20 ' . $classes]) }}>
    {{ $slot }}
</button>
