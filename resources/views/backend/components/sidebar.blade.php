    <!-- ============================ Sidebar Start ============================ -->

    <aside class="sidebar">
        <!-- sidebar close btn -->
        <button type="button"
            class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i
                class="ph ph-x"></i></button>
        <!-- sidebar close btn -->

        <a href="{{ route('dashboard') }}"
            class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
            <img src="{{ asset('backend/images/logo/routeone_logo.svg') }}" alt="Logo">
        </a>

        <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
            <div class="p-20 pt-10">
                <ul class="sidebar-menu">
                    <li class="sidebar-menu__item">
                        <a href="{{ route('dashboard') }}"
                            class="sidebar-menu__link {{ request()->segment(1) === 'dashboard' ? 'activePage' : '' }}">
                            <span class="icon"><i class="ph ph-squares-four"></i></span>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>

                    @auth
                        @if (Auth::user()->user_type === 'superadmin')
                            <li class="sidebar-menu__item">
                                <a href="{{ route('team.manage') }}"
                                    class="sidebar-menu__link {{ request()->segment(1) === 'team' ? 'activePage' : '' }}">
                                    <span class="icon"><i class="ph ph-users"></i></span>
                                    <span class="text">Team</span>
                                </a>
                            </li>
                        @endif
                    @endauth

                    @if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'agent')
                        <li class="sidebar-menu__item has-dropdown">
                            <a href="javascript:void(0)"
                                class="sidebar-menu__link {{ request()->segment(1) === 'user' ? 'activePage' : '' }}">
                                <span class="icon"><i class="ph ph-users"></i></span>
                                <span class="text">Users</span>
                            </a>
                            <!-- Submenu start -->
                            <ul class="sidebar-submenu">
                                <li class="sidebar-submenu__item">
                                <li class="sidebar-submenu__item">
                                    <a href="{{ route('user.manage') }}"
                                        class="sidebar-submenu__link {{ request()->is('user/manage') ? 'active-sub-menu' : '' }}">
                                        Manage Users </a>
                                </li>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="{{ route('user.create') }}"
                                class="sidebar-submenu__link {{ request()->is('user/create') ? 'active-sub-menu' : '' }}">
                                Create User </a>
                        </li>
                </ul>
                </li>
                @endif
                @if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'agent')
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.message') }}"
                            class="sidebar-menu__link {{ request()->segment(2) === 'message' ? 'activePage' : '' }}">
                            <span class="icon"><i class="ph ph-chat-dots"></i></span>
                            <span class="text">Messages</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'agent')
                    <li class="sidebar-menu__item has-dropdown">
                        <a href="javascript:void(0)"
                            class="sidebar-menu__link {{ request()->segment(1) === 'invoice' ? 'activePage' : '' }}">
                            <span class="icon"><i class="ph ph-invoice"></i></span>
                            <span class="text">Invoice</span>
                        </a>
                        <!-- Submenu start -->
                        <ul class="sidebar-submenu">
                            <li class="sidebar-submenu__item">
                            <li class="sidebar-submenu__item">
                                <a href="{{ route('admin.invoice.index') }}"
                                    class="sidebar-submenu__link {{ request()->is('invoice') ? 'active-sub-menu' : '' }}">
                                    Invoice List </a>
                            </li>
                    </li>
                    <li class="sidebar-submenu__item">
                        <a href="{{ route('admin.invoice.create') }}"
                            class="sidebar-submenu__link {{ request()->is('invoice/create') ? 'active-sub-menu' : '' }}">
                            Create Invoice </a>
                    </li>
                    </ul>
                    <!-- Submenu End -->
                    </li>
                @endif


                @auth
                    @if (Auth::user()->user_type === 'superadmin')
                        <li class="sidebar-menu__item has-dropdown">
                            <a href="javascript:void(0)"
                                class="sidebar-menu__link {{ request()->segment(2) === 'vacancies' ? 'activePage' : '' }}">
                                <span class="icon"><i class="ph ph-briefcase"></i></span>
                                <span class="text">Jobs</span>
                            </a>
                            <!-- Submenu start -->
                            <ul class="sidebar-submenu">
                                <li class="sidebar-submenu__item">
                                <li class="sidebar-submenu__item">
                                    <a href="{{ route('admin.vacancies.list') }}"
                                        class="sidebar-submenu__link {{ request()->is('admin/vacancies/list') ? 'active-sub-menu' : '' }}">
                                        Jobs List </a>
                                </li>
                        </li>
                        <li class="sidebar-submenu__item">
                            <a href="{{ route('admin.vacancies.create') }}"
                                class="sidebar-submenu__link {{ request()->is('admin/vacancies/create') ? 'active-sub-menu' : '' }}">
                                Create Jobs </a>
                        </li>
                        </ul>
                        <!-- Submenu End -->
                        </li>
                    @endif
                @endauth

                @auth
                    @if (Auth::user()->user_type === 'superadmin')
                        <li class="sidebar-menu__item has-dropdown">
                            <a href="javascript:void(0)"
                                class="sidebar-menu__link {{ request()->segment(2) === 'testimonial' ? 'activePage' : '' }}">
                                <span class="icon"><i class="ph ph-clipboard-text"></i></span>
                                <span class="text">Testimonial</span>
                            </a>
                            <!-- Submenu start -->
                            <ul class="sidebar-submenu">
                                <li class="sidebar-submenu__item">
                                <li class="sidebar-submenu__item">
                                    <a href="{{ route('admin.testimonial.list') }}"
                                        class="sidebar-submenu__link {{ request()->is('admin/testimonial/list') ? 'active-sub-menu' : '' }}">
                                        Testimonial List </a>
                                </li>
                        </li>

                        <li class="sidebar-submenu__item">
                            <a href="{{ route('admin.testimonial.create') }}"
                                class="sidebar-submenu__link {{ request()->is('admin/testimonial/create') ? 'active-sub-menu' : '' }}">
                                Create Testimonial </a>
                        </li>
                        </ul>
                        <!-- Submenu End -->
                        </li>
                    @endif
                @endauth



                <li class="sidebar-menu__item">
                    <a href="{{ route('admin.applications') }}"
                        class="sidebar-menu__link {{ request()->segment(2) === 'applications' ? 'activePage' : '' }}">
                        <span class="icon"><i class="ph ph-article"></i></span>
                        <span class="text">Applications</span>
                    </a>
                </li>

                @auth
                    @if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'teacher')
                        <li class="sidebar-menu__item">
                            <a href="{{ route('admin.certificate') }}"
                                class="sidebar-menu__link {{ request()->segment(2) === 'certificate' ? 'activePage' : '' }}">
                                <span class="icon"><i class="ph ph-certificate"></i></span>
                                <span class="text">Certificates</span>
                            </a>
                        </li>
                    @endif
                    {{-- @if (Auth::user()->user_type === 'superadmin') --}}
                    <li class="sidebar-menu__item">
                        <a href="{{ route('admin.calander') }}"
                            class="sidebar-menu__link {{ request()->segment(2) === 'calander' ? 'activePage' : '' }}">
                            <span class="icon"><i class="ph ph-calendar-dots"></i></span>
                            <span class="text">Calander</span>
                        </a>
                    </li>
                    {{-- @endif --}}
                @endauth


                @auth
                    @if (Auth::user()->user_type === 'superadmin')
                        <li class="sidebar-menu__item">
                            <a href="{{ route('admin.contact') }}"
                                class="sidebar-menu__link {{ request()->segment(2) === 'contact' ? 'activePage' : '' }}">
                                <span class="icon"><i class="ph ph-chats-teardrop"></i></span>
                                <span class="text">Contact</span>
                            </a>
                        </li>
                    @endif
                @endauth

                {{-- <li class="sidebar-menu__item">
                        <a href="students.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-users-three"></i></span>
                            <span class="text">Students</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="assignment.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-clipboard-text"></i></span>
                            <span class="text">Assignments</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="mentors.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-users"></i></span>
                            <span class="text">Mentors</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="resources.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-bookmarks"></i></span>
                            <span class="text">Resources</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="message.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-chats-teardrop"></i></span>
                            <span class="text">Messages</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="analytics.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-chart-bar"></i></span>
                            <span class="text">Analytics</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="event.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-calendar-dots"></i></span>
                            <span class="text">Events</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="library.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-books"></i></span>
                            <span class="text">Library</span>
                        </a>
                    </li>
                    <li class="sidebar-menu__item">
                        <a href="pricing-plan.html" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-coins"></i></span>
                            <span class="text">Pricing</span>
                        </a>
                    </li> --}}


                <li class="sidebar-menu__item">
                    <span
                        class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">Settings</span>
                </li>

                @auth
                    @if (Auth::user()->user_type === 'superadmin')
                        <li class="sidebar-menu__item has-dropdown">
                            <a href="javascript:void(0)"
                                class="sidebar-menu__link {{ request()->segment(2) === 'services' ? 'activePage' : '' }}">
                                <span class="icon"><i class="ph ph-sliders"></i></span>
                                <span class="text">Settings</span>
                            </a>
                            <!-- Submenu start -->
                            <ul class="sidebar-submenu">
                                <li class="sidebar-submenu__item">
                                <li class="sidebar-submenu__item">
                                    <a href="{{ route('admin.services.index') }}"
                                        class="sidebar-submenu__link {{ request()->is('admin/services') ? 'active-sub-menu' : '' }}">Services</a>
                                </li>
                        </li>
                        </ul>
                        </li>
                    @endif
                @endauth



                <li class="sidebar-menu__item {{ request()->is('auth/account') ? 'activePage' : '' }}">
                    <a href="{{ route('auth.account') }}" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-gear"></i></span>
                        <span class="text">Account Settings</span>
                    </a>
                </li>

                {{-- <li class="sidebar-menu__item has-dropdown">
                        <a href="javascript:void(0)" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-shield-check"></i></span>
                            <span class="text">Authetication</span>
                        </a>
                        <!-- Submenu start -->
                        <ul class="sidebar-submenu">
                            <li class="sidebar-submenu__item">
                                <a href="sign-in.html" class="sidebar-submenu__link">Sign In</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="sign-up.html" class="sidebar-submenu__link">Sign Up</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="forgot-password.html" class="sidebar-submenu__link">Forgot Password</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="reset-password.html" class="sidebar-submenu__link">Reset Password</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="verify-email.html" class="sidebar-submenu__link">Verify Email</a>
                            </li>
                            <li class="sidebar-submenu__item">
                                <a href="two-step-verification.html" class="sidebar-submenu__link">Two Step
                                    Verification</a>
                            </li>
                        </ul>
                        <!-- Submenu End -->
                    </li> --}}

                </ul>
            </div>

        </div>

    </aside>
    <!-- ============================ Sidebar End  ============================ -->
