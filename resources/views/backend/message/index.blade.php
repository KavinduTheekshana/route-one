@push('styles')
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Messages')
    @include('backend.components.breadcrumb')
</div>


@include('backend.components.alert')


<div class="chart-wrapper d-flex flex-wrap gap-24">
    <!-- chat sidebar Start -->
    <div class="card chat-list">
        <div class="card-header py-16 border-bottom border-gray-100">
            <form action="#" class="position-relative">
                <button type="submit" class="input-icon text-xl d-flex text-gray-600 pointer-event-none"><i
                        class="ph ph-magnifying-glass"></i></button>
                <input type="text" id="searchInput"
                    class="form-control ps-44 h-44 border-gray-100 focus-border-main-600 rounded-pill placeholder-15"
                    placeholder="Search here...">
            </form>
        </div>
        <div class="card-body p-0">
            <div class="chat-list-wrapper p-24 overflow-y-auto scroll-sm">

                <div id="chatList">
                    <!-- This will be dynamically populated by JavaScript after filtering -->
                </div>

            </div>
        </div>
    </div>
    <!-- chat sidebar End -->

    <!-- chat sidebar Start -->



    <div class="card chat-box">
        <div class="card-header py-16 border-bottom border-gray-100">
            <div class="chat-list__item flex-between gap-8 cursor-pointer">
                <div class="d-flex align-items-start gap-16">
                    <div class="position-relative flex-shrink-0">
                        <img src="{{ asset('backend/images/thumbs/setting-profile-img.webp') }}" alt=""
                            id="selected-user-image" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                        <span
                            class="activation-badge activation-badge-dot w-12 h-12 border-2 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                    </div>
                    <div class="d-flex flex-column">
                        <h6 class="text-line-1 text-15 text-gray-400 fw-bold mb-0" id="selected-user-name">User Name
                        </h6>
                        <span class="text-line-1 text-13 text-gray-200" id="selected-user-country">Country</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="chat-box-item-wrapper overflow-y-auto scroll-sm p-24" id="chatBox"
                style="flex-direction: column-reverse;scroll-behavior: smooth;">
            </div>
        </div>
        <div class="card-footer border-top border-gray-100">
            <div class="flex-align gap-8 chat-box-bottom">

                {{-- <label for="fileUp"
                    class="flex-shrink-0 file-btn w-48 h-48 flex-center bg-main-50 text-24 text-main-600 rounded-circle hover-bg-main-100 transition-2">
                    <i class="ph ph-plus"></i>
                </label>
                <input type="file" name="fileName" id="fileUp" hidden> --}}


                <form id="messageForm" class="chat-box-bottom w-100">
                    @csrf
                    <input type="hidden" id="selectedUserId" name="receiver_id" value="">

                    <textarea name="message" id="messageInput" class="form-control w-100" style="width: 100%" rows="10"></textarea>
                    <br>

                    <div class="row">

                        <div class="d-flex gap-3">

                            <!-- Hidden file input -->
                            <input type="file" id="fileInput" name="attachments[]" multiple
                                class="form-control d-none">

                            <!-- Custom Attachments Button -->
                            <button type="button" id="attachmentBtn"
                                class="flex-shrink-0 submit-btn btn btn-dark rounded-pill flex-align gap-4 py-15">
                                Attachments <span class="d-flex text-md d-sm-flex d-none"><i
                                        class="ph ph-paperclip"></i></span>
                            </button>

                            <!-- Selected Files Preview -->


                            <button type="submit" id="sendMessageButton"
                                class="flex-shrink-0 submit-btn btn btn-main rounded-pill flex-align gap-4 py-15">
                                Send Message <span class="d-flex text-md d-sm-flex d-none"><i
                                        class="ph-fill ph-paper-plane-tilt"></i></span>
                            </button>

                            {{-- <button class="flex-shrink-0 submit-btn btn btn-dark rounded-pill flex-align gap-4 py-15">
                                Attachments <span class="d-flex text-md d-sm-flex d-none"><i
                                        class="ph ph-paperclip"></i></span>
                            </button>

                            <input type="file" id="fileInput" name="attachments[]" multiple class="form-control"> --}}




                        </div>
                    </div>
                    <br>
                    <div id="selectedFiles" class="mt-2"></div>

                    {{-- <div class="upload-card-item p-16 rounded-12 bg-main-50 mb-20 mt-4">
                        <div class="flex-align gap-10 flex-wrap">
                            <span class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                                <i class="ph ph-paperclip"></i>
                            </span>
                            <div class="upload-section">
                                <p class="text-15 text-gray-500">
                                   Document Name neds to come here
                                </p>
                            </div>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>



    <!-- chat sidebar End -->
</div>






@endsection

@push('scripts')
{{-- <script src="https://cdn.tiny.cloud/1/mc59edcciy0vssoo3ojx1vwpo2jbsemez61eo60xxi6p5wse/tinymce/7/tinymce.min.js"
referrerpolicy="origin"></script> --}}

{{-- <script>
tinymce.init({
    selector: 'textarea#messageInput', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code table lists',
    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | table'
});
</script> --}}

<script>
    document.getElementById('attachmentBtn').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', function(event) {
        const fileList = event.target.files;
        const container = document.getElementById('selectedFiles');

        container.innerHTML = ''; // Clear previous selections

        for (let i = 0; i < fileList.length; i++) {
            const fileName = fileList[i].name;

            // Create a new file display card
            const fileDiv = document.createElement('div');
            fileDiv.className = 'upload-card-item p-16 rounded-12 bg-main-50 mb-20 mt-4';
            fileDiv.innerHTML = `
                <div class="flex-align gap-10 flex-wrap">
                    <span class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                        <i class="ph ph-paperclip"></i>
                    </span>
                    <div class="upload-section">
                        <p class="text-15 text-gray-500">${fileName}</p>
                    </div>
                </div>
            `;

            // Append to container
            container.appendChild(fileDiv);
        }
    });
</script>



<script>
    $('#messageInput').trumbowyg();
</script>

<script>
    $(document).ready(function() {
        $('#messageForm').on('submit', function(e) {
            e.preventDefault(); // Prevent normal submission

            let formData = new FormData(this); // Create FormData object
            formData.append('_token', $('input[name="_token"]').val());

            $.ajax({
                url: "{{ route('messages.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        fetchMessages($('#selectedUserId').val());
                        $('#messageInput').trumbowyg('empty');
                        $('#fileInput').val(''); // Clear file input
                        $('#selectedFiles').empty();
                    }
                },
                error: function(xhr) {
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>





<script>
    // Function to render user list
    let selectedUserId = null;

    function renderUserList(users) {
        var chatList = document.getElementById('chatList');
        chatList.innerHTML = ''; // Clear the list

        if (users.length > 0) {
            users.forEach(function(user) {
                // Build profile image path or use default
                var profileImage = user.profile_image ? `/storage/${user.profile_image}` :
                    '/backend/images/thumbs/setting-profile-img.webp';

                var userItem = `
                <div class="chat-list__item flex-between gap-8 cursor-pointer" data-user-id="${user.id}" onclick="handleUserClick(this)">
                    <div class="d-flex align-items-start gap-16">
                        <div class="position-relative flex-shrink-0">
                            <img src="${profileImage}" alt="Profile Image" class="selected-user-image w-44 h-44 rounded-circle object-fit-cover flex-shrink-0">
                            <span class="activation-badge activation-badge-dot w-12 h-12 border-2 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                        </div>
                        <div class="d-flex flex-column w-100">
                            <h6 class="user-name text-line-1 text-15 text-gray-400 fw-bold mb-0">${user.name}</h6>
                            <span class="text-line-1 text-13 text-gray-200">${user.email}</span>
                            <span class="user-country text-line-1 text-13 text-gray-200">${user.country ? user.country : 'N/A'}</span>
                        </div>
                    </div>
                </div>
                `;
                chatList.insertAdjacentHTML('beforeend', userItem);
            });

            // Scroll to the bottom of the chat box to show the latest message
            chatBox.scrollTop = chatBox.scrollHeight;
        } else {
            chatList.innerHTML = '<p>No users found</p>';
        }
    }

    // Fetch all users when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        fetch('/search-users') // No query, this fetches all users
            .then(response => response.json())
            .then(data => {
                renderUserList(data.users);
            });
    });

    // Handle search input and fetch filtered users
    document.getElementById('searchInput').addEventListener('input', function() {
        var searchValue = this.value;

        // Fetch filtered users based on search query
        fetch(`/search-users?query=${searchValue}`)
            .then(response => response.json())
            .then(data => {
                renderUserList(data.users);
            });
    });

    function handleUserClick(element) {
        const userId = element.getAttribute('data-user-id'); // Get the user ID from the data attribute
        // console.log('User ID:', userId);
        selectedUserId = userId; // Set the selected user ID
        // console.log('Selected user ID:', selectedUserId);
        document.getElementById('selectedUserId').value = selectedUserId;

        // You can now fetch messages or perform any other action with the userId
        fetchMessages(userId);
        // Get the user's name and country from the clicked element
        const userName = element.querySelector('.user-name').textContent;
        const userCountry = element.querySelector('.user-country').textContent;
        const profileImage = element.querySelector('.selected-user-image').getAttribute('src') ||
            '/backend/images/thumbs/setting-profile-img.webp';

        // console.log('User Country:', userCountry);
        // console.log('User Name:', userName);
        // console.log('Profile Image:', profileImage);

        // Update the displayed user name and country using their IDs
        document.getElementById('selected-user-name').textContent = userName;
        document.getElementById('selected-user-country').textContent = userCountry;
        document.getElementById('selected-user-image').setAttribute('src', profileImage);
        // Clear the message input field
        document.getElementById('messageInput').value = '';
    }


    function fetchMessages(userId) {
        console.log('Fetching messages for user:', userId);

        fetch(`/messages/${userId}`)
            .then(response => response.json())
            .then(data => {
                // Log the fetched messages directly
                console.log('Fetched messages:', data);
                console.log('USERID:', userId);

                // Render the messages (pass the array directly)
                renderMessages(data, userId);
            })
            .catch(error => console.error('Error fetching messages:', error));
    }



    function renderMessages(messages, userId) {
        // console.log('Rendering messages:', userId);
        // console.log(messages);
        // Logic to render messages in your chat box
        const chatBox = document.querySelector('.chat-box-item-wrapper'); // Adjust the selector as needed
        chatBox.innerHTML = ''; // Clear previous messages

        messages.forEach(msg => {
            const senderProfileImage = msg.sender.profile_image ?
                `/storage/${msg.sender.profile_image}` :
                '/backend/images/thumbs/setting-profile-img.webp';
            const senderName = msg.sender.name;

            const receiverProfileImage = msg.receiver.profile_image ?
                `/storage/${msg.receiver.profile_image}` :
                '/backend/images/thumbs/setting-profile-img.webp';
            const receiverName = msg.receiver.name;

            // console.log('reciver messages:', msg.receiver_id);

            const messageItem = document.createElement('div');
            messageItem.className =
                `${msg.receiver_id != userId ? 'chat-box-item' : 'chat-box-item right'} d-flex align-items-end gap-8 mb-15`;

            // Initialize attachments container
            let attachmentsHTML = '';

            if (msg.attachments) {
                let attachments = typeof msg.attachments === 'string' ? JSON.parse(msg.attachments) : msg
                    .attachments;
                let imageCount = 0;

                attachments.forEach((attachment, index) => {
                    let filePath = attachment.path;
                    let originalFileName = attachment.original_name; // Get the original file name
                    let fileExtension = filePath.split('.').pop().toLowerCase();
                    let fileUrl = `/storage/${filePath}`;

                    // Check if the file is an image
                    if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(fileExtension)) {
                        if (imageCount % 2 === 0) {
                            // Start a new row for every two images
                            attachmentsHTML += `<div class="d-flex flex-wrap gap-2">`;
                        }

                        // Add the image with the file name displayed below the image
                        attachmentsHTML += `
                <div class="d-inline-block p-2" style="width: 150px; height: 150px; object-fit: cover; border-radius: 15px;">
                    <a href="${fileUrl}" target="_blank">
                        <img src="${fileUrl}" class="chat-attachment-img w-100 h-100 mt-2 rounded" style="
                            width: 150px !important;
                            height: 150px !important;
                            overflow: hidden;
                            padding: 2px !important;
                            object-fit: cover;
                            border-radius: 20px !important;">
                    </a>

                </div>`;

                        // Increment the counter after adding each image
                        imageCount++;

                        // Close the row after every 2 images
                        if (imageCount % 2 === 0) {
                            attachmentsHTML += `</div>`;
                        }
                    } else if (['mp4', 'webm', 'ogg'].includes(fileExtension)) {
                        attachmentsHTML += `<video controls class="chat-attachment-video w-100 mt-2 rounded" style="max-width: 200px;">
                        <source src="${fileUrl}" type="video/${fileExtension}">
                        Your browser does not support the video tag.
                    </video>`;
                    } else {
                        // If it's not an image or video, display it as a downloadable file with the name
                        // attachmentsHTML += `<a href="${fileUrl}" class="chat-attachment-link d-block mt-2 text-primary" target="_blank">
                        //             <i class="fas fa-file-alt"></i> ${originalFileName}
                        //         </a>`;

                        attachmentsHTML += `<div class="upload-card-item p-16 rounded-12 bg-main-50 mt-4">
                                <div class="flex-align gap-10 flex-wrap">
                                    <span class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                                        <i class="ph ph-paperclip"></i>
                                    </span>
                                    <div class="upload-section">
                                        <p class="text-15 text-gray-500">
                                           ${originalFileName}<br>
                                        <a href="${fileUrl}" target="_blank"><label class="text-main-600 cursor-pointer file-label">Download</label></a>

                                        </p>


                                    </div>
                                </div>
                            </div>`;
                    }
                });

                // Ensure that the last div is closed if there was an odd number of images
                if (imageCount % 2 !== 0) {
                    attachmentsHTML += `</div>`;
                }
            }



            messageItem.innerHTML = `
            <div class="pb-20">
                <img src="${msg.receiver_id === userId ? receiverProfileImage : senderProfileImage}" alt="Profile Image" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
            </div>
            <div class="chat-box-item__content">
         <div class="chat-box-item__text py-16 px-16 px-lg-4 text-left"> <b> ${msg.receiver_id === userId? receiverName : senderName}</b> <br>
                    ${msg.message}</div>

                     ${attachmentsHTML}
                <span class="text-gray-200 text-13 mt-2 d-block">${new Date(msg.created_at).toLocaleString()}</span>
                <hr>
            </div>
        `;

            chatBox.appendChild(messageItem);
        });
        // Ensure scrolling happens after DOM update
        requestAnimationFrame(() => {
            chatBox.scrollTop = chatBox.scrollHeight;
        });
    }
</script>
@endpush
