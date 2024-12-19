<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\User;
use App\Models\Vacancies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class VacanciesController extends Controller
{

    public function search(Request $request)
    {

        $user = auth()->user();

        // Create an array to store applied job IDs if the user is authenticated
        $appliedJobIds = [];
        if ($user) {
            $appliedJobIds = JobApplication::where('user_id', $user->id)
                ->pluck('vacancies_id')
                ->toArray();
        }

        // Retrieve the search keyword from the request
        $keyword = $request->input('keyword');

        // Query the vacancies with a condition on the title, description, etc.
        // $vacancies = Vacancies::where('status', 1)
        // ->orderBy('created_at', 'desc')
        // ->get();

        $vacancies = Vacancies::where('title', 'like', "%$keyword%")
            ->orWhere('company', 'like', "%$keyword%")
            ->orWhere('location', 'like', "%$keyword%")
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the result to the view
        return view('frontend.jobs.index', compact('vacancies', 'appliedJobIds'));
    }




    public function list()
    {
        // Get the authenticated user ID
        $user_id = Auth::user()->id;

        // Retrieve vacancies for the authenticated user, ordered by created_at in descending order
        $vacancies = Vacancies::where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Return the view with the vacancies data
        return view('backend.vacancies.manage', compact('vacancies'));
    }
    public function create()
    {
        return view('backend.vacancies.create');
    }

    public function vacancies_update3(Request $request, Vacancies $vacancy)
    {
        // Validate request data
        $validatedData = $request->validate([
            'company' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'meta_description' => 'required|string',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image', // Ensure it's an image if uploaded
            'featured' => 'nullable|boolean',
            'urgent' => 'nullable|boolean',
        ]);

        // Store the uploaded image if a new one is provided
        if ($request->hasFile('profile_image')) {
            // Store the new image and get the path
            $imagePath = $request->file('profile_image')->store('vacancy_images', 'public');
        } else {
            // Retain the existing image path if no new image is uploaded
            $imagePath = $vacancy->file_path; // Keep the existing image path
        }

        // Update the vacancy with the new data
        $vacancy->update([
            'company' => $validatedData['company'],
            'title' => $validatedData['title'],
            'location' => $validatedData['location'],
            'job_type' => $validatedData['job_type'],
            'meta_description' => $validatedData['meta_description'],
            'description' => $validatedData['description'],
            'salary' => $validatedData['salary'] ?? null,
            'tags' => $validatedData['tags'] ?? null,
            'experience' => $validatedData['experience'] ?? null,
            'file_path' => $imagePath, // Use the new or existing image path
            'featured' => $validatedData['featured'] ?? false,
            'urgent' => $validatedData['urgent'] ?? false,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Vacancy updated successfully!');
    }


    public function vacancies_update(Request $request, $id)
    {
        // Validate request data
        $validatedData = $request->validate([
            'company' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'meta_description' => 'required|string',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048', // Validate as an image and max size
            'featured' => 'nullable|boolean',
            'urgent' => 'nullable|boolean',
        ]);

        $vacancy = Vacancies::findOrFail($id);
        $imagePath = $vacancy->file_path; // Corrected property name
        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('vacancy_images', 'public');
        }

        // Update the vacancy directly using query builder
        DB::table('vacancies')->where('id', $id)->update([
            'company' => $validatedData['company'],
            'title' => $validatedData['title'],
            'location' => $validatedData['location'],
            'job_type' => $validatedData['job_type'],
            'meta_description' => $validatedData['meta_description'],
            'description' => $validatedData['description'],
            'salary' => $validatedData['salary'] ?? null,
            'tags' => $validatedData['tags'] ?? null,
            'experience' => $validatedData['experience'] ?? null,
            'file_path' => $imagePath,
            'featured' => $validatedData['featured'] ?? false,
            'urgent' => $validatedData['urgent'] ?? false,
        ]);

        return redirect()->back()->with('success', 'Vacancy updated successfully!');
    }



    public function vacancies_update2(Request $request, Vacancies $vacancy)
    {
        // Validate request data
        $validatedData = $request->validate([
            'company' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'meta_description' => 'required|string',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048', // Validate as an image and max size
            'featured' => 'nullable|boolean',
            'urgent' => 'nullable|boolean',
        ]);

        dd($validatedData);

        // Handle file upload
        $imagePath = $vacancy->file_path; // Keep the existing image path
        if ($request->hasFile('profile_image')) {
            // Store the uploaded image and get the path
            $imagePath = $request->file('profile_image')->store('vacancy_images', 'public');
        }

        // Update the vacancy
        $vacancy->update([
            'company' => $validatedData['company'],
            'title' => $validatedData['title'],
            'location' => $validatedData['location'],
            'job_type' => $validatedData['job_type'],
            'meta_description' => $validatedData['meta_description'],
            'description' => $validatedData['description'],
            'salary' => $validatedData['salary'] ?? null,
            'tags' => $validatedData['tags'] ?? null,
            'experience' => $validatedData['experience'] ?? null,
            'file_path' => $imagePath, // Update the file path if a new image was uploaded
            'featured' => $validatedData['featured'] ?? false, // Default to false if not provided
            'urgent' => $validatedData['urgent'] ?? false, // Default to false if not provided
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Vacancy updated successfully!');
    }



    public function store(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'company' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required|string',
            'meta_description' => 'required|string',
            'description' => 'required|string',
            'salary' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'profile_image' => 'nullable',
            'featured' => 'nullable|boolean',
            'urgent' => 'nullable|boolean',
        ]);

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('profile_image')) {
            // Store the uploaded image and get the path
            $imagePath = $request->file('profile_image')->store('vacancy_images', 'public');
        }

        // Generate a unique slug from the title
        $slug = Str::slug($validatedData['title']);

        // Ensure the slug is unique
        $existingSlugCount = Vacancies::where('slug', 'like', $slug . '%')->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }

        // Create the vacancy
        Vacancies::create([
            'user_id' => auth()->id(), // Set user_id from authenticated user
            'company' => $validatedData['company'],
            'title' => $validatedData['title'],
            'slug' => $slug, // Save the generated slug
            'location' => $validatedData['location'],
            'job_type' => $validatedData['job_type'],
            'meta_description' => $validatedData['meta_description'],
            'description' => $validatedData['description'],
            'salary' => $validatedData['salary'] ?? null,
            'tags' => $validatedData['tags'] ?? null,
            'experience' => $validatedData['experience'] ?? null, //
            'file_path' => $imagePath, // Assign the file path if an image was uploaded
            'featured' => $validatedData['featured'] ?? false, // Default to false if not provided
            'urgent' => $validatedData['urgent'] ?? false, // Default to false if not provided
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Vacancy created successfully!');
    }

    public function vacancies_settings($id)
    {
        $vacancy = Vacancies::findOrFail($id);
        return view('backend.vacancies.create', compact('vacancy'));
    }


    public function vacancies_block(Vacancies $vacancies)
    {
        $vacancies->status = 0;
        $vacancies->save();
        return redirect()->back()->with('success', 'Vacancy has been disabled successfully.');
    }

    public function vacancies_unblock(Vacancies $vacancies)
    {
        $vacancies->status = 1;
        $vacancies->save();
        return redirect()->back()->with('success', 'Vacancy has been activate successfully.');
    }

    public function vacancies_destroy(Vacancies $vacancies)
    {
        $vacancies->delete();
        return redirect()->back()->with('success', 'Vacancy deleted successfully!');
    }
}
