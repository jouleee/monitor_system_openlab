<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $labs = Lab::with('status')->orderBy('name')->get();
        $statuses = Status::all();
        
        return view('dashboard.index', compact('labs', 'statuses'));
    }

    public function getLabStatus()
    {
        $labs = Lab::with('status')->orderBy('name')->get();
        
        return response()->json([
            'labs' => $labs->map(function ($lab) {
                return [
                    'id' => $lab->id,
                    'name' => $lab->name,
                    'location' => $lab->location,
                    'capacity' => $lab->capacity,
                    'status' => [
                        'id' => $lab->status->id,
                        'name' => $lab->status->name,
                        'color' => $lab->status->color,
                        'description' => $lab->status->description
                    ],
                    'updated_at' => $lab->updated_at->format('H:i:s')
                ];
            })
        ]);
    }
}
