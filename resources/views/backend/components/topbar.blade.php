<div class="top-navbar flex-between gap-16">

    <div class="flex-align gap-16">
        <!-- Toggle Button Start -->
        <button type="button" class="toggle-btn d-xl-none d-flex text-26 text-gray-500"><i
                class="ph ph-list"></i></button>
        <!-- Toggle Button End -->

    </div>

    <div class="flex-align gap-16">
        <div class="flex-align gap-8">
            <!-- Notification Start -->
            <div class="dropdown">
                <button
                    class="dropdown-btn shaking-animation text-gray-500 w-40 h-40 bg-main-50 hover-bg-main-100 transition-2 rounded-circle text-xl flex-center"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="position-relative">
                        <i class="ph ph-bell"></i>
                        <span class="alarm-notify position-absolute end-0"></span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                    <div class="card border border-gray-100 rounded-12 box-shadow-custom p-0 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="py-8 px-24 bg-main-600">
                                <div class="flex-between">
                                    <h5 class="text-xl fw-semibold text-white mb-0">Messagers</h5>
                                    <div class="flex-align gap-12">
                                        <button type="button"
                                            class="bg-white rounded-6 text-sm px-8 py-2 hover-text-primary-600">
                                            Unread ({{ $headerMessages->count() }}) </button>
                                        <button type="button"
                                            class="close-dropdown hover-scale-1 text-xl text-white"><i
                                                class="ph ph-x"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-24 max-h-270 overflow-y-auto scroll-sm">
                                @if (isset($headerMessages) && $headerMessages->count() > 0)
                                    @foreach ($headerMessages as $message)
                                        <div class="d-flex align-items-start gap-12">

                                                <img src="{{ $message->sender->profile_image ? asset('storage/' . $message->sender->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                                                class="w-48 h-48 rounded-circle object-fit-cover flex-shrink-0"
                                                alt="Sender Profile">


                                            <div class="border-gray-100 pb-24">
                                                <div class="flex-align gap-4">
                                                    <a onclick="markAsRead(event, {{ $message->sender_id }})" href="{{ route('user.settings', $message->sender_id) }}"
                                                        class="fw-medium text-15 mb-0 text-gray-300 hover-text-main-600 text-line-2">{{ $message->sender->name }}</a>

                                                </div>
                                                <div class="flex-align gap-6 mt-8">

                                                    <div class="flex-align gap-4">
                                                        <p class="text-gray-900 text-sm text-line-1">{{ Str::limit(strip_tags($message->message), 150, '...') }}
                                                        </p>

                                                    </div>
                                                </div>

                                                <span class="text-gray-200 text-13 mt-8">{{ $message->created_at->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No new messages</p>
                                @endif
                                {{-- <div class="d-flex align-items-start gap-12">
                                    <img src="assets/images/thumbs/notification-img2.png" alt=""
                                        class="w-48 h-48 rounded-circle object-fit-cover">
                                    <div class="">
                                        <a href="#"
                                            class="fw-medium text-15 mb-0 text-gray-300 hover-text-main-600 text-line-2">Patrick
                                            added a comment on Design Assets - Smart Tags file:</a>
                                        <span class="text-gray-200 text-13">2 mins ago</span>
                                    </div>
                                </div> --}}
                            </div>
                            <a href="{{ route('admin.message') }}"
                                class="py-13 px-24 fw-bold text-center d-block text-primary-600 border-top border-gray-100 hover-text-decoration-underline">
                                View All </a>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Notification Start -->


        </div>


        <!-- User Profile Start -->
        <div class="dropdown">
            <button
                class="users arrow-down-icon border border-gray-200 rounded-pill p-4 d-inline-block pe-40 position-relative"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="position-relative">
                    <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                        alt="Image" class="h-32 w-32 rounded-circle">
                    <span
                        class="activation-badge w-8 h-8 position-absolute inset-block-end-0 inset-inline-end-0"></span>
                </span>
            </button>
            <div class="dropdown-menu dropdown-menu--lg border-0 bg-transparent p-0">
                <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                    <div class="card-body">
                        <div class="flex-align gap-8 mb-20 pb-20 border-bottom border-gray-100">
                            <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('backend/images/thumbs/setting-profile-img.webp') }}"
                                alt="" class="w-54 h-54 rounded-circle">
                            <div class="">
                                <h4 class="mb-0">{{ auth()->user()->name }}</h4>
                                <p class="fw-medium text-13 text-gray-200">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <ul class="max-h-270 overflow-y-auto scroll-sm pe-4">
                            <li class="mb-4">
                                <a href="{{ route('auth.account') }}"
                                    class="py-12 text-15 px-20 hover-bg-gray-50 text-gray-300 rounded-8 flex-align gap-8 fw-medium text-15">
                                    <span class="text-2xl text-primary-600 d-flex"><i class="ph ph-gear"></i></span>
                                    <span class="text">Account Settings</span>
                                </a>
                            </li>
                            {{-- <li class="mb-4">
                                <a href="pricing-plan.html"
                                    class="py-12 text-15 px-20 hover-bg-gray-50 text-gray-300 rounded-8 flex-align gap-8 fw-medium text-15">
                                    <span class="text-2xl text-primary-600 d-flex"><i
                                            class="ph ph-chart-bar"></i></span>
                                    <span class="text">Upgrade Plan</span>
                                </a>
                            </li>
                            <li class="mb-4">
                                <a href="analytics.html"
                                    class="py-12 text-15 px-20 hover-bg-gray-50 text-gray-300 rounded-8 flex-align gap-8 fw-medium text-15">
                                    <span class="text-2xl text-primary-600 d-flex"><i
                                            class="ph ph-chart-line-up"></i></span>
                                    <span class="text">Daily Activity</span>
                                </a>
                            </li>

                            <li class="mb-4">
                                <a href="email.html"
                                    class="py-12 text-15 px-20 hover-bg-gray-50 text-gray-300 rounded-8 flex-align gap-8 fw-medium text-15">
                                    <span class="text-2xl text-primary-600 d-flex"><i
                                            class="ph ph-envelope-simple"></i></span>
                                    <span class="text">Email</span>
                                </a>
                            </li> --}}
                            <li class="pt-8 border-top border-gray-100">
                                {{-- <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <input type="submit" value="LOG OUT">
                                </form> --}}
                                <form method="POST" action="{{ route('logout') }}"
                                    class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
                                    @csrf
                                    <span class="text-2xl text-danger-600 d-flex"><i
                                            class="ph ph-sign-out"></i></span>
                                    <button type="submit" class="text">Log Out</button>
                                    {{-- <span class="text">Log Out</span> --}}
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- User Profile Start -->

    </div>
</div>


@push('scripts')
<script>
    function markAsRead(event, senderId) {
        event.preventDefault();

        fetch(`/messages/${senderId}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                // Redirect to user settings after marking messages as read
                window.location.href = "{{ route('user.settings', ':id') }}".replace(':id', senderId);
            }
        }).catch(error => console.error('Error:', error));
    }
</script>


@endpush
