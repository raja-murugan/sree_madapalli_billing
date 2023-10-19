<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="purchaseorderviewLargeModalLabel{{ $datas['unique_key'] }}">Pay Balance</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            

       
            <form autocomplete="off" method="POST" action="{{ route('outdoor.pay_balance', ['unique_key' => $datas['unique_key']]) }}">
                     @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Customer </label>
                                <input type="text" name="name" placeholder="Enter Customer name" readonly value="{{ $datas['name']  }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Phone Number </label>
                                <input type="text" name="name"  readonly value="{{ $datas['phone_number']  }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input type="text" name="outdoortotal_amt" class="outdoortotal_amt" readonly value="{{ $datas['total']  }}" style="background: #f8f9fa;color: #2ac368;" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label>Total Paid</label>
                                <input type="text" name="outdoortotal_paid" class="outdoortotal_paid{{ $datas['id'] }}" readonly value="{{ $datas['payment_amount']  }}" style="background: #f8f9fa;color: #8f7320;" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label>Balace Amount</label>
                                <input type="text" name="outdoortotal_bal" class="outdoortotal_bal{{ $datas['id'] }}" readonly value="{{ $datas['balanceamount']  }}" style="background: #f8f9fa;color: #c32a2a;" >
                            </div>
                        </div>
                    </div>



                    <div class="row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-4 col-form-label">
                            Paid Amounts </label>
                        <div class="col-sm-8 row">


                            @foreach ($datas['payments_terms'] as $index => $term_arr)
                                @if ($term_arr['outdoor_id'] == $datas['id'])
                                    <span class="col-sm-4">
                                        <input type="text" style="background: #e0ddeb;" class="form-control term"
                                            disabled id="term" value="{{ $term_arr['payment_date'] }}">
                                    </span>
                                    <span class="col-sm-4">
                                        <input type="text" disabled style="background: #e0ddeb;"
                                            class="form-control " id=""
                                            value="{{ $term_arr['payment_term'] }}">
                                    </span>
                                    <span class="col-sm-4">
                                        <input type="text" disabled style="background: #e0ddeb;"
                                            class="form-control paymentmethod" id="paymentmethod"
                                            value="{{ $term_arr['payment_amount'] }}">
                                    </span>
                                @endif
                            @endforeach


                        </div>
                    </div>
                     
                    

                    <script> 
                    $(document).ready(function() {
                        $('.paybalance' + {{ $datas['id'] }}).each(function() {
                            $(this).on('click', function(e) {
                                
                                e.preventDefault();
                                var $this = $(this),
                                outdoor_id = $this.attr('data-id');
                                //alert(booking_id);


                                $(document).on("keyup", '#outdoorpayment_amount' + {{ $datas['id'] }}, function() {
                                    var payable_amount = $(this).val();
                                    
                                    var balance_amount = $('.outdoortotal_bal' + {{ $datas['id'] }}).val();
                                    console.log(balance_amount);

                                    if (Number(payable_amount) > Number(balance_amount)) {
                                        alert('You are entering Maximum Amount of Balance');
                                        $('#outdoorpayment_amount' + {{ $datas['id'] }}).val('');
                                    }
                                });
                            });
                        });
                    });
                </script>

                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payment Date <span style="color: red;">*</span></label>
                                <input type="date" name="payment_date" placeholder="" value="{{ $today }}" required>
                            </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Term</label>
                            <select class="select payment_term form-control" name="payment_term" id="payment_term" required>
                                             <option value="">Select</option>
                                             <option value="I">I</option>
                                             <option value="II">II</option>
                                             <option value="III">III</option>
                                       </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                           <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payable Amount<span style="color: red;">*</span></label>
                           <input type="text" class="outdoorpayment_amount{{ $datas['id'] }}" id="outdoorpayment_amount{{ $datas['id'] }}" name="payment_amount"  placeholder="Enter Payable Amount"  >
                        </div>
                     </div>
                     <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="select bank_id form-control" name="bank_id" id="bank_id" required>
                                    @foreach ($Bank as $banks)
                                       <option value="{{ $banks->id }}">{{ $banks->name }}</option>
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


