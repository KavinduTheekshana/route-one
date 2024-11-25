@push('styles')
    <style>
        .h-96 {
            height: 50vh !important;
        }
    </style>
@endpush
<!-- Notes Tab Content -->
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade" id="pills-message" role="tabpanel" aria-labelledby="pills-message-tab" tabindex="0">
        <div class="card mt-24">
            <div class="card h-96">
                <div class="card-header py-16 border-bottom border-gray-100">
                    <div class="chat-list__item flex-between gap-8 cursor-pointer">
                        <div class="d-flex align-items-start gap-16">
                            <div class="position-relative flex-shrink-0">
                                <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                                    alt="" id="selected-user-image"
                                    class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
                                <span
                                    class="activation-badge activation-badge-dot w-12 h-12 border-2 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                            </div>
                            <div class="d-flex flex-column">
                                <h6 class="text-line-1 text-15 text-gray-400 fw-bold mb-0" id="selected-user-name">
                                    {{ $user->name }}
                                </h6>
                                <span class="text-line-1 text-13 text-gray-200"
                                    id="selected-user-country">{{ $user->country }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="chat-box-item-wrapper overflow-y-auto scroll-sm p-24" id="chatBox">
                    </div>
                </div>
                <div class="card-footer border-top border-gray-100">
                    <div class="flex-align gap-8 chat-box-bottom">

                        <label for="fileUp"
                            class="flex-shrink-0 file-btn w-48 h-48 flex-center bg-main-50 text-24 text-main-600 rounded-circle hover-bg-main-100 transition-2">
                            <i class="ph ph-plus"></i>
                        </label>
                        <input type="file" name="fileName" id="fileUp" hidden>


                        <form id="messageForm" class="flex-align gap-8 chat-box-bottom w-100">
                            @csrf
                            <input type="hidden" id="selectedUserId" name="receiver_id" value="">
                            <!-- Hidden field for receiver user ID -->

                            <input type="text" id="messageInput" name="message"
                                class="form-control h-48 border-transparent px-20 focus-border-main-600 bg-main-50 rounded-pill placeholder-15"
                                placeholder="Type your message...">

                            <button type="submit" id="sendMessageButton"
                                class="flex-shrink-0 submit-btn btn btn-main rounded-pill flex-align gap-4 py-15">
                                Send Message <span class="d-flex text-md d-sm-flex d-none"><i
                                        class="ph-fill ph-paper-plane-tilt"></i></span>
                            </button>

                        </form>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#messageForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Gather form data
                var message = $('#messageInput').val();
                var receiver_id = $('#selectedUserId').val();
                var _token = $('input[name="_token"]').val(); // Get CSRF token

                // Send AJAX request to Laravel
                $.ajax({
                    url: "{{ route('messages.store') }}", // Your route for saving the message
                    type: "POST",
                    data: {
                        message: message,
                        receiver_id: receiver_id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response.success) {
                            // alert('Message sent successfully!');
                            fetchMessages(receiver_id);
                            $('#messageInput').val(
                                ''); // Clear input after successful submission
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
                    // Render the messages (pass the array directly)
                    renderMessages(data, userId);
                })
                .catch(error => console.error('Error fetching messages:', error));
        }

        function renderMessages(messages, userId) {
            console.log(messages);
            // Logic to render messages in your chat box
            const chatBox = document.querySelector('.chat-box-item-wrapper'); // Adjust the selector as needed
            chatBox.innerHTML = ''; // Clear previous messages

            messages.forEach(msg => {
                const senderProfileImage = msg.sender.profile_image ?
                    `/storage/${msg.sender.profile_image}` :
                    '/backend/images/thumbs/setting-profile-img.webp';

                const receiverProfileImage = msg.receiver.profile_image ?
                    `/storage/${msg.receiver.profile_image}` :
                    '/backend/images/thumbs/setting-profile-img.webp';

                const messageItem = `
            <div class="${msg.receiver_id === userId ? 'chat-box-item' : 'chat-box-item right'} d-flex align-items-end gap-8 mb-15">
                <div class="pb-20">
                <img src="${msg.receiver_id === userId ? senderProfileImage : receiverProfileImage}" alt="Profile Image" class="w-40 h-40 rounded-circle object-fit-cover flex-shrink-0">
               </div>
                <div class="chat-box-item__content">
                    <p class="chat-box-item__text py-16 px-16 px-lg-4">${msg.message}</p>
                    <span class="text-gray-200 text-13 mt-2 d-block">${new Date(msg.created_at).toLocaleString()}</span>
                </div>
            </div>
        `;
                chatBox.insertAdjacentHTML('beforeend', messageItem);
            });
        }
    </script>
@endpush