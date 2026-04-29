<x-app-layout>
    <!-- Staff Stats Grid -->
    <div class="stats-grid grid-cols-1 md:grid-cols-2 mb-8">
        <div class="stat-card">
            <div class="stat-value text-primary">{{ $stats['staff_total'] }}</div>
            <div class="stat-label">Total Tasks Assigned</div>
        </div>
        <div class="stat-card">
            <div class="stat-value text-emerald-500">{{ $stats['staff_completed'] }}</div>
            <div class="stat-label">Successfully Completed</div>
        </div>
    </div>

    <!-- Assignments Content Area -->
    <div class="glass-card mb-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-xl font-bold text-slate-900">My Assigned Tasks</h2>
                <p class="text-sm text-slate-500 mt-1">Review and update the status of your current waste collection assignments.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-50">
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Evidence</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Task Detail</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Location</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-widest text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors group">
                            <td class="py-5 px-2">
                                <div class="h-16 w-16 rounded-2xl overflow-hidden border border-slate-100 shadow-sm transition-transform group-hover:scale-105">
                                    <img src="{{ asset('storage/' . $assignment->complaint->photo_path) }}" class="h-full w-full object-cover">
                                </div>
                            </td>
                            <td class="py-5 px-2 max-w-[300px]">
                                <p class="text-slate-700 font-medium leading-relaxed">{{ $assignment->complaint->description }}</p>
                                <span class="text-[10px] uppercase font-black text-slate-300 tracking-tighter">Reported {{ $assignment->complaint->created_at->diffForHumans() }}</span>
                            </td>
                            <td class="py-5 px-2">
                                <div class="flex flex-col">
                                    <span class="text-slate-900 font-bold flex items-center gap-1.5">
                                        <svg class="h-4 w-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $assignment->complaint->area }}
                                    </span>
                                    <small class="text-slate-400 font-medium mt-0.5">Wing {{ $assignment->complaint->wing }} • Floor {{ $assignment->complaint->floor }}</small>
                                </div>
                            </td>
                            <td class="py-5 px-2">
                                <x-badge :type="$assignment->status">
                                    {{ ucfirst($assignment->status) }}
                                </x-badge>
                            </td>
                            <td class="py-5 px-2 text-right">
                                @if($assignment->status === 'assigned')
                                    <form action="{{ route('assignments.complete', $assignment->id) }}" method="POST">
                                        @csrf
                                        <x-button type="submit" variant="primary" class="!px-4 !py-2 text-xs shadow-glow">
                                            Mark as Completed
                                        </x-button>
                                    </form>
                                @else
                                    <div class="flex flex-col items-end gap-2">
                                        <span class="inline-flex items-center gap-1 text-emerald-600 font-bold text-sm">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            Task Done
                                        </span>
                                        @if($assignment->complaint->feedback)
                                            <div class="flex flex-col items-end gap-1 mt-1 border-t border-slate-100 pt-2">
                                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Resident Feedback</span>
                                                <div class="flex items-center gap-0.5 text-amber-400">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="h-3 w-3 {{ $i <= $assignment->complaint->feedback->rating ? 'fill-current' : 'text-slate-200' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                    @endfor
                                                </div>
                                                @if($assignment->complaint->feedback->comment)
                                                    <p class="text-[10px] text-slate-500 max-w-[150px] italic text-right leading-tight">"{{ Str::limit($assignment->complaint->feedback->comment, 60) }}"</p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-24 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="h-20 w-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4">
                                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                    </div>
                                    <h3 class="text-xl font-bold text-slate-900">All caught up!</h3>
                                    <p class="text-slate-500 mt-1 max-w-[250px]">No new waste collection tasks have been assigned to you at the moment.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
