@if (Auth::user()->user_type === 'superadmin' or Auth::user()->user_type === 'agent')
 <!-- Password Tab Start -->
  <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab" tabindex="0">
    <div class="card mt-24">
        <div class="card-header border-bottom">
            <h4 class="mb-4">Password Settings</h4>
            <p class="text-gray-600 text-15">Please fill full details about your user</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('user.password.update', $user->id) }}" method="POST">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-12">
                                <label for="new-password" class="form-label mb-8 h6">New Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control py-11" id="new-password" name="new_password" placeholder="Enter New Password">
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"></span>
                                </div>
                                @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="confirm-password" class="form-label mb-8 h6">Confirm Password</label>
                                <div class="position-relative">
                                    <input type="password" class="form-control py-11" id="confirm-password" name="new_password_confirmation" placeholder="Enter Confirm Password">
                                    <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"></span>
                                </div>
                                @error('new_password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label mb-8 h6">Password Requirements:</label>
                                <ul class="list-inside">
                                    <li class="text-gray-600 mb-4">At least one lowercase character</li>
                                    <li class="text-gray-600 mb-4">Minimum 8 characters long - the more, the better</li>
                                    <li class="text-gray-600 mb-4">At least one number, symbol, or whitespace character</li>
                                </ul>
                            </div>

                            <div class="col-12">
                                <div class="flex-align justify-content-end gap-8">
                                    <button type="reset" class="btn btn-outline-main bg-main-100 border-main-100 text-main-600 rounded-pill py-9">Cancel</button>
                                    <button type="submit" class="btn btn-main rounded-pill py-9">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Password Tab End -->
@endif