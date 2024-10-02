@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/job-card.css') }}">
@endpush


@extends('layouts.frontend')

@section('content')
    <div class="pt-152" style="background-image: url({{ asset('frontend/img/bg/hero5-bg.png') }});">
        <section class="bg-cover position-relative pt-140">
            <div class="position-absolute job-image end-0 top-0 bottom-0 d-lg-block d-none"
                style="background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0)), url('{{ $vacancy->file_path ? asset('storage/' . $vacancy->file_path) : asset('backend/images/bg/default.png') }}'); background-size: cover; background-position: center;">
            </div>


            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-9 col-md-12">


                        <div class="jbs-head-bodys-top my-5">
                            <div class="jbs-roots-y1 flex-column justify-content-start align-items-start">
                                <div class="jbs-roots-y1-last">
                                    <div class="jbs-urt mb-2"><span
                                            class="label text-light primary-2-bg">{{ $vacancy->company }}</span>
                                    </div>
                                    <div class="jbs-title-iop mb-1">
                                        <h2 class="m-0 fs-2 text-light">{{ $vacancy->title }}</h2>
                                    </div>

                                </div>
                                <div class="jbs-roots-y6 py-3">
                                    <p class="text-light">{{ $vacancy->meta_description }}</p>
                                </div>
                                <div class="jbs-roots-y6 py-3">
                                    @if ($hasApplied)
                                        <button class="btn btn-primary fw-medium px-lg-5 px-4 me-3" type="button"
                                            disabled>Already Applied</button>
                                    @else
                                        <button class="btn btn-primary fw-medium px-lg-5 px-4 me-3 apply-btn" type="button"
                                            id="applyJobBtn" data-job-id="{{ $vacancy->id }}">Apply Job</button>
                                    @endif
                                </div>


                            </div>
                        </div>

                        <div class="explot-info-details d-inline-flex flex-wrap">
                            <div class="single-explot d-flex align-items-center me-md-5 me-3 my-2">
                                <div class="single-explot-first">
                                    <i class="fa-solid fa-business-time text-primary fs-1"></i>
                                </div>
                                <div class="single-explot-last ps-2">
                                    <span class="text-light opacity-75">Job Type</span>
                                    <p class="text-light fw-bold fs-6 m-0">
                                        {{ ucfirst(str_replace('-', ' ', $vacancy->job_type)) }}</p>
                                </div>
                            </div>
                            <div class="single-explot d-flex align-items-center me-md-5 me-3 my-2">
                                <div class="single-explot-first">
                                    <i class="fa-solid fa-location-dot text-primary fs-1"></i>
                                </div>
                                <div class="single-explot-last ps-2">
                                    <span class="text-light opacity-75">Location</span>
                                    <p class="text-light fw-bold fs-6 m-0">{{ $vacancy->location }}</p>
                                </div>
                            </div>
                            <div class="single-explot d-flex align-items-center">
                                <div class="single-explot-first">
                                    <i class="fa-solid fa-sack-dollar text-primary fs-1"></i>
                                </div>
                                <div class="single-explot-last ps-2">
                                    <span class="text-light opacity-75">Sallary</span>
                                    <p class="text-light fw-bold fs-6 m-0">£{{ number_format($vacancy->salary) }} / Year
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>



    <section class="gray-simple">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">


                    <img class="mobile-job-image"
                        src="{{ $vacancy->file_path ? asset('storage/' . $vacancy->file_path) : asset('backend/images/bg/default.png') }}"
                        alt="" srcset="">
                    <div class="jbs-blocs style_03 b-0 mb-md-4 mb-sm-4">
                        <div class="jbs-blocs-body px-4 py-4">
                            <div class="jbs-content mb-4">
                                {!! $vacancy->description !!}

                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-lg-4 col-md-12">

                    <div class="jbs-blocs style_03 b-0 mb-md-4 mb-sm-4">
                        <div class="jbs-blocs-body px-4 py-4">
                            <div class="jbs-content">

                                {{-- <a href="{{ auth()->check() ? route('apply', $vacancy->id) : route('user.login') }}"
                                    class="btn btn-primary p-4 w-100 fw-medium px-lg-5 px-4 me-3" type="button">Apply
                                    Job</a> --}}
                                @if ($hasApplied)
                                    <button disabled class="btn btn-primary p-4 w-100 fw-medium px-lg-5 px-4 me-3"
                                        type="button">Already Applied</button>
                                @else
                                    <button class="btn btn-primary p-4 w-100 fw-medium px-lg-5 px-4 me-3 apply-btn"
                                        id="applyJobBtn" type="button" data-job-id="{{ $vacancy->id }}">Apply
                                        Job</button>
                                @endif
                            </div>

                        </div>

                    </div>


                    {{-- @foreach ($vacancies as $vacancy)
                        <div class="jbs-grid-layout border">
                            <div class="right-tags-capt">
                                @if ($vacancy->featured)
                                    <span class="featured-text">Featured</span>
                                @endif
                                @if ($vacancy->urgent)
                                    <span class="urgent">Urgent</span>
                                @endif
                            </div>
                            <div class="jbs-grid-emp-head">
                                <div class="jbs-grid-emp-thumb"><a href="job-detail.html">
                                        <figure><img
                                                src="{{ $vacancy->file_path ? asset('storage/' . $vacancy->file_path) : asset('backend/images/bg/default.png') }}"
                                                class="img-fluid" alt=""></figure>
                                    </a></div>
                            </div>
                            <div class="jbs-grid-job-caption">
                                <div class="jbs-job-employer-wrap"><span>{{ $vacancy->company }}</span></div>
                                <div class="jbs-job-title-wrap">
                                    <h4><a href="job-detail.html" class="jbs-job-title">{{ $vacancy->title }}</a></h4>
                                </div>
                            </div>
                            <div class="jbs-grid-job-info-wrap">
                                <div class="jbs-grid-job-info">
                                    <div class="jbs-grid-single-info"><span><i
                                                class="fa-solid fa-location-dot"></i>{{ $vacancy->location }}</span></div>
                                    <div class="jbs-grid-single-info"><span><i
                                                class="fa-regular fa-clock"></i>{{ ucfirst(str_replace('-', ' ', $vacancy->job_type)) }}
                                        </span>
                                    </div>
                                    <div class="jbs-grid-single-info"><span><i class="fa-solid fa-calendar"></i>
                                            @if ($vacancy->experience === 'No')
                                                No Experience Needed
                                            @else
                                                {{ $vacancy->experience }} Years Experience Needed
                                            @endif
                                        </span></div>
                                </div>
                            </div>
                            <div class="jbs-grid-job-description">
                                <p>{{ Str::limit($vacancy->meta_description, 100, '...') }}
                                </p>
                            </div>
                            <div class="jbs-grid-job-edrs">
                                <div class="jbs-grid-job-edrs-group">
                                    @foreach (explode(',', $vacancy->tags) as $tag)
                                        <span>{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="jbs-grid-job-package-info">
                                <div class="jbs-grid-package-title">
                                    @if (!empty($vacancy->salary))
                                        <h5>£{{ number_format($vacancy->salary) }}<span>\Year</span></h5>
                                    @endif
                                </div>
                                <div class="jbs-grid-posted">
                                    <span>{{ \Carbon\Carbon::parse($vacancy->created_at)->format('d F Y') }}</span>
                                </div>
                            </div>
                            <div class="jbs-grid-job-apply-btns mt-2">
                                <div class="jbs-btn-groups">
                                    <a href="{{ route('vacancies.show', $vacancy->id) }}"
                                        class="btn-md btn-light-primary px-4">View Detail</a>
                                    <a href="JavaScript:Void(0);" class="btn-md btn-primary px-4">Quick Apply</a>
                                </div>
                            </div>
                        </div>
                    @endforeach --}}
                </div>

            </div>
        </div>

    </section>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.apply-btn').forEach(button => {
        button.addEventListener('click', function() {
            const jobId = this.getAttribute('data-job-id'); // Get the job ID from the button's data attribute

            // Check if the user is authenticated
            const isAuthenticated = '{{ auth()->check() }}'; // This will be true or false based on the user's auth status

            if (!isAuthenticated) {
                // If not authenticated, show a login message
                Swal.fire({
                    icon: 'warning',
                    title: 'Signin Required',
                    text: 'You need to be signed in to apply for a job. Please sign in to continue.',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
                return; // Exit the function
            }

            // Show SweetAlert confirmation before applying
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to apply for this job?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, apply!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make the AJAX request to apply for the job
                    fetch('{{ route('user.jobs.apply') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            job_id: jobId
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                            }).then(() => {
                                window.location.reload(); // Reload the page after successful application
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
