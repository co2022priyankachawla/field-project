<x-app-layout>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
        <!-- Stats Card 1 -->
        <x-card class="bg-primary text-white">
            <h4 class="text-title-md font-bold text-white">45</h4>
            <span class="text-sm font-medium">Total Complaints</span>
        </x-card>

        <!-- Stats Card 2 -->
        <x-card class="bg-warning text-white">
            <h4 class="text-title-md font-bold text-white">15</h4>
            <span class="text-sm font-medium">Pending</span>
        </x-card>

        <!-- Stats Card 3 -->
        <x-card class="bg-secondary text-white">
            <h4 class="text-title-md font-bold text-white">10</h4>
            <span class="text-sm font-medium">Assigned</span>
        </x-card>

        <!-- Stats Card 4 -->
        <x-card class="bg-success text-white">
            <h4 class="text-title-md font-bold text-white">20</h4>
            <span class="text-sm font-medium">Completed</span>
        </x-card>
    </div>

    <div class="mt-4 grid grid-cols-1 gap-4 md:mt-6 md:gap-6 2xl:mt-7.5 2xl:gap-7.5">
        <x-card title="Recent Complaints">
            <x-table>
                <x-slot name="header">
                    <th class="px-4 py-4 font-semibold text-slate-900 uppercase text-xs tracking-wider">Resident</th>
                    <th class="px-4 py-4 font-semibold text-slate-900 uppercase text-xs tracking-wider">Photo</th>
                    <th class="px-4 py-4 font-semibold text-slate-900 uppercase text-xs tracking-wider">Description</th>
                    <th class="px-4 py-4 font-semibold text-slate-900 uppercase text-xs tracking-wider">Area</th>
                    <th class="px-4 py-4 font-semibold text-slate-900 uppercase text-xs tracking-wider">Status</th>
                    <th class="px-4 py-4 font-semibold text-slate-900 uppercase text-xs tracking-wider">Action</th>
                </x-slot>

                <tr>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <p class="font-bold text-slate-900">John Resident</p>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <div class="h-10 w-10 rounded-full overflow-hidden border border-slate-200">
                             <img src="https://placehold.co/100x100?text=Waste" alt="Waste" class="h-full w-full object-cover">
                        </div>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <p class="text-slate-600">Littering in corridor.</p>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <p class="text-slate-600">Corridor A</p>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <x-badge type="pending">Pending</x-badge>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <x-button 
                            x-data 
                            @click="$dispatch('open-modal', { name: 'assign-task' })"
                            variant="primary" 
                            class="!px-3 !py-1 text-xs"
                        >
                            Assign
                        </x-button>
                    </td>
                </tr>

                <tr>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <p class="font-bold text-slate-900">Sarah Smith</p>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <div class="h-10 w-10 rounded-full overflow-hidden border border-slate-200">
                             <img src="https://placehold.co/100x100?text=Clean" alt="Waste" class="h-full w-full object-cover">
                        </div>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <p class="text-slate-600">Bin full in gym.</p>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <p class="text-slate-600">Gym</p>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <x-badge type="assigned">Assigned</x-badge>
                    </td>
                    <td class="border-b border-slate-100 px-4 py-5">
                        <span class="text-sm font-semibold text-primary">Assigned to: Mike</span>
                    </td>
                </tr>
            </x-table>
        </x-card>
    </div>

    <!-- Assignment Modal UI -->
    <x-assign-modal />
</x-app-layout>
