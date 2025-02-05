<div class="card">
    <div class="card-header border-bottom border-gray-100 flex-align gap-8">
        <h5 class="mb-0">User Details</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('user.submit.details') }}" method="POST" class="form-content pt-4">
            @csrf
            <div class="row gy-20">

                <div class="col-xxl-12 col-md-12 col-sm-12">
                    <div class="row g-20">
                        <div class="col-sm-6">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Full Name <span class="text-13 text-red fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="text" name="name" required class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Full Name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Email <span
                                    class="text-13 text-red fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="email" name="email" required class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Email Address">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Country</label>
                            <div class="position-relative">
                                <input type="text" name="country" class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Country">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Phone Number</label>
                            <div class="position-relative">
                                <input type="number" name="phone" class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Phone Number">
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Password <span
                                class="text-13 text-red fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="text" name="password" required class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Password">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="courseTitle" class="h5 mb-8 fw-semibold font-heading">Password Confirmation <span
                                class="text-13 text-red fw-medium">(Required)</span> </label>
                            <div class="position-relative">
                                <input type="text" name="password_confirmation" required class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Password Confirmation">
                            </div>
                        </div>



                    </div>
                </div>
                <div class="flex-align justify-content-end gap-8">
                    <button type="button" class="btn btn-outline-main rounded-pill py-9" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-main rounded-pill py-9">Continue</button>
                </div>
            </div>
        </form>
    </div>
</div>