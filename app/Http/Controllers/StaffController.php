<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function create()
    {
        $managers = Staff::all();
        $staff = Staff::with('manager')->get();
        return view('backend.staff.create', compact('managers', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'manager_id' => 'nullable|exists:staff,id',
        ]);

        Staff::create([
            'name' => $request->name,
            'position' => $request->position,
            'manager_id' => $request->manager_id,
        ]);

        return redirect()->back()->with('success', 'Staff member added successfully.');
    }
    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->delete();

        return redirect()->back()->with('success', 'Staff deleted successfully.');
    }
}
