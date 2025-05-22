<?php

namespace App\Http\Controllers;

use App\Mail\AgentStatusUpdated;
use App\Models\Application;
use App\Models\Certificate;
use App\Models\Document;
use App\Models\Employee;
use App\Models\JobApplication;
use App\Models\Payslips;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserNotes;
use App\Models\Vacancies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => 1, // Assuming 1 means active
            'password' => Hash::make($request->password),
        ]);

        // Log the user in (optional)
        auth()->login($user);

        // Redirect to home/dashboard or wherever
        return redirect()->route('dashboard')->with('success', 'Registration successful!');
    }
    public function downloadUsersCsv()
    {
        $users = \App\Models\User::all(); // Fetch all users from the database

        $csvHeader = ['ID', 'Name', 'Email', 'Phone', 'Country', 'Status'];

        return Response::streamDownload(function () use ($users, $csvHeader) {
            $handle = fopen('php://output', 'w');

            // Write CSV header
            fputcsv($handle, $csvHeader);

            // Write user data
            foreach ($users as $user) {
                fputcsv($handle, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->phone,
                    $user->country,
                    $user->status ? 'Active' : 'Inactive',
                ]);
            }

            fclose($handle);
        }, 'users_data.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_data.csv"',
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'review' => 'required|string',
        // ]);
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'review' => 'required|string',
        ]);

        UserNotes::create([
            'user_id' => $validatedData['user_id'],
            'review' => $validatedData['review'],
            'admin_id' => Auth::id(),
        ]);

        // Update if the note exists, otherwise create a new one
        // UserNotes::Create(

        //     'user_id' => $request->user_id, // Check by user_id
        //     'review' => $request->review   // Update the review
        // );

        return redirect()->back()->with('success', 'Notes saved successfully!');
    }


    public function users()
    {
        $authUser = auth()->user();

        // Initialize the $users query
        if ($authUser->user_type === 'superadmin') {
            $users = User::where('user_type', '=', 'user')
                ->orderBy('id', 'desc')
                ->get();
        } elseif ($authUser->user_type === 'agent') {
            $users = User::where('user_type', 'user') // First condition
                ->where('agent_id', Auth::id()) // Second condition (AND)
                ->orderBy('id', 'desc') // Sort by id in descending order
                ->get();
        } else {
            abort(403, 'Unauthorized access');
        }



        return view('backend.user.manage.manage', compact('users'));
    }

    public function staff()
    {
        $authUser = auth()->user();

        // Check if the authenticated user is a superadmin
        if ($authUser->user_type === 'superadmin') {
            // Fetch users with user_type as 'user' and is_staff as 1
            $users = User::where('user_type', 'user')
                ->where('is_staff', 1)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            // Abort if the user is not authorized
            abort(403, 'Unauthorized access');
        }

        return view('backend.user.manage.manage', compact('users'));
    }

    public function staff_hierarchy()
    {
        $staff = Staff::with('subordinates')->whereNull('manager_id')->get();
        $hierarchy = $this->buildHierarchy($staff);
        return view('backend.user.manage.hierarchy', compact('hierarchy'));
    }

    private function buildHierarchy($staff)
    {
        return $staff->map(function ($member) {
            return [
                'name' => $member->name,
                'position' => $member->position, // Include position
                'image' => $member->image, // Include image
                'children' => $member->subordinates->isEmpty() ? [] : $this->buildHierarchy($member->subordinates),
            ];
        });
    }
    public function create()
    {
        return view('backend.user.create.index');
    }

    public function verification()
    {
        $users = User::where('user_type', 'unverifiedagent')
            ->with('documents') // Eager load documents if needed in the view
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.agent.index', compact('users'));
    }

    public function details(Request $request)
    {
    

        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Set default profile image if not provided


        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'user_type' => 'user',  // Assuming 'role' field corresponds to 'user_type'
            'country' => $validatedData['country'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'agent_id' => Auth::id(),
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Member created successfully!');
    }

    public function user_destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully!');
    }

    public function user_block(User $user)
    {
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('success', 'User has been disabled successfully.');
    }

    public function user_unblock(User $user)
    {
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('success', 'User has been activate successfully.');
    }

    public function agent_block(User $user)
    {
        $user->agent_verification = 0;
        $user->user_type = 'unverifiedagent';
        $user->save();
        return redirect()->back()->with('success', 'Agent has been disabled successfully.');
    }

    public function agent_unblock(User $user)
    {
        $user->user_type = 'agent';
        $user->save();
        $statusMessage = 'Your account has been activated and is now active.';
        Mail::to($user->email)->send(new AgentStatusUpdated($user, $statusMessage));
        return redirect()->back()->with('success', 'Agent has been activate successfully.');
    }

    public function user_settings($id)
    {
        $user = User::findOrFail($id);
        // $agent = User::findOrFail($id);
        $agent = User::where('id', $user->agent_id)->first();
        $documents = Document::where('user_id', $id)->get();
        $application = Application::where('user_id', $id)->first();
        $agents = User::where('user_type', 'agent')->get();

        $notes = UserNotes::with('admin')->where('user_id', $id)->get();
        $certificate = Certificate::where('user_id', $id)->first();
        $payslips = Payslips::where('user_id', $id)->orderBy('date', 'desc')->get();

        // Fetch the jobs that the user has applied for
        $vacancies = JobApplication::where('user_id', $user->id)
            ->with('job') // Assuming you have a relationship defined
            ->get();

        $jobs = Vacancies::get();
        return view('backend.user.settings.settings', compact('user', 'documents', 'application', 'agents', 'vacancies', 'jobs', 'notes', 'agent', 'certificate', 'payslips'));
    }

    public function user_update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Store the new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Save the updated user data
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'User Profile updated successfully.');
    }

    // Team Functions

    public function team()
    {
        $users = User::where('user_type', '!=', 'user')->get();
        return view('backend.team.manage', compact('users'));
    }

    public function settings($id)
    {
        $user = User::findOrFail($id);
        $documents = Document::where('user_id', $id)->get();
        return view('backend.team.settings', compact('user', 'documents'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'role' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->user_type = $request->input('role');

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }

            // Store the new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        // Save the updated user data
        $user->save();

        // Redirect back with a success message
        return redirect()->route('team.settings', $user->id)->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function member_store(Request $request)
    {
        // Validate the form input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,superadmin,teacher,agent',
            'email' => 'required|email|unique:users,email',
            'country' => 'nullable|string|max:255',
            'phone' => 'nullable|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Set default profile image if not provided
        // $defaultProfileImage = 'profile_images/setting-profile-img.webp'; // Path to default profile image

        // Create the user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'user_type' => $validatedData['role'],  // Assuming 'role' field corresponds to 'user_type'
            'country' => $validatedData['country'] ?? null,
            'phone' => $validatedData['phone'] ?? null,
            'password' => Hash::make($validatedData['password']),
            // 'profile_image' => $defaultProfileImage, // Assign the default profile image
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Member created successfully!');
    }

    public function updateStaffStatus(Request $request)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'is_staff' => 'required|boolean',
        ]);

        // Find the user and update the is_staff field
        $user = User::find($request->user_id);
        $user->is_staff = $request->is_staff;
        $user->save();

        // Return a success response
        return response()->json(['success' => true]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Member deleted successfully!');
    }

    public function block(User $user)
    {
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('success', 'Member has been disabled successfully.');
    }

    public function unblock(User $user)
    {
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('success', 'Member has been activate successfully.');
    }
}
