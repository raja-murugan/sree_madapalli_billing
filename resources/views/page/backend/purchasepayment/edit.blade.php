<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('purchasepayment.edit', ['unique_key' => $purchasepayment_datas['unique_key']]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Supplier <span style="color: red;">*</span></label>
                              <select class="form-control  select purchasepaymentsupplier" name="supplier_id" id="supplier_id" required>
                                    <option value="" disabled selected hiddden>Select Supplier</option>
                                    @foreach ($Supplier as $Suppliers)
                                        <option value="{{ $Suppliers->id }}"@if ($Suppliers->id === $purchasepayment_datas['supplier_id']) selected='selected' @endif>{{ $Suppliers->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Date <span style="color: red;">*</span></label>
                            <input type="date" name="date" placeholder="" value="{{ $purchasepayment_datas['purchasedate'] }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Payable Amount</label>
                            <input type="text" name="paid_amount" id="paid_amount" class="purcahsepaymentpaidamt" value="{{ $purchasepayment_datas['paid_amount'] }}" placeholder="Enter Payable Amount">
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
