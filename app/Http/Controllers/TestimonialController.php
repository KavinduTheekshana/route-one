<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function list()
    {
        $testimonials = Testimonial::orderBy('created_at', 'desc')
        ->get();
        return view('backend.testimonial.manage',compact('testimonials'));
    }
    public function testimonial_settings($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.create', compact('testimonial'));
    }
    public function create()
    {
        return view('backend.testimonial.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'testimonial_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'review' => 'required|string',
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->review = $request->review;

        if ($request->hasFile('testimonial_image')) {
            $path = $request->file('testimonial_image')->store('testimonials', 'public');
            $testimonial->file_path = $path;
        }

        $testimonial->save();

        return redirect()->back()->with('success', 'Testimonial created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'testimonial_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'review' => 'required|string',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->name = $request->name;
        $testimonial->title = $request->title;
        $testimonial->review = $request->review;

        if ($request->hasFile('testimonial_image')) {
            $path = $request->file('testimonial_image')->store('testimonials', 'public');
            $testimonial->file_path = $path;
        }

        $testimonial->save();

        return redirect()->back()->with('success', 'Testimonial updated successfully.');
    }

    public function block(Testimonial $testimonial)
    {
        $testimonial->status = 0;
        $testimonial->save();
        return redirect()->back()->with('success', 'Testimonial has been disabled successfully.');
    }

    public function unblock(Testimonial $testimonial)
    {
        $testimonial->status = 1;
        $testimonial->save();
        return redirect()->back()->with('success', 'Testimonial has been activate successfully.');
    }
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->back()->with('success', 'Testimonial deleted successfully!');
    }

}
