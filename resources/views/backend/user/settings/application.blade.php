  <!-- Password Tab Start -->
  <div class="tab-pane fade {{ session('showApplicationTab') ? 'show active' : '' }}" id="pills-application"
      role="tabpanel" aria-labelledby="pills-application-tab" tabindex="0">
      <div class="card mt-24">
          <div class="card-header border-bottom">
              <h4 class="mb-4">Application Form</h4>
              <p class="text-gray-600 text-15">Please review all the candidate's details and ensure they are fully
                  prepared for the interview.</p>
          </div>
          <div class="card-body">
              <div class="row">
                  <form method="POST" action="{{ route('user.application.update') }}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ $user->id }}">
                      @if (isset($application) && $application->status==1)
                          <div class="alert alert-info" role="alert">
                              This application was approved.
                          </div>
                      @endif

                      <div class="mb-3">
                          <label class="small mb-1" for="inputUsername">Full Name</label>
                          <input class="form-control" name="name" type="text" placeholder="Enter your full name"
                              value="{{ $application->name ?? '' }}" required
                              {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                      </div>

                      <div class="row gx-3 mb-3">
                          <div class="col-md-6">
                              <label class="small mb-1" for="inputCountry">Country</label>
                              <input class="form-control" name="country" type="text" placeholder="Enter your country"
                                  value="{{ $application->country ?? '' }}"
                                  {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                          </div>

                          <div class="col-md-6">
                              <label class="small mb-1" for="inputPhone">Phone Number</label>
                              <input class="form-control" name="phone" type="text"
                                  placeholder="Enter your phone number" value="{{ $application->phone ?? '' }}"
                                  {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                          </div>
                      </div>

                      <div class="mb-3">
                          <label class="small mb-1" for="inputEmailAddress">Email address</label>
                          <input class="form-control" name="email" type="email"
                              placeholder="Enter your email address" value="{{ $application->email ?? '' }}" required
                              {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                      </div>

                      <div class="mb-3">
                          <label class="small mb-1">Address</label>
                          <input class="form-control" name="address" type="text" placeholder="Enter your address"
                              value="{{ $application->address ?? '' }}"
                              {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                      </div>

                      <div class="row gx-3 mb-3">
                          <div class="col-md-6">
                              <label class="small mb-1">Date of Birth</label>
                              <input class="form-control" name="dob" type="date"
                                  value="{{ $application->dob ?? '' }}"
                                  {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                          </div>

                          <div class="col-md-6">
                              <label class="small mb-1">Passport Number</label>
                              <input class="form-control" name="passport" type="text"
                                  placeholder="Enter your passport number" value="{{ $application->passport ?? '' }}"
                                  {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                          </div>
                      </div>

                      <div class="mb-3">
                          <label class="small mb-1">Agent</label>
                          <select name="agent_id" class="form-control"
                              {{ isset($application) && $application->status==1 ? 'disabled' : '' }}>
                              <option value="">-- Select Agent --</option>
                              @foreach ($agents as $agent)
                                  <option value="{{ $agent->id }}"
                                      {{ isset($application) && $application->agent_id == $agent->id ? 'selected' : '' }}>
                                      {{ $agent->name }}
                                  </option>
                              @endforeach
                          </select>
                      </div>

                      <br>
                      <button class="btn btn-primary" type="submit"
                          {{ isset($application) && $application->statu==1 ? 'disabled' : '' }}>
                          Update Application
                      </button>

                      @if ($application)
                          @if ($application->status == 1)
                              <!-- Reject button for approved applications -->
                              <a href="{{ route('application.reject', $application->id) }}" class="btn btn-danger">
                                  Reject Application
                              </a>

                              <a href="{{ route('certificate.issue', $application->id) }}" class="btn btn-warning">
                                  Issue English Certificate
                              </a>
                          @else
                              <!-- Application is not approved -->
                              <a href="{{ route('application.approve', $application->id) }}" class="btn btn-success">
                                  Approve Application
                              </a>
                          @endif
                      @else
                          <p>No application available.</p>
                      @endif


                  </form>
                  {{-- <form method="POST" action="{{ route('user.application.update') }}" enctype="multipart/form-data">
                      @csrf

                      <input type="hidden" name="user_id" value="{{$user->id}}">

                      @if (isset($application) && $application->status)
                          <div class="alert alert-info" role="alert">
                              This application was approved
                          </div>
                      @endif

                      <div class="mb-3">
                          <label class="small mb-1" for="inputUsername">Full Name</label>
                          <input class="form-control" name="name" type="text" placeholder="Enter your full name"
                              value="{{ $application->name ?? '' }}" required>
                      </div>

                      <div class="row gx-3 mb-3">
                          <div class="col-md-6">
                              <label class="small mb-1" for="inputCountry">Country</label>
                              <input class="form-control" name="country" type="text" placeholder="Enter your country"
                                  value="{{ $application->country ?? '' }}">
                          </div>

                          <div class="col-md-6">
                              <label class="small mb-1" for="inputPhone">Phone Number</label>
                              <input class="form-control" name="phone" type="text"
                                  placeholder="Enter your phone number" value="{{ $application->phone ?? '' }}">
                          </div>
                      </div>

                      <div class="mb-3">
                          <label class="small mb-1" for="inputEmailAddress">Email address</label>
                          <input class="form-control" name="email" type="email"
                              placeholder="Enter your email address" value="{{ $application->email ?? '' }}" required>
                      </div>

                      <div class="mb-3">
                          <label class="small mb-1">Address</label>
                          <input class="form-control" name="address" type="text" placeholder="Enter your address"
                              value="{{ $application->address ?? '' }}">
                      </div>

                      <div class="row gx-3 mb-3">
                          <div class="col-md-6">
                              <label class="small mb-1">Date of Birth</label>
                              <input class="form-control" name="dob" type="date"
                                  value="{{ $application->dob ?? '' }}">
                          </div>

                          <div class="col-md-6">
                              <label class="small mb-1">Passport Number</label>
                              <input class="form-control" name="passport" type="text"
                                  placeholder="Enter your passport number" value="{{ $application->passport ?? '' }}">
                          </div>
                      </div>

                      <div class="mb-3">
                          <label class="small mb-1">Agent</label>
                          <select name="agent" class="form-control">
                              <option value="">-- Select Agent --</option>
                              @foreach ($agents as $agent)
                                <option value="{{ $agent->id }}"
                                    {{ isset($application) && $application->agent == $agent->id ? 'selected' : '' }}>
                                    {{ $agent->name }}
                                </option>
                            @endforeach
                          </select>
                      </div>
                      <br>
                      <button class="btn btn-primary" type="submit">
                          Update Application
                      </button>
                  </form> --}}

              </div>
          </div>
      </div>
  </div>
  <!-- Password Tab End -->
