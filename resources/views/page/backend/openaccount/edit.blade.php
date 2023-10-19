<div class="modal-dialog modal-x">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('openaccount.edit', ['unique_key' => $datas->unique_key]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    
                    <div class="col-lg-12 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Date <span style="color: red;">*</span></label>
                            <input type="date" name="date" placeholder="" value="{{ $datas->date }}" required>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" id="amount" class="amount" value="{{ $datas->amount }}" placeholder="Enter Payable Amount">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" name="note" id="note" class="note" value="{{ $datas->note }}" placeholder="Enter Note">
                        </div>
                    </div>
                    <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
