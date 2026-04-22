@props(['name', 'title'])

<div
    x-data="{ show: false }"
    x-show="show"
    x-on:open-modal.window="if ($event.detail.name === '{{ $name }}') show = true"
    x-on:close-modal.window="show = false"
    x-on:keydown.escape.window="show = false"
    style="display: none;"
    class="fixed inset-0 z-99999 flex items-center justify-center overflow-y-auto px-4 py-6 sm:px-0"
>
    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 transform transition-all"
        @click="show = false"
    >
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>

    <div
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="mb-6 transform overflow-hidden rounded-sm bg-white shadow-default transition-all dark:bg-boxdark sm:mx-auto sm:w-full sm:max-w-lg"
    >
        <div class="border-b border-stroke px-6 py-4 dark:border-strokedark">
            <h3 class="text-xl font-semibold text-black dark:text-white">
                {{ $title }}
            </h3>
        </div>
        
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>
