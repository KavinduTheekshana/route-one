@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.2/css/uikit.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.uikit.css">

    <style>
        a:hover {
            text-decoration: none !important;
        }

        ol,
        ul {
            padding-left: 0 !important;
        }
    </style>
@endpush

@extends('layouts.backend')

@section('content')
    {{-- Breadcrumb  --}}
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
    @section('page_name', 'Create Staff Hierarchy')
    @include('backend.components.breadcrumb')
</div>

@include('backend.components.alert')



<div class="card">
    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
        <h5 class="mb-0">Create Staff Hierarchy</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('user.submit.details') }}" method="POST" class="form-content pt-4">
            @csrf
            <div class="row gy-20">
                <div class="col-xxl-12 col-md-12 col-sm-12">
                    <div class="row g-20">
                        <div class="col-sm-6">
                            <label for="name" class="h5 mb-8 fw-semibold font-heading">Full Name <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <div class="position-relative">
                                <input type="text" name="name" required
                                    class="text-counter placeholder-13 form-control py-11 pe-76"
                                    placeholder="Full Name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="position" class="h5 mb-8 fw-semibold font-heading">Position <span
                                    class="text-13 text-red fw-medium">(Required)</span></label>
                            <div class="position-relative">
                                <input type="text" name="position" required
                                    class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Position">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="manager_id" class="h5 mb-8 fw-semibold font-heading">Manager</label>
                            <div class="position-relative">
                                <select name="manager_id" class="form-control">
                                    <option value="">Select Manager</option>
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex-align justify-content-end gap-8">
                    <button type="button" class="btn btn-outline-main rounded-pill py-9" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-main rounded-pill py-9">Continue</button>
                </div>
            </div>
        </form>

    </div>
</div>


<div class="card mt-12">
    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
        <h5 class="mb-0">Staff Hierarchy</h5>
    </div>
    <div class="card-body">
        <table id="example" class="uk-table uk-table-hover uk-table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Manager</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staff as $member)
                    <tr>
                        <td>{{ $member->id }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->position }}</td>
                        <td>{{ $member->manager ? $member->manager->name : 'N/A' }}</td>
                        <td>
                            <form action="{{ route('staff.destroy', $member->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Manager</th>
                    <th>Actions</th>
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
    $(document).ready(function() {
        $('#example').DataTable({
            autoWidth: true // Disable automatic column width calculation
        });
    });
</script>
@endpush
