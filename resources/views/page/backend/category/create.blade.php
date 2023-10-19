<div class="modal-dialog modal-l">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Create Category</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('category.store') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Name <span style="color: red;">*</span></label>
                            <input type="text" name="name" placeholder="Enter Category name" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-12" hidden>

                        <div class="select-split ">
                            <div class="select-group w-100">
                            <label>Session <span style="color: red;">*</span></label>
                                <div style="display: flex">
                                    @foreach ($session as $sessions)
                                        <div class="input-group" style="margin-right: 5px;">
                                            <div class="input-group-text">
                                                <input class="form-check-input" type="checkbox" value="{{ $sessions->id }}" id="session_id"  name="session_id[]"   aria-label="Checkbox for following text input">
                                            </div>
                                            <input type="text" class="form-control" value="{{ $sessions->name }}" readonly style="background: white;" aria-label="Text input with checkbox">

                                        </div>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Save</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
