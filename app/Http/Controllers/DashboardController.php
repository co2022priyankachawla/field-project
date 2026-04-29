<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Complaint;
use App\Models\Assignment;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = $this->getStats();

        if ($user->isResident()) {
            $complaints = Complaint::with('feedback')->where('resident_id', $user->id)->latest()->get();
            $stats['resident_total'] = $complaints->count();
            $stats['resident_pending'] = $complaints->where('status', 'pending')->count();
            $stats['resident_completed'] = $complaints->where('status', 'resolved')->count() + $complaints->where('status', 'completed')->count();
            return view('dashboard.resident', compact('stats', 'complaints'));
        }

        if ($user->isSecretary()) {
            $complaints = Complaint::with('resident', 'assignments.staff')->latest()->get();
            $staff = User::where('role', 'staff')->get();
            return view('dashboard.secretary', compact('stats', 'complaints', 'staff'));
        }

        if ($user->isStaff()) {
            $assignments = Assignment::with(['complaint', 'complaint.feedback'])->where('staff_id', $user->id)->latest()->get();
            $stats['staff_total'] = $assignments->count();
            $stats['staff_completed'] = $assignments->where('status', 'completed')->count();
            return view('dashboard.staff', compact('stats', 'assignments'));
        }

        return redirect('/');
    }

    private function getStats()
    {
        return [
            'total' => Complaint::count(),
            'pending' => Complaint::where('status', 'pending')->count(),
            'in_progress' => Complaint::where('status', 'in_progress')->count(),
            'resolved' => Complaint::where('status', 'resolved')->count(),
            'avg_rating' => Feedback::avg('rating') ?: 0,
            'avg_resolution_time' => $this->getAvgResolutionTime(),
            'status_distribution' => Complaint::select('status', DB::raw('count(*) as count'))->groupBy('status')->pluck('count', 'status'),
            'top_areas' => Complaint::select('area', DB::raw('count(*) as count'))->groupBy('area')->orderBy('count', 'desc')->limit(5)->get(),
            'area_distribution' => Complaint::select('area', DB::raw('count(*) as count'))->groupBy('area')->pluck('count', 'area'),
            'complaint_trends' => $this->getTrendData(),
        ];
    }

    private function getTrendData()
    {
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $days->put(now()->subDays($i)->format('Y-m-d'), 0);
        }

        $trends = Complaint::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->get()
            ->pluck('count', 'date');

        return $days->merge($trends);
    }

    private function getAvgResolutionTime()
    {
        // Example logic: average difference between created_at and completed_at in assignments
        $avgSeconds = Assignment::whereNotNull('completed_at')
            ->join('complaints', 'assignments.complaint_id', '=', 'complaints.id')
            ->select(DB::raw('AVG(TIMESTAMPDIFF(SECOND, complaints.created_at, assignments.completed_at)) as avg_time'))
            ->first()->avg_time;

        return $avgSeconds ? round($avgSeconds / 3600, 1) . ' hrs' : 'N/A';
    }
}
