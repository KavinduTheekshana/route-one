@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/job-card.css') }}">
@endpush

@extends('layouts.frontend')
@section('content')
@section('page_name', 'My Account')
@include('frontend.components.hero')
<div class="container-xl px-4 mt-4">

    @include('frontend.auth.dashboard.components.nav')

    @include('frontend.components.alert')

    <div class="container mb-8">
        <div class="row">
            @foreach ($vacancies as $vacancy)
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                    <div class="jbs-grid-layout border">
                        <div class="right-tags-capt">
                            @if ($vacancy->job->featured)
                                <span class="featured-text">Featured</span>
                            @endif
                            @if ($vacancy->job->urgent)
                                <span class="urgent">Urgent</span>
                            @endif
                        </div>
                        <div class="jbs-grid-emp-head">
                            <div class="jbs-grid-emp-thumb"><a href="job-detail.html">
                                    <figure><img
                                            src="{{ $vacancy->job->file_path ? asset('storage/' . $vacancy->job->file_path) : asset('backend/images/bg/default.png') }}"
                                            class="img-fluid" alt=""></figure>
                                </a></div>
                        </div>
                        <div class="jbs-grid-job-caption">
                            <div class="jbs-job-employer-wrap"><span>{{ $vacancy->job->company }}</span></div>
                            <div class="jbs-job-title-wrap">
                                <h4><a href="job-detail.html" class="jbs-job-title">{{ $vacancy->job->title }}</a></h4>
                            </div>
                        </div>
                        <div class="jbs-grid-job-info-wrap">
                            <div class="jbs-grid-job-info">
                                <div class="jbs-grid-single-info"><span><i
                                            class="fa-solid fa-location-dot"></i>{{ $vacancy->job->location }}</span>
                                </div>
                                <div class="jbs-grid-single-info"><span><i
                                            class="fa-regular fa-clock"></i>{{ ucfirst(str_replace('-', ' ', $vacancy->job->job_type)) }}
                                    </span>
                                </div>
                                <div class="jbs-grid-single-info"><span><i class="fa-solid fa-calendar"></i>
                                        @if ($vacancy->job->experience === 'No')
                                            No Experience Needed
                                        @else
                                            {{ $vacancy->job->experience }} Years Experience Needed
                                        @endif
                                    </span></div>
                            </div>
                        </div>
                        <div class="jbs-grid-job-description">
                            <p>{{ Str::limit($vacancy->job->meta_description, 100, '...') }}
                            </p>
                        </div>
                        <div class="jbs-grid-job-edrs">
                            <div class="jbs-grid-job-edrs-group">
                                @foreach (explode(',', $vacancy->job->tags) as $tag)
                                    <span>{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="jbs-grid-job-package-info">
                            <div class="jbs-grid-package-title">
                                @if (!empty($vacancy->job->salary))
                                    <h5>£{{ number_format($vacancy->job->salary) }}<span>\Year</span></h5>
                                @endif
                            </div>
                            <div class="jbs-grid-posted">
                                <span>{{ \Carbon\Carbon::parse($vacancy->job->created_at)->format('d F Y') }}</span>
                            </div>
                        </div>
                        <div class="jbs-grid-job-apply-btns mt-2">
                            <div class="jbs-btn-groups">
                                <a href="{{ route('vacancies.show', $vacancy->job->id) }}"
                                    class="btn-md btn-light-primary px-4">View Detail</a>


                                    <button type="submit" data-application-id="{{ $vacancy->id }}" class="btn btn-danger delete-application px-4 apply-btn apply-btn-danger">Delete
                                        Application</button>




                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



</div>




@endsection

@push('scripts')
<script>
    document.querySelectorAll('.delete-application').forEach(button => {
        button.addEventListener('click', function() {
            const applicationId = this.getAttribute('data-application-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This application will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make the AJAX request to delete the application
                    fetch(`/user/application/destroy/${applicationId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: data.message,
                            }).then(() => {
                                window.location.reload(); // Reload the page after deletion
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message,
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong! Please try again later.',
                        });
                    });
                }
            });
        });
    });
</script>
@endpush
