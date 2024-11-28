<?php

namespace App\Http\Controllers;

use App\Models\Calander;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalanderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.calander.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getData()
    {
        $events = Calander::all();

        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start_date' => Carbon::parse($event->start_date)->toIso8601String(),
                'end_date' => Carbon::parse($event->end_date)->toIso8601String(),
                'description' => $event->description,
            ];
        });

        return response()->json($formattedEvents);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        Calander::create($request->all());
        return response()->json(['message' => 'Appointment added successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Calander $calander)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calander $calander)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calander $calander)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calander $calander)
    {
        //
    }
}
