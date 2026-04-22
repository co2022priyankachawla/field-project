@props(['type' => 'pending'])

@php
    $classes = match($type) {
        'pending' => 'bg-amber-50 text-amber-600 border border-amber-100',
        'in_progress', 'assigned' => 'bg-sky-50 text-sky-600 border border-sky-100',
        'resolved', 'completed' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
        default => 'bg-slate-50 text-slate-600 border border-slate-100',
    };
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex rounded-full px-3 py-1 text-sm font-medium ' . $classes]) }}>
    {{ $slot }}
</span>
