<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Assignment;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'staff_id' => 'required|exists:users,id',
        ]);

        Assignment::create([
            'complaint_id' => $request->complaint_id,
            'staff_id' => $request->staff_id,
            'assigned_by' => Auth::id(),
            'status' => 'assigned',
        ]);

        Complaint::where('id', $request->complaint_id)->update(['status' => 'in_progress']);

        return back()->with('success', 'Work assigned to staff successfully!');
    }

    public function complete(Assignment $assignment)
    {
        $assignment->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);

        // Automatically mark the parent complaint as resolved when assignment is done
        $assignment->complaint->update(['status' => 'resolved']);
        
        return back()->with('success', 'Task marked as completed and resident notified!');
    }

    public function notifyResident(Request $request)
    {
        $request->validate(['complaint_id' => 'required|exists:complaints,id']);
        
        Complaint::where('id', $request->complaint_id)->update(['status' => 'resolved']);
        
        return back()->with('success', 'Resident notified. Complaint marked as resolved!');
    }
}
