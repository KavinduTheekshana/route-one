@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.uikit.css">
    <style>
        ol,
        ul {
            padding-left: 0 !important;
        }

        *+address,
        *+dl,
        *+fieldset,
        *+figure,
        *+ol,
        *+p,
        *+pre,
        *+ul {
            margin-top: 0 !important;
        }

        .round-image {
            border-radius: 50%;
            object-fit: cover;
            /* Ensures the image covers the area */
        }

        a:hover {
            text-decoration: none !important;
        }

        .ml-auto-mw-80 {
            margin-left: auto !important;
            max-width: 80%;
        }



        .open-form-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1;
        }

        .form-container {
            position: fixed;
            top: 75px;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: #ffffff;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            overflow-x: hidden;
            transition: 0.5s ease;
            z-index: 2;
            padding-bottom: 100px;
            overflow: scroll;
        }

        .form-content {
            margin: 20px;
        }

        .form-content input,
        .form-content textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-content button {
            padding: 10px;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
        }

        /* Add animation class */
        .form-container.active {
            right: 0;
        }

        /* Close button styling */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        /* Close button hover effect */
        .close-btn:hover {
            color: red;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Team Management')
    @include('backend.components.breadcrumb')

    <!-- Breadcrumb Right Start -->
    <div class="flex-align gap-8 flex-wrap">

        <div
            class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
            <span class="text-lg"><i class="ph ph-plus"></i></span>
            <button id="openFormBtn"
                class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">ADD MEMBER</button>
        </div>
    </div>
    <!-- Breadcrumb Right End -->
</div>

@include('backend.team.add')

@include('backend.components.alert')

<div class="card overflow-hidden p-16">
    <h4 class="mb-0 ml-4"><b>Routeone Team Management</b></h4>
    <div class="card-body p-16">


        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Join date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td><img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}" alt="Profile Image" width="50px"
                                class="rounded-circle round-profile" height="50px"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->user_type) }}</td>
                        <td>{{ $user->country ?? 'N/A' }}</td>
                        <td>
                            @if ($user->status == 1)
                                <span
                                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    Active
                                </span>
                            @else
                                <span
                                    class="text-13 py-2 px-8 bg-pink-50 text-pink-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-pink-600 rounded-circle flex-shrink-0"></span>
                                    Disabled
                                </span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if (Auth::id() == $user->id)
                                <a href="{{ route('auth.account') }}" class="btn btn-warning btn-sm"><i
                                        class="ph ph-eye"></i></a>
                            @endif

                            @if (Auth::id() !== $user->id)
                                @if ($user->status == 1)
                                    <a href="{{ route('team.block', $user->id) }}" class="btn btn-danger btn-sm"><i class="ph ph-lock"></i></a>
                                @else
                                    <a href="{{ route('team.unblock', $user->id) }}" class="btn btn-success btn-sm"><i class="ph ph-lock-open"></i></a>
                                @endif

                                <a href="{{ route('team.settings', $user->id) }}" class="btn btn-warning btn-sm"><i
                                        class="ph ph-eye"></i></a>
                                <!-- Delete Button -->
                                <button class="btn btn-dark btn-sm" onclick="confirmDelete({{ $user->id }})">
                                    <i class="ph ph-trash"></i>
                                </button>

                                <!-- Delete Form -->
                                <form id="delete-form-{{ $user->id }}"
                                    action="{{ route('team.destroy', $user->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Country</th>
                    <th>Status</th>
                    <th>Join date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>


    </div>

</div>


@endsection

@push('scripts')
{{-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/js/uikit.min.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.6/js/dataTables.uikit.js"></script>
<script>
    new DataTable('#example');
</script>

<script>
    // Get the button, form container, and close button
    const openFormBtn = document.getElementById('openFormBtn');
    const formContainer = document.getElementById('formContainer');
    const closeFormBtn = document.getElementById('closeFormBtn');

    // Event listener to open the form
    openFormBtn.addEventListener('click', function() {
        formContainer.classList.add('active'); // Add 'active' to slide in the form
    });

    // Event listener to close the form
    closeFormBtn.addEventListener('click', function() {
        formContainer.classList.remove('active'); // Remove 'active' to hide the form
    });
</script>

<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('delete-form-' + userId).submit();
            }
        });
    }
</script>
@endpush
