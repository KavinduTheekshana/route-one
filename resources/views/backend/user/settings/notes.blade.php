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

                        @foreach($notes as $note)
                        <div class="p-xl-4 py-16 px-12 flex-between gap-8 rounded-8 border border-gray-100 hover-border-gray-200 transition-1 mb-16">
                            <div class="flex-align flex-wrap gap-8">
                                <span class="text-main-600 bg-main-50 w-44 h-44 rounded-circle flex-center text-2xl flex-shrink-0"><i class="ph ph-note"></i></span>
                                <div>
                                    {{-- <h6 class="mb-0">{{ $note->review }}</h6> --}}
                                    <h6 class="mb-0">
                                    <span class="text-13 text-gray-400">{{ $note->review }}</span></h6>
                                    <span class="text-13 text-gray-400"><small>- {{ $note->admin->name }} | {{ $note->created_at }}</small></span>
                                </div>
                            </div>

                        </div>
                        @endforeach

                        <form method="POST" action="{{ route('user.notes.storeOrUpdate') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <textarea name="review" class="form-control" rows="10"></textarea>
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
