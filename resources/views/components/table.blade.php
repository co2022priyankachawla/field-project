<div class="overflow-x-auto">
    <table {{ $attributes->merge(['class' => 'w-full table-auto']) }}>
        @if(isset($header))
            <thead>
                <tr class="bg-gray-2 text-left dark:bg-meta-4">
                    {{ $header }}
                </tr>
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
