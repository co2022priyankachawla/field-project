@props(['label' => null, 'name', 'type' => 'text', 'placeholder' => ''])

<div class="mb-4.5">
    @if($label)
        <label class="mb-1.5 block text-sm font-semibold text-slate-700">
            {{ $label }}
        </label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full rounded-xl border border-slate-400 bg-slate-50/50 px-5 py-3.5 text-slate-700 outline-none transition-all duration-200 placeholder:text-slate-400 focus:border-primary/50 focus:bg-white focus:ring-4 focus:ring-primary/10 disabled:cursor-default disabled:bg-slate-100']) }}
    />
    @error($name)
        <span class="mt-1 text-sm text-red-700 font-bold italic">{{ $message }}</span>
    @enderror
</div>
