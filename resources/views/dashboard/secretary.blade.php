<x-app-layout>
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value">{{ $stats['total'] }}</div>
        <div class="stat-label">Total Complaints</div>
    </div>
    <div class="stat-card">
        <div class="stat-value text-amber-500">{{ $stats['pending'] }}</div>
        <div class="stat-label">Pending</div>
    </div>
    <div class="stat-card">
        <div class="stat-value text-sky-500">{{ $stats['in_progress'] }}</div>
        <div class="stat-label">In Progress</div>
    </div>
    <div class="stat-card">
        <div class="stat-value text-emerald-500">{{ $stats['resolved'] }}</div>
        <div class="stat-label">Resolved</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $stats['avg_rating'] }}/5</div>
        <div class="stat-label">Avg Rating</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $stats['avg_resolution_time'] }}</div>
        <div class="stat-label">Avg Resolution</div>
    </div>
</div>

<!-- Analytics Section -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
    <!-- Complaint Trends (Line Chart) -->
    <div class="glass-card xl:col-span-2">
        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Complaint Trends (Last 7 Days)</h3>
        <div style="height: 300px;">
            <canvas id="trendChart"></canvas>
        </div>
    </div>

    <!-- Status Distribution (Donut Chart) -->
    <div class="glass-card">
        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Status Distribution</h3>
        <div style="height: 300px; display: flex; justify-content: center;">
            <canvas id="statusChart"></canvas>
        </div>
    </div>

    <!-- Ward-wise Distribution (Bar Chart) -->
    <div class="glass-card xl:col-span-3">
        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-6">Ward-wise Complaint Distribution</h3>
        <div style="height: 350px;">
            <canvas id="areaChart"></canvas>
        </div>
    </div>
</div>

<!-- All Complaints Table -->
<div class="glass-card mb-8" id="manage-complaints">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-slate-900">Manage Complaints</h2>
        <div class="flex gap-2">
            <!-- Filter buttons or search can go here -->
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-50">
                    <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Resident</th>
                    <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Photo</th>
                    <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Location</th>
                    <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                    <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Staff Assigned</th>
                    <th class="py-4 px-2 text-xs font-bold text-slate-400 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                    <tr class="border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors group">
                        <td class="py-4 px-2">
                            <strong class="text-slate-900 block">{{ $complaint->resident->name }}</strong>
                            <small class="text-slate-500">{{ $complaint->resident->email }}</small>
                        </td>
                        <td class="py-4 px-2">
                            <div class="h-12 w-12 rounded-xl overflow-hidden border border-slate-100 shadow-sm">
                                <img src="{{ asset('storage/' . $complaint->photo_path) }}" class="h-full w-full object-cover">
                            </div>
                        </td>
                        <td class="py-4 px-2 text-slate-600">
                            <span class="block font-medium">{{ $complaint->area }}</span>
                            <small class="text-slate-400 uppercase">Wing {{ $complaint->wing }} • Floor {{ $complaint->floor }}</small>
                        </td>
                        <td class="py-4 px-2">
                            <x-badge :type="$complaint->status">{{ ucfirst(str_replace('_', ' ', $complaint->status)) }}</x-badge>
                        </td>
                        <td class="py-4 px-2">
                            @php $assignment = $complaint->assignments->last(); @endphp
                            @if($assignment)
                                <div class="text-slate-900 font-medium">{{ $assignment->staff->name }}</div>
                                <span class="text-[10px] uppercase font-bold text-slate-400">{{ $assignment->status }}</span>
                            @else
                                <span class="text-xs font-bold text-slate-300 italic">Unassigned</span>
                            @endif
                        </td>
                        <td class="py-4 px-2">
                            @if($complaint->status === 'pending')
                                <x-button variant="primary" class="!px-3 !py-1.5 text-xs" 
                                        onclick="openAssignModal({{ $complaint->id }})">Assign Staff</x-button>
                            @elseif($complaint->status === 'in_progress' && $assignment && $assignment->status === 'completed')
                                <form action="{{ route('notifications.send') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                                    <x-button type="submit" variant="secondary" class="!px-3 !py-1.5 text-xs">Notify Result</x-button>
                                </form>
                            @else
                                <x-button variant="outline" class="!px-3 !py-1.5 text-xs" disabled>Processed</x-button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Assign Staff Modal -->
<div id="assignModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; justify-content: center; align-items: center; backdrop-filter: blur(8px);">
    <div class="glass-card w-full max-w-md shadow-premium-xl animate-in fade-in zoom-in duration-200">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-slate-900">Assign Cleaning Staff</h2>
            <button onclick="closeAssignModal()" class="text-slate-400 hover:text-slate-900 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('assignments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="complaint_id" id="assign_complaint_id">
            <div class="mb-8">
                <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-3">Choose Cleaning Staff <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="staff_id" class="w-full rounded-2xl border border-slate-100 bg-slate-50 px-6 py-4 text-slate-700 font-bold focus:border-primary/50 focus:bg-white focus:ring-4 focus:ring-primary/10 transition-all outline-none appearance-none cursor-pointer" required>
                        <option value="" disabled selected>Select a staff member...</option>
                        @foreach($staff as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} (Staff)</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-6 flex items-center pointer-events-none text-slate-400">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>
            <div class="flex gap-4">
                <x-button type="submit" variant="primary" class="flex-1 py-4 text-sm shadow-glow">Assign Task Now</x-button>
                <x-button type="button" variant="outline" class="flex-1 py-4 text-sm" onclick="closeAssignModal()">Nevermind</x-button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function openAssignModal(id) {
        document.getElementById('assign_complaint_id').value = id;
        document.getElementById('assignModal').style.display = 'flex';
    }
    function closeAssignModal() {
        document.getElementById('assignModal').style.display = 'none';
    }

    // Common Chart Configuration
    Chart.defaults.font.family = "'Inter', sans-serif";
    Chart.defaults.color = '#94A3B8';
    Chart.defaults.plugins.tooltip.backgroundColor = '#0F172A';
    Chart.defaults.plugins.tooltip.padding = 12;
    Chart.defaults.plugins.tooltip.cornerRadius = 12;

    // Status Distribution Chart
    new Chart(document.getElementById('statusChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($stats['status_distribution']->keys()) !!},
            datasets: [{
                data: {!! json_encode($stats['status_distribution']->values()) !!},
                backgroundColor: ['#F59E0B', '#0EA5E9', '#10B981'],
                hoverOffset: 15,
                borderWidth: 0,
                borderRadius: 4
            }]
        },
        options: {
            cutout: '75%',
            plugins: {
                legend: { position: 'bottom', labels: { padding: 25, usePointStyle: true, font: { weight: '600', size: 12 } } }
            },
            maintainAspectRatio: false
        }
    });

    // Complaint Trends Chart
    new Chart(document.getElementById('trendChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: {!! json_encode($stats['complaint_trends']->keys()) !!},
            datasets: [{
                label: 'New Complaints',
                data: {!! json_encode($stats['complaint_trends']->values()) !!},
                borderColor: '#4F46E5',
                backgroundColor: 'rgba(79, 70, 229, 0.05)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#4F46E5',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { color: '#F1F5F9', drawBorder: false }, ticks: { stepSize: 1 } },
                x: { grid: { display: false }, ticks: { font: { weight: '500' } } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });

    // Area Distribution Chart
    new Chart(document.getElementById('areaChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($stats['area_distribution']->keys()) !!},
            datasets: [{
                data: {!! json_encode($stats['area_distribution']->values()) !!},
                backgroundColor: '#0EA5E9',
                borderRadius: 12,
                barThickness: 32,
                hoverBackgroundColor: '#0284C7'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true, grid: { color: '#F1F5F9', drawBorder: false }, ticks: { stepSize: 1 } },
                x: { grid: { display: false }, ticks: { font: { weight: '600' } } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endpush
</x-app-layout>
