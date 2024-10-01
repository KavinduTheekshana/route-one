
<div id="formContainer" class="form-container">
    <!-- Close button at the top -->
    <span id="closeFormBtn" class="close-btn">&times;</span>

    <form action="{{ route('member.store') }}" method="POST" class="form-content pt-4">
        @csrf

        <h2 class="mt-22">Enter Member Details</h2>
        <label for="name">Full Name</label>
        <input type="text" name="name" class="text-counter placeholder-13 form-control py-11" required
            value="{{ old('name') }}" placeholder="Enter Full Name">


        <label for="role">Role</label>
        <select name="role" class="form-select py-9 placeholder-13 text-15 mb-10">
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="agent" {{ old('role') == 'agent' ? 'selected' : '' }}>Agent</option>
            <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
            <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
        </select>


        <label for="email">Email</label>
        <input type="email" name="email" class="text-counter placeholder-13 form-control py-11" required
            value="{{ old('email') }}" placeholder="Enter Email Address">


        <label for="country">Country</label>
        <input type="text" name="country" class="text-counter placeholder-13 form-control py-11"
            value="{{ old('country') }}" placeholder="Enter Country">


        <label for="phone">Phone Number</label>
        <input type="number" name="phone" class="text-counter placeholder-13 form-control py-11"
            value="{{ old('phone') }}" placeholder="Enter Phone Number">


        <label for="country">Password</label>
        <input type="password" name="password" class="text-counter placeholder-13 form-control py-11"
            placeholder="Enter Password">


        <label for="country">Password</label>
        <input type="password" name="password_confirmation" class="text-counter placeholder-13 form-control py-11"
            placeholder="Enter Password Confirmation">


        <div class="flex-align justify-content-end gap-8 mt-16 ml-auto-mw-80">
            <button type="reset" class="btn btn-secondary rounded-pill py-9">Reset</button>

            <button type="submit" class="btn btn-main rounded-pill py-9">Continue</button>





        </div>
    </form>
</div>
