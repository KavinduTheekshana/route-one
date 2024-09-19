<!-- Passport Fields -->
<div id="passportFields" class="document-fields" style="display:none;">
    <div class="col-12 mt-16">
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control py-11" name="document_type" value="passport" hidden>
            <input type="text" class="form-control py-11" name="user_id" value="{{ $user->id }}" hidden>

            <div class="form-group">
                <label for="passportNumber">Passport Number</label>
                <input type="text" class="form-control" id="passportNumber" name="file_name"
                    placeholder="Enter Passport Number" required>
            </div>

            <div class="upload-card-item p-16 rounded-12 bg-main-50 mb-20 mt-4">
                <div class="flex-align gap-10 flex-wrap">
                    <span class="w-36 h-36 text-lg rounded-circle bg-white flex-center text-main-600 flex-shrink-0">
                        <i class="ph ph-paperclip"></i>
                    </span>
                    <div class="">
                        <p class="text-15 text-gray-500">
                            Please upload a clear image of your passport for verification.
                            <label for="passport" class="text-main-600 cursor-pointer">Browse</label>
                            <input name="file" type="file" id="passport" accept=".jpg,.jpeg,.png,.webp,.pdf"
                                hidden>
                        </p>
                        <p class="text-13 text-gray-600">JPG, PNG, WEBP, or PDF format (max file
                            size 10MB each)</p>
                        <span class="show-uploaded-passport-name d-none" id="uploaded-passport-name"></span>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2-rem">
                <div class="flex-align justify-content-end gap-8">

                    <button type="submit" class="btn btn-main rounded-pill py-9">Upload
                        Document</button>
                </div>
            </div>
        </form>
    </div>

</div>
