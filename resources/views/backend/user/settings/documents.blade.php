  <!-- Password Tab Start -->
  <div class="tab-pane fade show active" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab"
      tabindex="0">
      <div class="card mt-24">
          <div class="card-header border-bottom">
              <h4 class="mb-4">Documents</h4>
              <p class="text-gray-600 text-15">Please fill full documents about your user</p>
          </div>
          <div class="card-body">

              <div class="row gy-4">
                  <div class="col-sm-6 col-xs-6">





                      <div class="col-12 mt-16">
                          <label for="documentType" class="h5 mb-8 fw-semibold font-heading">Select Document
                              Type</label>
                          <div class="position-relative">
                              <select id="documentType" onchange="showFields()"
                                  class="form-select py-9 placeholder-13 text-15">
                                  <option disabled selected>Select Document Type</option>
                                  <option value="passport">Passport</option>
                                  <option value="nic">NIC</option>
                                  <option value="proof_of_address">Proof Of Address</option>
                              </select>
                          </div>
                      </div>


                      <!-- Passport Fields -->
                      <div class="col-12 mt-16">
                          <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input type="text" class="form-control py-11" name="document_type" value="passport" hidden>
                              <input type="text" class="form-control py-11" name="user_id" value="{{ $user->id }}" hidden>
                              <div id="passportFields" class="document-fields" style="display:none;">
                                  <div class="form-group">
                                      <label for="passportNumber">Passport Number</label>
                                      <input type="text" class="form-control" id="passportNumber"
                                          name="file_name" placeholder="Enter Passport Number" required>
                                  </div>

                                  <div class="upload-card-item p-16 rounded-12 bg-main-50 mb-20 mt-4">
                                      <div class="flex-align gap-10 flex-wrap">
                                          <span
                                              class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                                              <i class="ph ph-paperclip"></i>
                                          </span>
                                          <div class="">
                                              <p class="text-15 text-gray-500">
                                                  Please upload a clear image of your passport for verification.
                                                  <label for="passport"
                                                      class="text-main-600 cursor-pointer">Browse</label>
                                                      <input name="file" type="file" id="passport" accept=".jpg,.jpeg,.png,.webp,.pdf" hidden>
                                              </p>
                                              <p class="text-13 text-gray-600">JPG, PNG, WEBP, or PDF format (max file size 10MB each)</p>
                                              <span class="show-uploaded-passport-name d-none"
                                                  id="uploaded-passport-name"></span>
                                          </div>
                                      </div>
                                  </div>
                                      <div class="col-12 mt-2-rem">
                                        <div class="flex-align justify-content-end gap-8">

                                            <button type="submit" class="btn btn-main rounded-pill py-9">Upload Document</button>
                                        </div>
                                    </div>
                          </form>


                      </div>
                      <!-- Drop Course Videos End -->

                  </div>
              </div>


              <!-- NIC Fields -->

              <div id="nicFields" class="document-fields" style="display:none;">
                  <div class="form-group">
                      <label for="nicNumber">NIC Number</label>
                      <input type="text" class="form-control" id="nicNumber" name="nic_number"
                          placeholder="Enter NIC Number">
                  </div>
                  <div class="form-group">
                      <label for="nicUpload">Upload NIC</label>
                      <input type="file" class="form-control-file" id="nicUpload" name="nic_file">
                  </div>
              </div>

              <!-- Proof of Address Fields -->
              <div id="proofOfAddressFields" class="document-fields" style="display:none;">
                  <div class="form-group">
                      <label for="addressUpload">Upload Proof of Address</label>
                      <input type="file" class="form-control-file" id="addressUpload" name="proof_of_address_file">
                  </div>
              </div>




          </div>


      </div>
  </div>

  </div>
  </div>
  </div>
  <!-- Password Tab End -->

  @push('scripts')
      <script>
          function showFields() {
              const documentType = document.getElementById("documentType").value;

              // Hide all document fields initially
              document.querySelectorAll('.document-fields').forEach(field => {
                  field.style.display = 'none';
              });

              // Show specific fields based on selected document type
              if (documentType === 'passport') {
                  document.getElementById('passportFields').style.display = 'block';
              } else if (documentType === 'nic') {
                  document.getElementById('nicFields').style.display = 'block';
              } else if (documentType === 'proof_of_address') {
                  document.getElementById('proofOfAddressFields').style.display = 'block';
              }
          }

          // Upload Video & show it's name js Start
          document.getElementById('passport').addEventListener('change', function(event) {
              var uploadedVideoName = document.getElementById('uploaded-passport-name');
              var files = event.target.files;

              if (files.length > 0) {
                  var fileNames = Array.from(files).map(file => file.name).join(', ');
                  uploadedVideoName.textContent = fileNames;
                  $('.show-uploaded-passport-name').removeClass('d-none');
              } else {
                  uploadedVideoName.textContent = '';
              }
          });
          // Upload Video & show it's name js End
      </script>
  @endpush
