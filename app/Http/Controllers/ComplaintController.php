<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Complaint;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    public function create()
    {
        return view('complaints.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'area' => 'required|string',
        ]);

        $path = $request->file('photo')->store('complaints', 'public');

        Complaint::create([
            'resident_id' => Auth::id(),
            'photo_path' => $path,
            'description' => $request->description,
            'area' => $request->area,
            'wing' => Auth::user()->wing,
            'floor' => Auth::user()->floor,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Complaint submitted successfully!');
    }

    public function feedback(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Feedback::create($request->all());

        return back()->with('success', 'Feedback submitted successfully!');
    }
}
