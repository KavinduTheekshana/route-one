@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/job-card.css') }}">
@endpush


@extends('layouts.frontend')

@section('content')
@section('page_name', 'Job List')
@include('frontend.components.hero')
@include('frontend.jobs.job')


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
                    title: 'Login Required',
                    text: 'You need to be logged in to apply for a job. Please log in to continue.',
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
