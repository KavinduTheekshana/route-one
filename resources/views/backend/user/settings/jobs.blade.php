<!-- Password Tab Start -->
<div class="tab-pane fade" id="pills-jobs" role="tabpanel" aria-labelledby="pills-jobs-tab" tabindex="0">

    <div class="card mt-24">
        <div class="card-header border-bottom">
            <h4 class="mb-4">Applied Positions</h4>
            <p class="text-gray-600 text-15">Selected Positions Applied by the User: {{ $user->name }}</p>
        </div>
        <div class="card-body">
            @foreach ($vacancies as $vacancy)
                <!-- Upload Card item Start -->
                <div class="upload-card-item p-16 rounded-12 bg-main-50 mb-20">
                    <div class="flex-between flex-wrap gap-4">
                        <div class="flex-align gap-10">
                            <img src="{{ $vacancy->job->file_path ? asset('storage/' . $vacancy->job->file_path) : asset('backend/images/bg/default.png') }}"
                                alt="w-88 h-56 rounded-8" class="job-image">
                            <div class="">
                                <p class="text-15 text-gray-500">{{ $vacancy->job->title }}</p>
                            </div>
                        </div>

                        <div class="flex-align gap-8">

                            <!-- Dropdown Start -->
                            <div class="dropdown flex-shrink-0">
                                <button class="text-gray-600 text-xl d-flex rounded-4" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ph-fill ph-dots-three-outline"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu--md border-0 bg-transparent p-0">
                                    <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                                        <div class="card-body p-12">
                                            <div class="max-h-200 overflow-y-auto scroll-sm pe-8">
                                                <ul>
                                                    <li class="mb-0">

                                                        <a href="{{ route('vacancies.show', $vacancy->job->id) }}"
                                                            type="button" target="_blank"
                                                            class="view-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                            <span class="text">View</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dropdown end -->
                        </div>
                    </div>
                    <p class="mt-20 pt-20 border-top border-main-200">{{ $vacancy->job->meta_description }}</p>
                </div>
                <!-- Upload Card item End -->
            @endforeach
            @if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'agent')
                <div class="flex-align justify-content-end gap-8 mt-20">
                    <a href="javascript:void(0);" class="btn btn-main rounded-pill py-9" data-bs-toggle="modal"
                        data-bs-target="#assignPositionModal">Assign Position</a>
                </div>
            @endif
        </div>




    </div>
</div>


<div class="row">



</div>
</div>
<!-- Password Tab End -->


<!-- Modal -->
<div class="modal fade" id="assignPositionModal" tabindex="-1" aria-labelledby="assignPositionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignPositionModalLabel">Assign Position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignPositionForm">
                    @csrf
                    <div class="form-group">
                        <label for="vacancy">Select Vacancy</label>
                        <select name="vacancy_id" id="vacancy" class="form-control">
                            <!-- Dynamically load vacancies here -->
                            @foreach ($jobs as $vacancy)
                                <option value="{{ $vacancy->id }}">{{ $vacancy->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePositionBtn">Save</button>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#savePositionBtn').on('click', function() {
            let formData = $('#assignPositionForm').serialize();

            $.ajax({
                url: '{{ route('assign.position') }}', // Your route for saving the data
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert('Position assigned successfully');
                        $('#assignPositionModal').modal('hide');
                        location.reload();
                    } else {
                        alert('Failed to assign position');
                    }
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseText);
                }
            });
        });
    </script>
@endpush
