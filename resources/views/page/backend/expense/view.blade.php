<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel{{ $datas['unique_key'] }}">Expense</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <div class="card">

       
            
                           <div class="invoice-item invoice-item-date card py-2 " style="background: #751818;">
                              <div class="row ">
                                 
                                 <div class="col-md-6">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Date<span>: </span><strong style="color:white;">{{ date('d-m-Y', strtotime($datas['date'])) }}</strong>
                                    </p>
                                 </div>
                                 <div class="col-md-6">
                                    <p class="text-start invoice-details" style="color:white;">
                                       Bank<span>: </span><strong style="color:white;">{{ $datas['bank'] }}</strong>
                                    </p>
                                 </div>
                              </div>
                           </div>



               <div class="invoice-box " style="max-width: 1600px;width:100%;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                  
                     <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-10 col-10  col-sm-11">
                           <div class="row">


                                       <div class="col-lg-6 col-sm-6 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Note</span>
                                       </div>
                                       <div class="col-lg-6 col-sm-6 col-12 border">
                                          <span class="" style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 700;line-height: 35px; ">Amount</span>
                                       </div>
                           </div>
                           <div class="row ">
                                 @foreach ($datas['terms'] as $index => $term_arr)
                                    @if ($term_arr['expense_id'] == $datas['id'])
                                       <div class="col-lg-6 col-sm-6 col-12 border">
                                          <span class=""style="vertical-align: inherit;vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;line-height: 35px; ">{{ $term_arr['note'] }}</span>
                                       </div>
                                       <div class="col-lg-6 col-sm-6 col-12 border">
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
                        <ul>
                           <li class="total">
                              <h4>Total</h4>
                              <h5 class="">₹ <span  class="">{{ $datas['total_price'] }}</span></h5>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
   
            </div>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->


