@push('styles')
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Routeone Bulk Mail System')
    @include('backend.components.breadcrumb')

</div>


@include('backend.components.alert')

<div class="row gy-4">

    <div class="col-xxl-6">
        <div class="card overflow-hidden p-16 ">
            <h4 class="mb-0 ml-4">Routeone Bulk Mail System</h4>
            <div class="card-body p-16">

                <div class="upload-card-item p-16 rounded-12 bg-main-50 mb-20 mt-4">
                    <div class="flex-align gap-10 flex-wrap">
                        <span class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                            <i class="ph ph-paperclip"></i>
                        </span>
                        <div class="upload-section">
                            <p class="text-15 text-gray-500">
                                Please Upload Your Email List
                                <label class="text-main-600 cursor-pointer file-label">Browse</label>
                                <input name="file" type="file" class="file-input" accept=".csv" hidden="">
                            </p>
                            <p class="text-13 text-gray-600">CSV format (max file size 10MB each)</p>
                            <span class="show-uploaded-passport-name d-none"></span>
                        </div>
                    </div>
                </div>

                <!-- Loading Screen -->
                <div id="loading-screen" style="display: none;">
                    <p>Loading... Please wait.</p>
                </div>

                <!-- Table to Display CSV Data -->
                <table id="csv-table" style="display: none; width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px;">#</th> <!-- Serial Number Column -->
                            <th style="border: 1px solid #ddd; padding: 8px;">Name</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Email</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>





            </div>

        </div>
    </div>

    <div class="col-xxl-6">
        <div class="card overflow-hidden p-16">
            <div class="card-body p-16">
                <div class="col-sm-12">
                    <label class="form-label mb-8 h6">Subject <span
                            class="text-13 text-red fw-medium">(Required)</span></label>
                    <div class="position-relative">
                        <input type="text" name="subject" required=""
                            class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Subject">
                    </div>
                </div>
                <br>
                <div class="col-12">
                    <div class="editor">
                        <label class="form-label mb-8 h6">Description <span
                                class="text-13 text-red fw-medium">(Required)</span></label>
                        <p class="text-gray"> <small>
                                You can personalize your email by including the recipient's name in the email body.
                                Simply
                                add <span class="text-13 text-red fw-medium">{name}</span> wherever you want the
                                recipient's name to appear in your email content. The
                                system will automatically replace {name} with each person's name when sending the
                                email.</small></p>
                        {{-- <textarea name="description" id="description" class="form-control" rows="3"></textarea> --}}
                        <br>
                        <textarea id="description" class="form-control" rows="3"></textarea>

                    </div>
                </div>

                <br>
                <div class="flex-align justify-content-end gap-8">
                    <button type="submit" class="btn btn-main rounded-pill py-9">Send Bulk</button>
                </div>

            </div>
        </div>
    </div>
</div>





@endsection

@push('scripts')
<script>
    $('#description').trumbowyg();
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to handle file input changes
    function handleFileInputChange(event) {
        var fileInput = event.target;
        var fileContainer = fileInput.closest('.upload-section');
        var uploadedFileName = fileContainer.querySelector('.show-uploaded-passport-name');
        var loadingScreen = document.getElementById('loading-screen');
        var csvTable = document.getElementById('csv-table');
        var tbody = csvTable.querySelector('tbody');

        var files = fileInput.files;

        if (files.length > 0) {
            var file = files[0];
            var fileName = file.name;

            // Display the uploaded file name
            uploadedFileName.textContent = fileName;
            uploadedFileName.classList.remove('d-none'); // Show the file name

            // Show the loading screen
            loadingScreen.style.display = 'block';

            // Parse CSV file using PapaParse
            Papa.parse(file, {
                complete: function(result) {
                    // Hide the loading screen after parsing
                    loadingScreen.style.display = 'none';

                    // Show the table
                    csvTable.style.display = 'table';

                    // Clear existing rows
                    tbody.innerHTML = '';

                    // Extract data from the parsed CSV
                    var data = result.data;

                    // Get column indexes for Name and Email
                    var headers = data[0];
                    var nameIndex = headers.findIndex(header => header.toLowerCase().includes('name'));
                    var emailIndex = headers.findIndex(header => header.toLowerCase().includes('email'));

                    // Filter and display rows with Name and Email
                    data.slice(1).forEach((row, index) => {
                        var name = row[nameIndex];
                        var email = row[emailIndex];

                        if (name && email) { // Only valid rows
                            var tr = document.createElement('tr');
                            tr.innerHTML = `
                            <td style="border: 1px solid #ddd; padding: 8px;">${index + 1}</td> <!-- Serial Number -->
                            <td style="border: 1px solid #ddd; padding: 8px;">${name}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">${email}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                <button type="button" class="remove-btn" style="color: red; cursor: pointer;">Remove</button>
                            </td>
                        `;
                            tbody.appendChild(tr);
                        }
                    });

                    // Attach event listeners to remove buttons
                    attachRemoveEventListeners();
                },
                header: false, // CSV doesn't have headers by default (they're handled manually)
                skipEmptyLines: true // Ignore empty lines in CSV
            });
        } else {
            // Hide file name if no file is selected
            uploadedFileName.textContent = '';
            uploadedFileName.classList.add('d-none');
        }
    }

    // Function to attach event listeners to remove buttons
    function attachRemoveEventListeners() {
        var removeButtons = document.querySelectorAll('.remove-btn');
        removeButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                var row = event.target.closest('tr'); // Get the parent row
                row.remove(); // Remove the row
            });
        });
    }

    // Function to trigger the file input when "Browse" is clicked
    function handleBrowseClick(event) {
        var label = event.target;
        var fileInput = label.closest('.upload-section').querySelector('.file-input');
        fileInput.click(); // Trigger the hidden file input
    }

    // Function to handle sending bulk emails
    function sendBulkEmails() {
        // Collect email addresses and names from the table
        var emails = [];
        var tableRows = document.querySelectorAll('#csv-table tbody tr');
        tableRows.forEach(function(row) {
            var name = row.cells[1].textContent;
            var email = row.cells[2].textContent;

            if (email) {
                emails.push({
                    name: name,
                    email: email
                });
            }
        });

        // Get subject and body from the form
        var subject = document.querySelector('input[name="subject"]').value;
        var body = document.getElementById('description').value;

        // Send the data to the backend
        var data = {
            subject: subject,
            body: body,
            emails: emails
        };

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Use fetch to send data to the backend
        fetch('/send-bulk-emails', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                Swal.fire('Success', 'Emails sent successfully', 'success');
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred while sending emails.', 'error');
            });
    }

    // Attach event listeners after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Attach event listener to "Browse" labels
        document.querySelectorAll('.file-label').forEach(label => {
            label.addEventListener('click', handleBrowseClick);
        });

        // Attach event listener to file inputs
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', handleFileInputChange);
        });

        // Attach event listener to the "Send Bulk" button
        document.querySelector('.btn-main').addEventListener('click', sendBulkEmails);
    });
</script>
{{-- <script>
    // Function to handle file input changes
    function handleFileInputChange(event) {
        var fileInput = event.target;
        var fileContainer = fileInput.closest('.upload-section');
        var uploadedFileName = fileContainer.querySelector('.show-uploaded-passport-name');
        var loadingScreen = document.getElementById('loading-screen');
        var csvTable = document.getElementById('csv-table');
        var tbody = csvTable.querySelector('tbody');
        var emailCountRow = document.getElementById('email-count-row');

        var files = fileInput.files;

        if (files.length > 0) {
            var file = files[0];
            var fileName = file.name;

            // Display the uploaded file name
            uploadedFileName.textContent = fileName;
            uploadedFileName.classList.remove('d-none'); // Show the file name

            // Show the loading screen
            loadingScreen.style.display = 'block';

            // Parse CSV file using PapaParse
            Papa.parse(file, {
                complete: function(result) {
                    // Hide the loading screen after parsing
                    loadingScreen.style.display = 'none';

                    // Show the table
                    csvTable.style.display = 'table';

                    // Clear existing rows
                    tbody.innerHTML = '';

                    // Extract data from the parsed CSV
                    var data = result.data;

                    // Get column indexes for Name and Email
                    var headers = data[0];
                    var nameIndex = headers.findIndex(header => header.toLowerCase().includes('name'));
                    var emailIndex = headers.findIndex(header => header.toLowerCase().includes('email'));

                    // Filter and display rows with Name and Email
                    data.slice(1).forEach((row, index) => {
                        var name = row[nameIndex];
                        var email = row[emailIndex];

                        if (name && email) { // Only valid rows
                            var tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td style="border: 1px solid #ddd; padding: 8px;">${index + 1}</td> <!-- Serial Number -->
                                <td style="border: 1px solid #ddd; padding: 8px;">${name}</td>
                                <td style="border: 1px solid #ddd; padding: 8px;">${email}</td>
                            `;
                            tbody.appendChild(tr);
                        }
                    });


                },
                header: false, // CSV doesn't have headers by default (they're handled manually)
                skipEmptyLines: true // Ignore empty lines in CSV
            });
        } else {
            // Hide file name if no file is selected
            uploadedFileName.textContent = '';
            uploadedFileName.classList.add('d-none');
        }
    }

    // Function to trigger the file input when "Browse" is clicked
    function handleBrowseClick(event) {
        var label = event.target;
        var fileInput = label.closest('.upload-section').querySelector('.file-input');
        fileInput.click(); // Trigger the hidden file input
    }

    // Function to handle sending bulk emails
    function sendBulkEmails() {
        // Collect email addresses and names from the table
        var emails = [];
        var tableRows = document.querySelectorAll('#csv-table tbody tr');
        tableRows.forEach(function(row) {
            var name = row.cells[1].textContent;
            var email = row.cells[2].textContent;

            if (email) {
                emails.push({
                    name: name,
                    email: email
                });
            }
        });

        // Get subject and body from the form
        var subject = document.querySelector('input[name="subject"]').value;
        // var body = document.querySelector('textarea[id="description"]').value;
        // var body = document.getElementById('description').value;
        var body = document.getElementById('description').value;

        // Send the data to the backend
        var data = {
            subject: subject,
            body: body,
            emails: emails
        };

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Use fetch to send data to the backend
        fetch('/send-bulk-emails', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                alert('Emails sent successfully');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while sending emails.');
            });
    }

    // Attach event listeners after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Attach event listener to "Browse" labels
        document.querySelectorAll('.file-label').forEach(label => {
            label.addEventListener('click', handleBrowseClick);
        });

        // Attach event listener to file inputs
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', handleFileInputChange);
        });

        // Attach event listener to the "Send Bulk" button
        document.querySelector('.btn-main').addEventListener('click', sendBulkEmails);
    });
</script> --}}



{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.btn-main').addEventListener('click', function() {
            // Get the content from TinyMCE
            var body = document.getElementById('description').value;
            console.log("Body content:", body);

            // Collect the subject value
            var subject = document.querySelector('input[name="subject"]').value;
            console.log("Subject content:", subject);

            // Collect emails and names from the table
            var emails = [];
            var tableRows = document.querySelectorAll('#csv-table tbody tr');
            tableRows.forEach(function(row) {
                var name = row.cells[1].textContent;
                var email = row.cells[2].textContent;
                if (email) {
                    emails.push({
                        name: name,
                        email: email
                    });
                }
            });

            // Show SweetAlert2 Loading
            Swal.fire({
                title: 'Sending Emails...',
                text: 'Please wait while we send the emails.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading(); // Start the loading spinner
                }
            });

            // Replace {name} in the email body for each user
            let promises = []; // To track all fetch requests
            emails.forEach(function(emailData) {
                var personalizedBody = body.replace(/{name}/g, emailData.name);
                console.log(`Sending to: ${emailData.email}`);
                console.log(`Personalized Body: ${personalizedBody}`);

                // Get CSRF token from meta tag
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute(
                    'content');

                // Prepare fetch request for sending emails
                let request = fetch('/send-bulk-emails', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            subject: subject,
                            body: personalizedBody,
                            to_email: emailData.email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                promises.push(request); // Add the request to promises array
            });

            // Wait for all emails to be sent
            Promise.all(promises)
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Emails Sent!',
                        text: 'All emails have been sent successfully.',
                        timer: 3000
                    });
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while sending emails.'
                    });
                });
        });
    });
</script> --}}
@endpush
