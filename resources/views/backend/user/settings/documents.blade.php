  <!-- Password Tab Start -->
  <div class="tab-pane fade show active" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab"
      tabindex="0">
      <div class="card mt-24">
          <div class="card-header border-bottom">
              <h4 class="mb-4">Documents</h4>
              <p class="text-gray-600 text-15">Please fill full documents about your user</p>
          </div>
          <div class="card-body">

              <div class="row">
                  <div class="col-6">
                      <div class="col-12 mt-16">
                          <label for="documentType" class="h5 mb-8 fw-semibold font-heading">Select Document
                              Type</label>
                          <div class="position-relative">
                              <select id="documentType" onchange="showFields()"
                                  class="form-select py-9 placeholder-13 text-15">
                                  <option disabled selected>Select Document Type</option>
                                  <option value="passport">Passport</option>
                                  <option value="government_id">Government ID</option>
                                  <option value="proof_of_address">Proof Of Address</option>
                              </select>
                          </div>
                      </div>


                      @include('backend.user.settings.form.passport')
                      @include('backend.user.settings.form.id')


                  </div>
              </div>

              @include('backend.user.settings.form.attachments')

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
              } else if (documentType === 'government_id') {
                  document.getElementById('idFields').style.display = 'block';
              } else if (documentType === 'proof_of_address') {
                  document.getElementById('proofOfAddressFields').style.display = 'block';
              }
          }

          // Upload Video & show it's name js Start
          //   document.getElementById('passport').addEventListener('change', function(event) {
          //       var uploadedVideoName = document.getElementById('uploaded-passport-name');
          //       var files = event.target.files;

          //       if (files.length > 0) {
          //           var fileNames = Array.from(files).map(file => file.name).join(', ');
          //           uploadedVideoName.textContent = fileNames;
          //           $('.show-uploaded-passport-name').removeClass('d-none');
          //       } else {
          //           uploadedVideoName.textContent = '';
          //       }
          //   });

          // Function to handle file input changes
          function handleFileInputChange(event) {
              var fileInput = event.target;
              var fileContainer = fileInput.closest('.upload-section'); // Find the closest parent section
              var uploadedFileName = fileContainer.querySelector(
              '.show-uploaded-passport-name'); // Find the corresponding span

              var files = fileInput.files;

              if (files.length > 0) {
                  var fileNames = Array.from(files).map(file => file.name).join(', ');
                  uploadedFileName.textContent = fileNames;
                  uploadedFileName.classList.remove('d-none'); // Show the file name
              } else {
                  uploadedFileName.textContent = '';
                  uploadedFileName.classList.add('d-none'); // Hide if no files
              }
          }

          // Attach event listeners to all file inputs with class 'file-input'
          document.querySelectorAll('.file-input').forEach(input => {
              input.addEventListener('change', handleFileInputChange);
          });



          // Upload Video & show it's name js End
      </script>
  @endpush
