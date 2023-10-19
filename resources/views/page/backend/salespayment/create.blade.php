<form autocomplete="off" method="POST" action="{{ route('salespayment.store') }}">
    @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Customer <span style="color: red;">*</span></label>
                              <select class="form-control  select js-example-basic-single salespaymentcustomer_id" name="customer_id" id="customer_id" required>
                                    <option value="" disabled selected hiddden>Select Customer</option>
                                    @foreach ($Customer as $Customers)
                                        <option value="{{ $Customers->id }}">{{ $Customers->name }}</option>
                                    @endforeach 
                                </select>
                        </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                           <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $today }}" required>
                            </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Old Balance</label>
                            <input type="text" class="saleoldbalance" name="saleoldbalance" id="saleoldbalance" placeholder="" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Payable Amount</label>
                            <input type="text" name="paid_amount" id="paid_amount" class="salepaymentpaidamt" placeholder="Enter Payable Amount">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label> Balance</label>
                            <input type="text" name="salebalance" id="salebalance" class="salepaymentbal" placeholder="" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Delivery Plan <span style="color: red;">*</span></label>
                              <select class="form-control  select js-example-basic-single deliveryplan_id" name="deliveryplan_id" id="deliveryplanid">
                                    <option value="" disabled selected hiddden>Select Delivery Plan</option>
                                    @foreach ($deliveryplan as $deliveryplans)
                                        <option value="{{ $deliveryplans->id }}">{{ $deliveryplans->name }}</option>
                                    @endforeach 
                                </select>
                        </div>
                      </div>
                   </div>
                   <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit">Save</button>
                    </div>
             </div>
          </div>
       </div>
    </form>