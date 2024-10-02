@extends('layouts.frontend')

@section('content')
@section('page_name', 'Contact Us')
@include('frontend.components.hero')
@include('frontend.contact.form')
@include('frontend.contact.map')


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