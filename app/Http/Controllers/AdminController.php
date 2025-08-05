<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Status;
use App\Models\LabStatusLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $labs = Lab::with('status')->orderBy('name')->get();
        $statuses = Status::all();
        
        return view('admin.dashboard', compact('labs', 'statuses'));
    }

    public function index()
    {
        $labs = Lab::with('status')->orderBy('name')->get();
        return view('admin.labs.index', compact('labs'));
    }

    public function create()
    {
        $statuses = Status::all();
        return view('admin.labs.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id'
        ]);

        $lab = Lab::create($validated);

        // Log status change
        LabStatusLog::create([
            'lab_id' => $lab->id,
            'status_id' => $validated['status_id'],
            'changed_by' => Auth::id(),
            'notes' => 'Lab dibuat dengan status awal'
        ]);

        return redirect()->route('admin.labs.index')->with('success', 'Lab berhasil ditambahkan!');
    }

    public function edit(Lab $lab)
    {
        $statuses = Status::all();
        return view('admin.labs.edit', compact('lab', 'statuses'));
    }

    public function update(Request $request, Lab $lab)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:statuses,id'
        ]);

        $oldStatusId = $lab->status_id;
        $lab->update($validated);

        // Log status change if status changed
        if ($oldStatusId != $validated['status_id']) {
            LabStatusLog::create([
                'lab_id' => $lab->id,
                'status_id' => $validated['status_id'],
                'changed_by' => Auth::id(),
                'notes' => 'Status diubah melalui edit lab'
            ]);
        }

        return redirect()->route('admin.labs.index')->with('success', 'Lab berhasil diperbarui!');
    }

    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()->route('admin.labs.index')->with('success', 'Lab berhasil dihapus!');
    }

    public function updateStatus(Request $request, Lab $lab)
    {
        $request->validate([
            'status_id' => 'required|exists:statuses,id',
            'notes' => 'nullable|string|max:500'
        ]);

        $oldStatusId = $lab->status_id;
        $lab->update(['status_id' => $request->status_id]);

        // Log status change
        LabStatusLog::create([
            'lab_id' => $lab->id,
            'status_id' => $request->status_id,
            'changed_by' => Auth::id(),
            'notes' => $request->notes ?? 'Status diubah'
        ]);

        if ($request->ajax()) {
            $lab->load('status');
            return response()->json([
                'success' => true,
                'message' => 'Status lab berhasil diperbarui!',
                'lab' => $lab
            ]);
        }

        return redirect()->back()->with('success', 'Status lab berhasil diperbarui!');
    }
}
