<div class="modal-dialog modal-x">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel{{ $datas['unique_key'] }}">Delivery Update</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            

       
            <form autocomplete="off" method="POST" action="{{ route('sales.deliveryupdate', ['unique_key' => $datas['unique_key']]) }}">
                     @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Customer </label>
                                <input type="text" name="name" placeholder="Enter Customer name" readonly value="{{ $datas['customer']  }}">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Payment Method </label>
                                    <div style="display: flex">
                                          @foreach ($Bank as $Banks)
                                             <div class="input-group" style="margin-right: 5px;">
                                                <div class="input-group-text">
                                                   <input class="form-check-input" type="radio" value="{{ $Banks->name }}" id ="payment_method" name="payment_method"
                                                   aria-label="Radio button for following text input">
                                                </div>
                                                <input type="text" class="form-control" value="{{ $Banks->name }}" disabled aria-label="Text input with radio button">
                                             </div>
                                          @endforeach
                                    </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Delivery Boy</label>
                                <select class="form-control js-example-basic-single select deliveryboy_id" name="deliveryboy_id" id="deliveryboy_id">
                                    <option value="" disabled selected hiddden>Select Delivery Boy</option>
                                       @foreach ($Deliveryboy as $Deliveryboys)
                                       <option value="{{ $Deliveryboys->id }}">{{ $Deliveryboys->name }}</option>
                                       @endforeach
                                 </select>
                            </div>
                        </div>
                    </div>

                    



                 
                     <hr>
                    <div class="col-lg-12 button-align">
                        <button type="submit" class="btn btn-submit me-2">Save</button>
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal"
                            aria-label="Close">Cancel</button>
                    </div>
            </form>
   
            

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


