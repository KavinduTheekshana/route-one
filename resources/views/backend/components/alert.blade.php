@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@push('scripts')
{{-- <script>
    // Hide success alert after 15 seconds (15000 milliseconds)
    setTimeout(function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.transition = 'opacity 0.5s ease'; // Smooth fade-out
            successAlert.style.opacity = '0'; // Fade out the alert
            setTimeout(() => successAlert.remove(), 500); // Remove after fade-out
        }
    }, 30000);

    // Hide error alert after 15 seconds (15000 milliseconds)
    setTimeout(function() {
        let errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.style.transition = 'opacity 0.5s ease'; // Smooth fade-out
            errorAlert.style.opacity = '0'; // Fade out the alert
            setTimeout(() => errorAlert.remove(), 500); // Remove after fade-out
        }
    }, 30000);
</script> --}}
@endpush