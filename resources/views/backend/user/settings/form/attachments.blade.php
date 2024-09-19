<div class="col-6 mt-16">
    <label for="documentType" class="h5 mb-8 fw-semibold font-heading">Attached Documents</label>

    @if ($documents->isEmpty())
        <p>No documents found for this user.</p>
    @else
        <ul>
            @foreach ($documents as $document)
                <li>
                    <div class="upload-card-item p-16 rounded-12 bg-primary-100 mb-20">
                        <div class="flex-between gap-8">
                            <div class="flex-align gap-10 flex-wrap">
                                <span
                                    class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                                    @if ($document->file_type == 'image/jpeg')
                                        <i class="ph ph-file-jpg"></i>
                                    @elseif($document->file_type == 'image/png')
                                        <i class="ph ph-file-png"></i>
                                    @elseif($document->file_type == 'application/pdf')
                                        <i class="ph ph-file-pdf"></i>
                                    @else
                                        <i class="ph ph-paperclip"></i>
                                    @endif


                                </span>
                                <div class="">
                                    <p class="text-15 text-gray-500"><strong> {{ ucwords(str_replace('_', ' ', $document->document_type)) }}

                                        </strong> - {{ $document->file_original_name }} </p>
                                    <p class="text-13 text-gray-600">( File Size :
                                        {{ number_format($document->file_size / 1024, 2) }} KB )</p>
                                    <p class="text-13 text-gray-600">{{ $document->file_name }}</p>
                                </div>
                            </div>
                            <div class="flex-align gap-8">
                                <span class="text-main-600 d-flex text-xl"><i
                                        class="ph-fill ph-check-circle"></i></span>
                                <!-- Dropdown Start -->
                                <div class="dropdown flex-shrink-0">
                                    <button class="text-gray-600 text-xl d-flex rounded-4" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ph-fill ph-dots-three-outline"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu--md border-0 bg-transparent p-0">
                                        <div class="card border border-gray-100 rounded-12 box-shadow-custom">
                                            <div class="card-body p-12">
                                                <div class="max-h-200 overflow-y-auto scroll-sm pe-8">
                                                    <ul>
                                                        <li class="mb-0">
                                                            <button type="button"
                                                            onclick="viewDocument('{{ asset('storage/' . $document->file_path) }}', '{{ pathinfo($document->file_path, PATHINFO_EXTENSION) }}')"
                                                                class="view-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                                <span class="text">View</span>
                                                            </button>

                                                            <a  href="{{ asset('storage/' . $document->file_path) }}" type="button" download="{{ $document->file_original_name }}"
                                                            class="delete-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                            <span class="text">Download</span>
                                                            </a>


                                                            <button type="button"
                                                                onclick="confirmDelete({{ $document->id }})"
                                                                class="delete-item-btn py-6 text-15 px-8 hover-bg-gray-50 text-gray-300 w-100 rounded-8 fw-normal text-xs d-block text-start">
                                                                <span class="text">Delete</span>
                                                            </button>
                                                            <form id="delete-form-{{ $document->id }}"
                                                                action="{{ route('documents.destroy', $document->id) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dropdown end -->
                            </div>
                        </div>
                    </div>

                </li>
            @endforeach
        </ul>
    @endif

</div>

<!-- Modal for viewing document -->
<div class="modal fade" id="documentModal" tabindex="-1" aria-labelledby="documentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentModalLabel">Document Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <iframe id="documentFrame" src="" width="100%" height="500px" frameborder="0"></iframe>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <!-- SweetAlert Script -->
    <script>
        function confirmDelete(documentId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + documentId).submit();
                }
            })
        }


        function viewDocument(fileUrl, fileType) {
        const documentFrame = document.getElementById('documentFrame');
        const modalBody = document.querySelector('.modal-body');

        // Clear the modal content first
        modalBody.innerHTML = '';

        if (fileType === 'pdf') {
            // For PDFs, use an iframe
            modalBody.innerHTML = `<iframe src="${fileUrl}" width="100%" height="500px" frameborder="0"></iframe>`;
        } else if (fileType === 'jpeg' || fileType === 'png' || fileType === 'jpg') {
            // For images, show an image element
            modalBody.innerHTML = `<img src="${fileUrl}" class="modal-image" />`;
        }

        // Show the modal
        $('#documentModal').modal('show');
    }
    </script>
@endpush
