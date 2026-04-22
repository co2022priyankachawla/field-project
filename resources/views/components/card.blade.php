<div {{ $attributes->merge(['class' => 'rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark']) }}>
    @if(isset($title))
        <div class="mb-4 flex items-center justify-between">
            <h4 class="text-xl font-semibold text-black dark:text-white">
                {{ $title }}
            </h4>
            @if(isset($action))
                {{ $action }}
            @endif
        </div>
    @endif
    
    {{ $slot }}
</div>
