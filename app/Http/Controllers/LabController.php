<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labs = Lab::with('status')->get();
        return view('labs.index', compact('labs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::all();
        return view('labs.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id'
        ]);

        Lab::create($request->all());

        return redirect()->route('labs.index')->with('success', 'Lab berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lab $lab)
    {
        $lab->load(['status', 'statusLogs.changedBy', 'statusLogs.previousStatus', 'statusLogs.newStatus']);
        $statuses = Status::all();
        return view('labs.show', compact('lab', 'statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lab $lab)
    {
        $statuses = Status::all();
        return view('labs.edit', compact('lab', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lab $lab)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'location' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id'
        ]);

        $previousStatus = $lab->status_id;
        $lab->update($request->all());

        // Log perubahan status jika status berubah dan ada user yang login
        if ($previousStatus != $request->status_id && Auth::check()) {
            $lab->statusLogs()->create([
                'previous_status_id' => $previousStatus,
                'new_status_id' => $request->status_id,
                'changed_by' => Auth::id(),
                'changed_at' => now(),
            ]);
        }

        return redirect()->route('labs.index')->with('success', 'Lab berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()->route('labs.index')->with('success', 'Lab berhasil dihapus!');
    }
}
