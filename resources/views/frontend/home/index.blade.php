@extends('layouts.frontend')

@section('content')
    @include('frontend.home.slider')
    @include('frontend.home.agent')
    @include('frontend.home.about')
    @include('frontend.home.service')

    @include('frontend.home.benefits')
    @include('frontend.home.testimonial')

    @include('frontend.home.contact')
    @include('frontend.home.companies')











@endsection
@push('scripts')
<script>
    $(document).ready(function () {
        $('#contactForm').on('submit', function (e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Clear previous error messages and success message
            $('.text-danger').html('');
            $('#success_message').html('');

            $.ajax({
                url: "{{ route('contact.store') }}", // Laravel route
                method: "POST",
                data: formData,
                success: function (response) {
                    $('#success_message').html(response.success); // Show success message
                    $('#contactForm')[0].reset(); // Reset the form fields
                },
                error: function (xhr) {
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function (key, value) {
                            $('#' + key + '_error').html(value[0]); // Display error messages
                        });
                    }
                }
            });
        });
    });
</script>
@endpush