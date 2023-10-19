<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel{{ $datas['unique_key'] }}">Outdoor Details</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <div class="card">

       
            
                           <div class="invoice-item invoice-item-date card py-2 " style="background: #751818;">
                              <div class="row ">
                                 <div class="col-md-2">
                                    <p class="text-start invoice-details" style="color:white;margin-left: 10px;">
                                    Bill No<span>: </span><strong style="color:#debf39;"><br/># {{ $datas['bill_no'] }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-2">
                                    <p class="invoice-details" style="color:white;">
                                       Customer<span>: </span><strong style="color:#debf39;text-transform: uppercase;"><br/>{{ $datas['name'] }}<br/>{{ $datas['phone_number'] }}<br/>{{ $datas['address'] }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Booking Date<span>: </span><strong style="color:#debf39;"><br/>{{ date('d-m-Y', strtotime($datas['booking_date'])) }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-3">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Delivery Date<span>: </span><strong style="color:#debf39;"><br/>{{ date('d-m-Y', strtotime($datas['delivery_date'])) }} - {{ $datas['delivery_time'] }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-2">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Bank<span>: </span><strong style="color:#debf39;"><br/>{{ $datas['bank'] }}</strong>
                                    </p>
                                 </div>
                              </div>
                           </div>



               <div class="invoice-box " style="max-width: 1600px;width:100%;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                  
                     <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10 col-10  col-sm-11">
                           <div class="row">


                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Product</span>
                                       </div>
                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Quantity</span>
                                       </div>
                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Price / Count</span>
                                       </div>
                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Amount</span>
                                       </div>
                           </div>
                           <div class="row ">
                                 @foreach ($datas['terms'] as $index => $term_arr)
                                    @if ($term_arr['outdoor_id'] == $datas['id'])
                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; ">{{ $term_arr['product'] }}</span>
                                       </div>
                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; ">{{ $term_arr['quantity'] }}</span>
                                       </div>
                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; ">{{ $term_arr['price_per_quantity'] }}</span>
                                       </div>
                                       <div class="col-lg-3 col-sm-3 col-12 border">
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; ">{{ $term_arr['price'] }}</span>
                                       </div>
                                    @endif
                                 @endforeach
                           </div>
                        </div>
                        <div class="col-lg-1 col-1 col-sm-12"></div>

                     </div>

               </div>

               <div class="row">
                  <div class="col-lg-6  py-2">
                     <div class="total-order w-100 max-widthauto mb-4">
                     </div>
                  </div>
                  <div class="col-lg-6  py-2">
                     <div class="total-order w-100 max-widthauto mb-4">
                        <ul>
                           <li class="total">
                              <h4>Sub Total</h4>
                              <h5 class="">₹ <span  class="">{{ $datas['sub_total'] }}</span></h5>
                           </li>
                           <li class="total">
                              <h4>Tax Amount </h4>
                              <h5>₹ <span  class="">{{ $datas['outdoortax_amount'] }} ({{ $datas['outdoortax'] }}%)</span></h5>
                           </li>
                           <li class="total">
                              <h4>Total </h4>
                              <h5>₹ <span  class="">{{ $datas['total'] }}</span></h5>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
   
            </div>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


