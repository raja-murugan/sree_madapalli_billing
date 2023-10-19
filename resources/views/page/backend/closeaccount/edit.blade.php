<div class="modal-dialog modal-x">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myExtraLargeModalLabel">Update</h5>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="POST" action="{{ route('closeaccount.edit', ['unique_key' => $datas->unique_key]) }}" enctype="multipart/form-data">
                @csrf
                    
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
                            <input type="text" class="opening_balance" name="opening_balance" id="opening_balance" readonly value="{{$datas->opening_balance}}">
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Sales</label>
                            <input type="text" class="sales" name="sales" id="sales" required value="{{$datas->sales}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>QR Code</label>
                            <input type="text" class="qrcode" name="qrcode" id="qrcode" required value="{{$datas->qrcode}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>QPAY</label>
                            <input type="text" class="card" name="card" id="card" required value="{{$datas->card}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Cash In Hand</label>
                            <input type="text" class="cash_in_hand" name="cash_in_hand" id="cash_in_hand" required value="{{$datas->cash_in_hand}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Expense</label>
                            <input type="text" class="expense" name="expense" id="expense" required value="{{$datas->expense}}" readonly>
                         </div>
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                         <div class="form-group">
                            <label>Close Amount</label>
                            <input type="text" class="close_amount" name="close_amount" id="close_amount" required value="{{$datas->close_amount}}" readonly>
                         </div>
                      </div>
                   </div>
                    <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Update</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
            </form>
        </div>
    </div>
</div>
