  <!-- Password Tab Start -->
  <div class="tab-pane fade" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab"
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



                                  <!-- Proof of Identity -->
                                  <optgroup label="Proof of Identity">
                                      <option value="passport">Passport</option>
                                      <option value="national_id_card">National ID Card (NIC)</option>
                                      <option value="drivers_license">Driver's License</option>
                                  </optgroup>

                                  <!-- Proof of Address -->
                                  <optgroup label="Proof of Address">
                                      <option value="proof_of_address">Proof Of Address</option>
                                  </optgroup>

                                  <!-- Qualifications and Certifications -->
                                  <optgroup label="Qualifications and Certifications">
                                      <option value="educational_certificates">Educational Certificates</option>
                                  </optgroup>

                                  <!-- Employment History -->
                                  <optgroup label="Employment History">
                                      <option value="reference_letters">Reference Letters</option>
                                      <option value="employment_contracts">Employment Contracts</option>
                                  </optgroup>

                                  <!-- Criminal Record -->
                                  <optgroup label="Criminal Record">
                                      <option value="police_clearance">Police Clearance Certificate</option>
                                  </optgroup>

                                  <!-- Health Documents -->
                                  <optgroup label="Health Documents">
                                      <option value="medical_certificate">Medical Certificate</option>
                                  </optgroup>





                              </select>
                          </div>
                      </div>


                      @include('backend.user.settings.form.passport')
                      @include('backend.user.settings.form.id')
                      @include('backend.user.settings.form.license')
                      @include('backend.user.settings.form.address')
                      @include('backend.user.settings.form.education')
                      @include('backend.user.settings.form.reference')
                      @include('backend.user.settings.form.employement')
                      @include('backend.user.settings.form.police')
                      @include('backend.user.settings.form.medical')


                  </div>

                  <div class="row">
                      @include('backend.user.settings.form.attachments')
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
              } else if (documentType === 'national_id_card') {
                  document.getElementById('nationalIdCardFields').style.display = 'block';
              } else if (documentType === 'drivers_license') {
                  document.getElementById('licenseFields').style.display = 'block';
              } else if (documentType === 'proof_of_address') {
                  document.getElementById('proofOfAddressFields').style.display = 'block';
              } else if (documentType === 'educational_certificates') {
                  document.getElementById('educationalCertificatesFields').style.display = 'block';
              } else if (documentType === 'reference_letters') {
                  document.getElementById('referenceLettersFields').style.display = 'block';
              } else if (documentType === 'employment_contracts') {
                  document.getElementById('employmentContractsFields').style.display = 'block';
              } else if (documentType === 'police_clearance') {
                  document.getElementById('policeClearanceFields').style.display = 'block';
              } else if (documentType === 'medical_certificate') {
                  document.getElementById('medicalCertificateFields').style.display = 'block';
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
              var fileContainer = fileInput.closest('.upload-section');
              var uploadedFileName = fileContainer.querySelector('.show-uploaded-passport-name');

              var files = fileInput.files;

              if (files.length > 0) {
                  var fileName = files[0].name; // Only one file
                  uploadedFileName.textContent = fileName;
                  uploadedFileName.classList.remove('d-none'); // Show the file name
              } else {
                  uploadedFileName.textContent = '';
                  uploadedFileName.classList.add('d-none'); // Hide if no file selected
              }
          }

          // Function to trigger the file input when "Browse" is clicked
          function handleBrowseClick(event) {
              var label = event.target;
              var fileInput = label.closest('.upload-section').querySelector(
                  '.file-input'); // Find the correct input in the same section

              fileInput.click(); // Trigger the hidden file input
          }

          // Attach event listeners after DOM is loaded
          document.addEventListener('DOMContentLoaded', function() {
              // Attach event listeners to all labels with class 'file-label'
              document.querySelectorAll('.file-label').forEach(label => {
                  label.addEventListener('click', handleBrowseClick);
              });

              // Handle file input changes
              document.querySelectorAll('.file-input').forEach(input => {
                  input.addEventListener('change', handleFileInputChange);
              });
          });



          // Upload Video & show it's name js End
      </script>
  @endpush
