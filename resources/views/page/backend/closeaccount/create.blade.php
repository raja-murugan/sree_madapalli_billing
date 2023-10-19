<form autocomplete="off" method="POST" action="{{ route('closeaccount.store') }}">
    @csrf
       <div class="card">
          <div class="card-body">
             <div class="form-group-item">

                   
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
                            <label>Opening Balance</label>
                            <input type="text" class="opening_balance" name="opening_balance" id="opening_balance" readonly value="{{$openaccountamount}}">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Sales</label>
                            <input type="text" class="sales" name="sales" id="sales" required value="{{$saletotalamount}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>QR Code</label>
                            <input type="text" class="qrcode" name="qrcode" id="qrcode" required value="{{$saleqrcodetotalamount}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>QPAY</label>
                            <input type="text" class="card" name="card" id="card" required value="{{$salegpaytotalamount}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Cash In Hand</label>
                            <input type="text" class="cash_in_hand" name="cash_in_hand" id="cash_in_hand" required value="{{$salecashtotalamount}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Expense</label>
                            <input type="text" class="expense" name="expense" id="expense" required value="{{$expenseamount}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Close Amount</label>
                            <input type="text" class="close_amount" name="close_amount" id="close_amount" required value="{{$closeamounttotal}}" readonly>
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