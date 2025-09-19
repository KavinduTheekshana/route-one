@push('styles')
@endpush

@extends('layouts.backend')

@section('content')

    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        {{-- Breadcrumb  --}}
    @section('page_name', 'Routeone Bulk Mail System')
    @include('backend.components.breadcrumb')

</div>

@include('backend.components.alert')

<div class="row gy-4">

    <div class="col-xxl-6">
        <div class="card overflow-hidden p-16 ">
            <h4 class="mb-0 ml-4">Routeone Bulk Mail System</h4>
            <div class="card-body p-16">

                <div class="upload-card-item p-16 rounded-12 bg-main-50 mb-20 mt-4">
                    <div class="flex-align gap-10 flex-wrap">
                        <span class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                            <i class="ph ph-paperclip"></i>
                        </span>
                        <div class="upload-section">
                            <p class="text-15 text-gray-500">
                                Please Upload Your Email List
                                <label class="text-main-600 cursor-pointer file-label">Browse</label>
                                <input name="file" type="file" class="file-input" accept=".csv" hidden="">
                            </p>
                            <p class="text-13 text-gray-600">CSV format (max file size 10MB each)</p>
                            <span class="show-uploaded-passport-name d-none"></span>
                        </div>
                    </div>
                </div>

                <!-- Logo Upload Section -->
                <div class="upload-card-item p-16 rounded-12 bg-warning-50 mb-20">
                    <div class="flex-align gap-10 flex-wrap">
                        <span
                            class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-warning-600 flex-shrink-0">
                            <i class="ph ph-image"></i>
                        </span>
                        <div class="upload-section">
                            <p class="text-15 text-gray-500">
                                Upload Email Logos (Optional)
                                <label class="text-warning-600 cursor-pointer logo-label">Browse Images</label>
                                <input name="logos" type="file" class="logo-input" multiple accept="image/*"
                                    hidden="">
                            </p>
                            <p class="text-13 text-gray-600">Images for embedding in emails (JPG, PNG, GIF - max 5MB
                                each)</p>
                            <div class="logo-list mt-2"></div>
                        </div>
                    </div>
                </div>

                <!-- Attachments Upload Section -->
                <div class="upload-card-item p-16 rounded-12 bg-success-50 mb-20">
                    <div class="flex-align gap-10 flex-wrap">
                        <span
                            class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-success-600 flex-shrink-0">
                            <i class="ph ph-upload"></i>
                        </span>
                        <div class="upload-section">
                            <p class="text-15 text-gray-500">
                                Add Email Attachments (Optional)
                                <label class="text-success-600 cursor-pointer attachment-label">Browse Files</label>
                                <input name="attachments" type="file" class="attachment-input" multiple
                                    hidden="">
                            </p>
                            <p class="text-13 text-gray-600">Multiple files allowed (max 10MB each)</p>
                            <div class="attachment-list mt-2"></div>
                        </div>
                    </div>
                </div>

                <!-- Loading Screen -->
                <div id="loading-screen" style="display: none;">
                    <p>Loading... Please wait.</p>
                </div>

                <!-- Table to Display CSV Data -->
                <table id="csv-table" style="display: none; width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #ddd; padding: 8px;">#</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Name</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Email</th>
                            <th style="border: 1px solid #ddd; padding: 8px;">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-xxl-6">
        <div class="card overflow-hidden p-16">
            <div class="card-body p-16">
                <div class="col-sm-12">
                    <label class="form-label mb-8 h6">Subject <span
                            class="text-13 text-red fw-medium">(Required)</span></label>
                    <div class="position-relative">
                        <input type="text" name="subject" required=""
                            class="text-counter placeholder-13 form-control py-11 pe-76" placeholder="Subject">
                    </div>
                </div>
                <br>
                <div class="col-12">
                    <div class="editor">
                        <label class="form-label mb-8 h6">Email Content <span
                                class="text-13 text-red fw-medium">(Required)</span></label>
                        <p class="text-gray"> <small>
                                You can personalize your email by including the recipient's name in the email body.
                                Simply add <span class="text-13 text-red fw-medium">{name}</span> wherever you want the
                                recipient's name to appear in your email content. The system will automatically replace
                                {name} with each person's name when sending the email.</small></p>

                        <!-- Template Type Selector -->
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="template_type" id="rich_text"
                                    value="rich_text" checked>
                                <label class="form-check-label" for="rich_text">Rich Text Editor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="template_type" id="html_code"
                                    value="html_code">
                                <label class="form-check-label" for="html_code">HTML Code</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="template_type" id="predefined"
                                    value="predefined">
                                <label class="form-check-label" for="predefined">Predefined Templates</label>
                            </div>
                        </div>

                        <!-- Rich Text Editor -->
                        <div id="rich-text-editor" class="editor-section">
                            <textarea id="description" class="form-control" rows="8"></textarea>
                        </div>

                        <!-- HTML Code Editor -->
                        <div id="html-code-editor" class="editor-section" style="display: none;">
                            <div class="mb-2">
                                <small class="text-muted">
                                    <strong>Important:</strong> Don't use external image URLs (they get blocked). Upload
                                    logos above and use <code>cid:YOUR_CID</code> instead.
                                    <br>Example: Replace <code>src="https://example.com/logo.png"</code> with
                                    <code>src="cid:logo_12345"</code>
                                </small>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-sm bg-warning" id="insert-logo-btn"
                                        style="opacity: 1; visibility: visible;">
                                        <i class="ph ph-image"></i> Insert Logo at Cursor
                                    </button>
                                    <select id="logo-selector" class="form-select form-select-sm d-inline-block"
                                        style="width: auto; margin-left: 10px; opacity: 1; visibility: visible;">
                                        <option value="">Select a logo...</option>
                                    </select>
                                </div>
                            </div>
                            <textarea id="html-content" class="form-control" rows="15"
                                placeholder="Paste your complete HTML template here...
"></textarea>
                        </div>

                        <!-- Predefined Templates -->
                        <div id="predefined-templates" class="editor-section" style="display: none;">
                            <select id="template-selector" class="form-control mb-3">
                                <option value="">Select a template...</option>
                                <option value="welcome">Welcome Email</option>
                                <option value="newsletter">Newsletter</option>
                                <option value="announcement">Announcement</option>
                                <option value="invitation">Event Invitation</option>
                            </select>
                            <div id="template-preview" class="border p-3"
                                style="min-height: 200px; background-color: #f9f9f9;">
                                <p class="text-muted">Select a template to preview</p>
                            </div>
                        </div>

                        <!-- Preview Button -->
                        <div class="mt-3">
                            <button type="button" class="btn btn-primary" id="preview-email">
                                <i class="ph ph-eye"></i> Preview Email
                            </button>
                        </div>
                    </div>
                </div>

                <br>
                <div class="flex-align justify-content-end gap-8">
                    <button type="submit" class="btn btn-main rounded-pill py-9">Send Bulk</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $('#description').trumbowyg();
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let selectedAttachments = [];
    let selectedLogos = [];

    // Predefined email templates
    const emailTemplates = {
        welcome: `<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; }
        .header { background-color: #3e80f9; color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; line-height: 1.6; }
        .footer { background-color: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; color: #666; }
        .btn { background-color: #3e80f9; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome {name}!</h1>
        </div>
        <div class="content">
            <p>Dear {name},</p>
            <p>Welcome to our platform! We're excited to have you join our community.</p>
            <p>Get started by exploring our features and don't hesitate to reach out if you need any help.</p>
            <p style="text-align: center;">
                <a href="#" class="btn">Get Started</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>`,
        newsletter: `<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; }
        .header { background-color: #2c5aa0; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .article { margin-bottom: 30px; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        .article h3 { color: #2c5aa0; margin-top: 0; }
        .footer { background-color: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Monthly Newsletter</h1>
        </div>
        <div class="content">
            <p>Hello {name},</p>
            <div class="article">
                <h3>Article Title 1</h3>
                <p>Your article content goes here...</p>
            </div>
            <div class="article">
                <h3>Article Title 2</h3>
                <p>Your article content goes here...</p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
            <p><a href="#">Unsubscribe</a></p>
        </div>
    </div>
</body>
</html>`,
        announcement: `<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; }
        .header { background-color: #ff6b35; color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; line-height: 1.6; }
        .highlight { background-color: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 4px; margin: 20px 0; }
        .footer { background-color: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Important Announcement</h1>
        </div>
        <div class="content">
            <p>Dear {name},</p>
            <div class="highlight">
                <h3>📢 Important Update</h3>
                <p>Your announcement content goes here...</p>
            </div>
            <p>Thank you for your attention to this matter.</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>`,
        invitation: `<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: white; }
        .header { background-color: #6c5ce7; color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; line-height: 1.6; }
        .event-details { background-color: #f8f9ff; border: 1px solid #6c5ce7; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .btn { background-color: #6c5ce7; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .footer { background-color: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>You're Invited!</h1>
        </div>
        <div class="content">
            <p>Dear {name},</p>
            <p>We're excited to invite you to our upcoming event.</p>
            <div class="event-details">
                <h3>🎉 Event Details</h3>
                <p><strong>Date:</strong> [Event Date]</p>
                <p><strong>Time:</strong> [Event Time]</p>
                <p><strong>Location:</strong> [Event Location]</p>
            </div>
            <p style="text-align: center;">
                <a href="#" class="btn">RSVP Now</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Your Company Name. All rights reserved.</p>
        </div>
    </div>
</body>
</html>`
    };

    // Template type switching
    document.addEventListener('DOMContentLoaded', function() {
        const templateTypeRadios = document.querySelectorAll('input[name="template_type"]');
        const richTextEditor = document.getElementById('rich-text-editor');
        const htmlCodeEditor = document.getElementById('html-code-editor');
        const predefinedTemplates = document.getElementById('predefined-templates');
        const templateSelector = document.getElementById('template-selector');
        const templatePreview = document.getElementById('template-preview');

        templateTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Hide all sections
                richTextEditor.style.display = 'none';
                htmlCodeEditor.style.display = 'none';
                predefinedTemplates.style.display = 'none';

                // Show selected section
                if (this.value === 'rich_text') {
                    richTextEditor.style.display = 'block';
                } else if (this.value === 'html_code') {
                    htmlCodeEditor.style.display = 'block';
                } else if (this.value === 'predefined') {
                    predefinedTemplates.style.display = 'block';
                }
            });
        });

        // Template selector
        templateSelector.addEventListener('change', function() {
            const selectedTemplate = this.value;
            if (selectedTemplate && emailTemplates[selectedTemplate]) {
                templatePreview.innerHTML =
                    `<pre style="white-space: pre-wrap; font-size: 12px;">${emailTemplates[selectedTemplate]}</pre>`;
            } else {
                templatePreview.innerHTML = '<p class="text-muted">Select a template to preview</p>';
            }
        });

        // Preview email button
        document.getElementById('preview-email').addEventListener('click', function() {
            const content = getEmailContent();
            if (content) {
                // Replace {name} with a sample name for preview
                let previewContent = content.replace(/{name}/g, 'John Doe');

                // Replace logo CIDs with sample images for preview
                selectedLogos.forEach(logo => {
                    const cidPattern = new RegExp('cid:' + logo.cid.replace(
                        /[.*+?^${}()|[\]\\]/g, '\\$&'), 'g');
                    // Create a data URL from the file for preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContent = previewContent.replace(cidPattern, e.target
                        .result);
                    };
                    if (logo.file) {
                        reader.readAsDataURL(logo.file);
                    }
                });

                // Check if it's a complete HTML document
                const isCompleteHtml = (
                    previewContent.trim().toLowerCase().indexOf('<!doctype') === 0 ||
                    previewContent.trim().toLowerCase().indexOf('<!DOCTYPE') === 0 ||
                    (previewContent.includes('<html') && previewContent.includes('</html>'))
                );

                if (isCompleteHtml) {
                    // Open in new window for complete HTML documents to preserve CSS
                    const newWindow = window.open('', '_blank');
                    newWindow.document.write(previewContent);
                    newWindow.document.close();
                } else {
                    // Use SweetAlert for partial HTML
                    Swal.fire({
                        title: 'Email Preview',
                        html: `<div style="max-height: 400px; overflow-y: auto; text-align: left;">${previewContent}</div>`,
                        width: '80%',
                        showCloseButton: true,
                        showConfirmButton: false,
                        customClass: {
                            htmlContainer: 'swal-html-container'
                        }
                    });
                }
            } else {
                Swal.fire('Error', 'Please create your email content first.', 'error');
            }
        });
    });

    // Function to get email content based on selected type
    function getEmailContent() {
        const selectedType = document.querySelector('input[name="template_type"]:checked').value;

        if (selectedType === 'rich_text') {
            return document.getElementById('description').value;
        } else if (selectedType === 'html_code') {
            return document.getElementById('html-content').value;
        } else if (selectedType === 'predefined') {
            const selectedTemplate = document.getElementById('template-selector').value;
            return emailTemplates[selectedTemplate] || '';
        }

        return '';
    }

    // Function to handle attachment selection
    function handleAttachmentSelection(event) {
        const files = Array.from(event.target.files);
        const attachmentList = document.querySelector('.attachment-list');

        files.forEach(file => {
            // Check file size (10MB limit)
            if (file.size > 10 * 1024 * 1024) {
                Swal.fire('Error', `File "${file.name}" is too large. Maximum size is 10MB.`, 'error');
                return;
            }

            selectedAttachments.push(file);

            // Create attachment item display
            const attachmentItem = document.createElement('div');
            attachmentItem.className =
                'attachment-item d-flex justify-content-between align-items-center p-2 bg-light rounded mb-2';
            attachmentItem.innerHTML = `
                <span class="text-sm">${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
                <button type="button" class="btn btn-sm btn-danger remove-attachment" data-filename="${file.name}">
                    <i class="ph ph-x"></i>
                </button>
            `;
            attachmentList.appendChild(attachmentItem);
        });

        // Clear the input
        event.target.value = '';

        // Attach remove event listeners
        attachRemoveAttachmentListeners();
    }

    // Function to remove attachments
    function attachRemoveAttachmentListeners() {
        document.querySelectorAll('.remove-attachment').forEach(button => {
            button.addEventListener('click', function() {
                const filename = this.getAttribute('data-filename');
                selectedAttachments = selectedAttachments.filter(file => file.name !== filename);
                this.closest('.attachment-item').remove();
            });
        });
    }

    // Function to handle logo selection
    function handleLogoSelection(event) {
        const files = Array.from(event.target.files);
        const logoList = document.querySelector('.logo-list');

        files.forEach(file => {
            // Check if it's an image
            if (!file.type.startsWith('image/')) {
                Swal.fire('Error', `File "${file.name}" is not an image.`, 'error');
                return;
            }

            // Check file size (5MB limit for images)
            if (file.size > 5 * 1024 * 1024) {
                Swal.fire('Error', `Image "${file.name}" is too large. Maximum size is 5MB.`, 'error');
                return;
            }

            // Generate a unique CID for this logo
            const cid = 'logo_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);

            selectedLogos.push({
                file: file,
                cid: cid,
                name: file.name
            });

            // Create logo item display with preview
            const logoItem = document.createElement('div');
            logoItem.className =
                'logo-item d-flex justify-content-between align-items-center p-2 bg-light rounded mb-2';

            // Create image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                logoItem.innerHTML = `
                    <div class="d-flex align-items-center">
                        <img src="${e.target.result}" alt="${file.name}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; margin-right: 10px;">
                        <div>
                            <div class="text-sm">${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</div>
                            <div class="text-xs text-muted">CID: ${cid}</div>
                            <button type="button" class="btn btn-xs btn-outline-secondary copy-cid" data-cid="${cid}">
                                Copy CID
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-logo" data-cid="${cid}">
                        <i class="ph ph-x"></i>
                    </button>
                `;
                logoList.appendChild(logoItem);

                // Attach event listeners
                attachRemoveLogoListeners();
                attachCopyCidListeners();
            };
            reader.readAsDataURL(file);
        });

        // Clear the input
        event.target.value = '';

        // Update logo selector
        updateLogoSelector();
    }

    // Function to remove logos
    function attachRemoveLogoListeners() {
        document.querySelectorAll('.remove-logo').forEach(button => {
            button.addEventListener('click', function() {
                const cid = this.getAttribute('data-cid');
                selectedLogos = selectedLogos.filter(logo => logo.cid !== cid);
                this.closest('.logo-item').remove();
                updateLogoSelector();
            });
        });
    }

    // Function to copy CID to clipboard
    function attachCopyCidListeners() {
        document.querySelectorAll('.copy-cid').forEach(button => {
            button.addEventListener('click', function() {
                const cid = this.getAttribute('data-cid');
                const cidText = `cid:${cid}`;

                navigator.clipboard.writeText(cidText).then(function() {
                    // Show temporary success message
                    const originalText = button.textContent;
                    button.textContent = 'Copied!';
                    button.classList.add('btn-success');
                    button.classList.remove('btn-outline-secondary');

                    setTimeout(() => {
                        button.textContent = originalText;
                        button.classList.remove('btn-success');
                        button.classList.add('btn-outline-secondary');
                    }, 2000);
                }).catch(function() {
                    // Fallback for older browsers
                    const textArea = document.createElement('textarea');
                    textArea.value = cidText;
                    document.body.appendChild(textArea);
                    textArea.select();
                    document.execCommand('copy');
                    document.body.removeChild(textArea);

                    Swal.fire('Copied!', `CID "${cidText}" copied to clipboard`, 'success');
                });
            });
        });
    }

    // Function to update logo selector dropdown
    function updateLogoSelector() {
        const logoSelector = document.getElementById('logo-selector');
        const insertBtn = document.getElementById('insert-logo-btn');

        // Clear existing options
        logoSelector.innerHTML = '<option value="">Select a logo...</option>';

        // Add logo options
        selectedLogos.forEach(logo => {
            const option = document.createElement('option');
            option.value = logo.cid;
            option.textContent = logo.name;
            logoSelector.appendChild(option);
        });

        // Enable/disable controls - keep button visible but functional based on logo availability
        const hasLogos = selectedLogos.length > 0;
        logoSelector.disabled = !hasLogos;
        insertBtn.disabled = !hasLogos;
    }

    // Function to insert logo at cursor position
    function insertLogoAtCursor() {
        const logoSelector = document.getElementById('logo-selector');
        const htmlContent = document.getElementById('html-content');
        const selectedCid = logoSelector.value;

        if (selectedLogos.length === 0) {
            Swal.fire('Error', 'Please upload a logo first.', 'error');
            return;
        }

        if (!selectedCid) {
            Swal.fire('Error', 'Please select a logo from the dropdown.', 'error');
            return;
        }

        const cidCode = `cid:${selectedCid}`;

        // Insert at cursor position
        const startPos = htmlContent.selectionStart;
        const endPos = htmlContent.selectionEnd;
        const textBefore = htmlContent.value.substring(0, startPos);
        const textAfter = htmlContent.value.substring(endPos);

        htmlContent.value = textBefore + cidCode + textAfter;

        // Move cursor to end of inserted text
        const newCursorPos = startPos + cidCode.length;
        htmlContent.setSelectionRange(newCursorPos, newCursorPos);
        htmlContent.focus();

        // Reset selector
        logoSelector.value = '';
        document.getElementById('insert-logo-btn').disabled = true;
    }

    // Function to handle file input changes for CSV
    function handleFileInputChange(event) {
        var fileInput = event.target;
        var fileContainer = fileInput.closest('.upload-section');
        var uploadedFileName = fileContainer.querySelector('.show-uploaded-passport-name');
        var loadingScreen = document.getElementById('loading-screen');
        var csvTable = document.getElementById('csv-table');
        var tbody = csvTable.querySelector('tbody');

        var files = fileInput.files;

        if (files.length > 0) {
            var file = files[0];
            var fileName = file.name;

            uploadedFileName.textContent = fileName;
            uploadedFileName.classList.remove('d-none');
            loadingScreen.style.display = 'block';

            Papa.parse(file, {
                complete: function(result) {
                    loadingScreen.style.display = 'none';
                    csvTable.style.display = 'table';
                    tbody.innerHTML = '';

                    var data = result.data;
                    var headers = data[0];
                    var nameIndex = headers.findIndex(header => header.toLowerCase().includes('name'));
                    var emailIndex = headers.findIndex(header => header.toLowerCase().includes('email'));

                    data.slice(1).forEach((row, index) => {
                        var name = row[nameIndex];
                        var email = row[emailIndex];

                        if (name && email) {
                            var tr = document.createElement('tr');
                            tr.innerHTML = `
                            <td style="border: 1px solid #ddd; padding: 8px;">${index + 1}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">${name}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">${email}</td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                <button type="button" class="remove-btn" style="color: red; cursor: pointer;">Remove</button>
                            </td>
                        `;
                            tbody.appendChild(tr);
                        }
                    });

                    attachRemoveEventListeners();
                },
                header: false,
                skipEmptyLines: true
            });
        } else {
            uploadedFileName.textContent = '';
            uploadedFileName.classList.add('d-none');
        }
    }

    // Function to attach event listeners to remove buttons
    function attachRemoveEventListeners() {
        var removeButtons = document.querySelectorAll('.remove-btn');
        removeButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                var row = event.target.closest('tr');
                row.remove();
            });
        });
    }

    // Function to trigger file inputs
    function handleBrowseClick(event) {
        var label = event.target;
        var fileInput = label.closest('.upload-section').querySelector('.file-input');
        fileInput.click();
    }

    function handleAttachmentBrowseClick(event) {
        var label = event.target;
        var fileInput = label.closest('.upload-section').querySelector('.attachment-input');
        fileInput.click();
    }

    function handleLogoBrowseClick(event) {
        var label = event.target;
        var fileInput = label.closest('.upload-section').querySelector('.logo-input');
        fileInput.click();
    }

    // Function to handle sending bulk emails with attachments
    function sendBulkEmails() {
        var emails = [];
        var tableRows = document.querySelectorAll('#csv-table tbody tr');
        tableRows.forEach(function(row) {
            var name = row.cells[1].textContent;
            var email = row.cells[2].textContent;

            if (email) {
                emails.push({
                    name: name,
                    email: email
                });
            }
        });

        if (emails.length === 0) {
            Swal.fire('Error', 'Please upload a CSV file with email addresses.', 'error');
            return;
        }

        var subject = document.querySelector('input[name="subject"]').value;
        var body = getEmailContent(); // Use the new function to get content

        if (!subject || !body) {
            Swal.fire('Error', 'Please fill in the subject and email content.', 'error');
            return;
        }

        // Create FormData object to handle file uploads
        var formData = new FormData();
        formData.append('subject', subject);
        formData.append('body', body);

        // Append emails array properly to FormData
        emails.forEach((email, index) => {
            formData.append(`emails[${index}][name]`, email.name);
            formData.append(`emails[${index}][email]`, email.email);
        });

        // Add attachments to FormData
        selectedAttachments.forEach((file, index) => {
            formData.append(`attachments[${index}]`, file);
        });

        // Add logos to FormData with their CIDs
        selectedLogos.forEach((logo, index) => {
            formData.append(`logos[${index}][file]`, logo.file);
            formData.append(`logos[${index}][cid]`, logo.cid);
            formData.append(`logos[${index}][name]`, logo.name);
        });

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Show loading alert
        let loadingText = `Preparing to send ${emails.length} emails`;
        if (selectedAttachments.length > 0) {
            loadingText += ` with ${selectedAttachments.length} attachment(s)`;
        }
        if (selectedLogos.length > 0) {
            loadingText += ` and ${selectedLogos.length} embedded logo(s)`;
        }
        loadingText += '...';

        Swal.fire({
            title: 'Sending Emails...',
            text: loadingText,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Send the request
        fetch('/send-bulk-emails', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(result => {
                Swal.close();
                if (result.success) {
                    let message = `Successfully sent ${result.success_count} emails`;
                    if (result.failed_count > 0) {
                        message += `. ${result.failed_count} emails failed to send.`;
                    }
                    Swal.fire('Success', message, 'success');

                    // Only clear CSV-related data to allow uploading a new email list
                    // Keep subject, email content, attachments, and logos intact
                    
                    // Clear CSV table and file input
                    document.getElementById('csv-table').style.display = 'none';
                    document.getElementById('csv-table').querySelector('tbody').innerHTML = '';
                    
                    // Clear CSV file input and uploaded file name display
                    document.querySelector('.file-input').value = '';
                    document.querySelector('.show-uploaded-passport-name').textContent = '';
                    document.querySelector('.show-uploaded-passport-name').classList.add('d-none');
                } else {
                    Swal.fire('Error', result.message || 'An error occurred while sending emails.', 'error');
                }
            })
            .catch(error => {
                Swal.close();
                console.error('Error:', error);
                Swal.fire('Error',
                    'An error occurred while sending emails. Please check the console for more details.',
                    'error');
            });
    }

    // Attach event listeners after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // CSV file upload
        document.querySelectorAll('.file-label').forEach(label => {
            label.addEventListener('click', handleBrowseClick);
        });

        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', handleFileInputChange);
        });

        // Attachment file upload
        document.querySelectorAll('.attachment-label').forEach(label => {
            label.addEventListener('click', handleAttachmentBrowseClick);
        });

        document.querySelectorAll('.attachment-input').forEach(input => {
            input.addEventListener('change', handleAttachmentSelection);
        });

        // Logo file upload
        document.querySelectorAll('.logo-label').forEach(label => {
            label.addEventListener('click', handleLogoBrowseClick);
        });

        document.querySelectorAll('.logo-input').forEach(input => {
            input.addEventListener('change', handleLogoSelection);
        });

        // Logo selector event listeners
        const logoSelector = document.getElementById('logo-selector');
        const insertLogoBtn = document.getElementById('insert-logo-btn');

        logoSelector.addEventListener('change', function() {
            // Only disable if no logos uploaded, not based on selection
            insertLogoBtn.disabled = selectedLogos.length === 0;
        });

        insertLogoBtn.addEventListener('click', insertLogoAtCursor);

        // Send bulk emails button
        document.querySelector('.btn-main').addEventListener('click', sendBulkEmails);
    });
</script>
@endpush
