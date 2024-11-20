<!-- Notes Tab Content -->
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade" id="pills-notes" role="tabpanel" aria-labelledby="pills-notes-tab" tabindex="0">
        <div class="card mt-24">
            <div class="card-header border-bottom">
                <h4 class="mb-4">Notes</h4>
                <p class="text-gray-600 text-15">User Notes (Only Visible Admins)</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="{{ route('user.notes.storeOrUpdate') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <textarea name="review" class="form-control" rows="20">{{ $note->review ?? '' }}</textarea>
                            <br>
                            <button class="btn btn-primary" type="submit">
                                Save Notes
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
