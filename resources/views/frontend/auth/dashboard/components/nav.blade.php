<nav class="nav nav-borders">
    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }} ms-0"
        href="{{ route('dashboard') }}">Profile</a>
    <a class="nav-link {{ request()->is('user/application') ? 'active' : '' }}"
        href="{{ route('user.application') }}">Application Form</a>
    <a class="nav-link {{ request()->is('user/documents') ? 'active' : '' }}"
        href="{{ route('user.documents') }}" >Documents</a>
    <form method="POST" action="{{ route('logout') }}"
        class="py-12 text-15 px-20 hover-bg-danger-50 text-gray-300 hover-text-danger-600 rounded-8 flex-align gap-8 fw-medium text-15">
        @csrf
        <button type="submit" class="text-button text-danger nav-link">Logout</a>
    </form>
</nav>
<hr class="mt-0 mb-4">
