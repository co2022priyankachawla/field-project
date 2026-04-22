<x-app-layout>
    <!-- Personal Stats Grid -->
    <div class="stats-grid grid-cols-1 md:grid-cols-3 mb-8">
        <div class="stat-card">
            <div class="stat-value">{{ $stats['resident_total'] }}</div>
            <div class="stat-label">My Total Complaints</div>
        </div>
        <div class="stat-card">
            <div class="stat-value text-amber-500">{{ $stats['resident_pending'] }}</div>
            <div class="stat-label">Pending Approval</div>
        </div>
        <div class="stat-card">
            <div class="stat-value text-emerald-500">{{ $stats['resident_completed'] }}</div>
            <div class="stat-label">Resolved / Completed</div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="glass-card mb-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-slate-900">My Complaint List</h2>
                <p class="text-sm text-slate-500 mt-1">Track and manage your submitted waste collection feedback.</p>
            </div>
            <a href="/complaints/create">
                <x-button variant="primary" class="!px-6 !py-3 shadow-glow">
                    <span class="flex items-center gap-2">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add New Complaint
                    </span>
                </x-button>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-50">
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Photo</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Description</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Location</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Area Detail</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors">
                            <td class="py-5 px-2">
                                <div class="h-16 w-16 rounded-2xl overflow-hidden border border-slate-100 shadow-sm">
                                    @if($complaint->photo_path)
                                        <img src="{{ asset('storage/' . $complaint->photo_path) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-slate-100 flex items-center justify-center text-slate-300">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-5 px-2 max-w-[250px]">
                                <p class="text-slate-700 font-medium leading-relaxed">{{ $complaint->description }}</p>
                            </td>
                            <td class="py-5 px-2">
                                <span class="inline-flex items-center gap-1.5 text-slate-900 font-bold">
                                    <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    {{ $complaint->area }}
                                </span>
                            </td>
                            <td class="py-5 px-2">
                                <div class="text-slate-500 text-sm">
                                    <span class="block">Wing: <span class="text-slate-900 font-semibold">{{ $complaint->wing }}</span></span>
                                    <span class="block">Floor: <span class="text-slate-900 font-semibold">{{ $complaint->floor }}</span></span>
                                </div>
                            </td>
                            <td class="py-5 px-2">
                                <x-badge :type="$complaint->status">
                                    {{ ucfirst(str_replace('_', ' ', $complaint->status)) }}
                                </x-badge>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-slate-900">No complaints found</h3>
                                    <p class="text-slate-500 mt-1">You haven't submitted any feedback yet.</p>
                                    <a href="/complaints/create" class="mt-6">
                                        <x-button variant="outline" class="!px-4 !py-2">File your first complaint</x-button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
