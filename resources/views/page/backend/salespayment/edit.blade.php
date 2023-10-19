<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('salespayment.edit', ['unique_key' => $salepayment_datas['unique_key']]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Customer <span style="color: red;">*</span></label>
                              <select class="form-control  select salespaymentcustomer_id" name="customer_id" id="customer_id" required>
                                    <option value="" disabled selected hiddden>Select Customer</option>
                                    @foreach ($Customer as $Customers)
                                        <option value="{{ $Customers->id }}"@if ($Customers->id === $salepayment_datas['customer_id']) selected='selected' @endif>{{ $Customers->name }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Date <span style="color: red;">*</span></label>
                            <input type="date" name="date" placeholder="" value="{{ $salepayment_datas['saledate'] }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                            <label>Payable Amount</label>
                            <input type="text" name="paid_amount" id="paid_amount" class="salepaymentpaidamt" value="{{ $salepayment_datas['paid_amount'] }}" placeholder="Enter Payable Amount">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-6">
                        <div class="form-group">
                           <label>Delivery Plan <span style="color: red;">*</span></label>
                              <select class="form-control  select js-example-basic-single deliveryplan_id" name="deliveryplan_id" id="deliveryplanid">
                                    <option value="" disabled selected hiddden>Select Delivery Plan</option>
                                    @foreach ($deliveryplan as $deliveryplans)
                                        <option value="{{ $deliveryplans->id }}"@if ($deliveryplans->id === $salepayment_datas['deliveryplan_id']) selected='selected' @endif>{{ $deliveryplans->name }}</option>
                                    @endforeach 
                                </select>
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
