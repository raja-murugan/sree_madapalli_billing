@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Update Outdoor</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
               <form autocomplete="off" method="POST" action="{{ route('outdoor.update', ['unique_key' => $Outdoor->unique_key]) }}" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf


                  <div class="row">

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Bill No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="bill_no" placeholder="Enter Bill No" readonly value="{{$Outdoor->bill_no}}">
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Booking Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="booking_date" placeholder="" value="{{ $Outdoor->booking_date }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Delivery Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="delivery_date" placeholder="" value="{{ $Outdoor->delivery_date }}"  required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Delivery Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="delivery_time" placeholder="" value="{{ $Outdoor->delivery_time }}" required>
                            </div>
                        </div>

                  </div><br/>
                  <div class="row">

                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Name<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="name" placeholder="Enter Customer Name" value="{{ $Outdoor->name }}">
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Address<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="address" placeholder="Enter Customer Address" value="{{ $Outdoor->address }}">
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Phone No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="phone_number" placeholder="Enter Customer Phone No" value="{{ $Outdoor->phone_number }}">
                            </div>
                        </div>

                      
                        <div class="col-lg-12 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Note</label>
                                <input type="text" name="note" placeholder="Enter note" value="{{ $Outdoor->note }}">
                            </div>
                        </div>


                      
                  </div>

                    <br /><br/>

                  <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="font-size:15px; width:30%;">Product</th>
                                        <th style="font-size:15px; width:20%;">Quantity</th>
                                        <th style="font-size:15px; width:20%;">Price / Qty</th>
                                        <th style="font-size:15px; width:20%;">Total</th>
                                        <th style="font-size:15px; width:10%;">Action </th>
                                    </tr>
                                </thead>
                                <tbody class="outdoor_fields">
                                @foreach ($Outdoordata as $index => $Outdoordatas)
                                    <tr>
                                       <td><input type="hidden"id="outdoor_detail_id"name="outdoor_detail_id[]" value="{{ $Outdoordatas->id }}"/>
                                       <select class="form-control js-example-basic-single outdoorproduct_id select" name="outdoorproduct_id[]"
                                                id="outdoorproduct_id1"required>
                                                <option value="" selected hidden class="text-muted">Select Product
                                                </option>
                                                @foreach ($outdoorproduct as $outdoorproducts)
                                                    <option value="{{ $outdoorproducts->id }}"@if ($outdoorproducts->id === $Outdoordatas->product) selected='selected' @endif>{{ $outdoorproducts->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                       </td>
                                       <td><textarea type="text" name="outdoornote[]" class="form-control" placeholder="Enter note" >{{ $Outdoordatas->outdoornote }}</textarea></td>
                                       <td><input type="text" class="form-control outdoorquantity" id="outdoorquantity" name="outdoorquantity[]" placeholder="quantity" value="{{ $Outdoordatas->quantity }}" required /></td>
                                        <td>
                                            <input type="text" class="form-control outdoorpriceperquantity" id="outdoorpriceperquantity" name="outdoorpriceperquantity[]" placeholder="note" value="{{ $Outdoordatas->price_per_quantity }}" required />
                                        </td>
                                        <td><input type="text" class="form-control outdoorprice" id="outdoorprice" name="outdoorprice[]" placeholder="Price" value="{{ $Outdoordatas->price }}" required /></td>
                                        <td>
                                            <button style="width: 35px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addoutdoorfields"
                                                type="button" id="" value="Add">+</button>
                                             <button style="width: 35px;" class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-danger remove-outdoortr" type="button" >-</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <br />



                  <div class="row">
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Tax<span
                                        style="color: red;">*</span></label>
                                       <select class="select outdoortax" name="outdoortax" id="outdoortax" required>
                                             <option value="0"@if ('0' === $Outdoor->outdoortax) selected='selected' @endif>No Tax</option>
                                             <option value="3"@if ('3' === $Outdoor->outdoortax) selected='selected' @endif>GST - (3%)</option>
                                             <option value="8"@if ('8' === $Outdoor->outdoortax) selected='selected' @endif>GST - (8%)</option>
                                             <option value="12"@if ('12' === $Outdoor->outdoortax) selected='selected' @endif>GST - (12%)</option>
                                             <option value="18"@if ('18' === $Outdoor->outdoortax) selected='selected' @endif>GST - (18%)</option>
                                             <option value="28"@if ('28' === $Outdoor->outdoortax) selected='selected' @endif>GST - (28%)</option>
                                       </select>
                            </div>
                        </div>
                  </div>

                  <br /><br />


                  <div class="row">
                        <div class="col-lg-12 float-md-right">
                           <div class="total-order">
                              <ul>
                                 <li>
                                    <h4>Gross Amount</h4>
                                    <h5><span class="outdoorsubtotal"> ₹  {{ $Outdoor->sub_total }} </span></h5>
                                    <input type="hidden" class="form-control outdoorsub_total" name="outdoorsub_total" id="outdoorsub_total" value="{{ $Outdoor->sub_total }}">
                                 </li>
                                 <li>
                                    <h4>Tax Amount </h4>
                                    <h5><span class="outdoortaxamount">  ₹  {{ $Outdoor->outdoortax_amount }}</span></h5>
                                    <input type="hidden" class="form-control outdoortax_amount" name="outdoortax_amount" id="outdoortax_amount" value="{{ $Outdoor->outdoortax_amount }}">
                                 </li>
                                 <li class="total">
                                    <h4>Grand Total</h4>
                                    <h5><span class="outdoorgrandtotal"> ₹  {{ $Outdoor->total }} </span></h5>
                                    <input type="hidden" class="form-control outdoor_grandtotal" name="outdoor_grandtotal" id="outdooredit_grandtotal" value="{{ $Outdoor->total }}">
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <br /><br />



                     <div class="row mb-4">
                                                        <label for="horizontal-firstname-input"
                                                            class="col-sm-3 col-form-label">
                                                            Paid Amounts </label>
                                                        <div class="col-sm-9">
                                                            <table class="table-fixed col-12 " id="">
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Terms</th>
                                                                    <th>Amount</th>
                                                                    <th>Payment Mehod</th>
                                                                </tr>
                                                                @foreach ($OutdoorPayments as $index => $OutdoorPayments_arr)
                                                                    <script>
                                                                        $(document).on("keyup", '.outdooreditpayment_amount' + {{ $OutdoorPayments_arr->id }}, function() {
                                                                            var payableamount = $(this).val();
                                                                            var totalAmount = 0;
                                                                            $("input[name='outdooreditpayment_amount[]']").each(function() {
                                                                                //alert($(this).val());
                                                                                totalAmount = Number(totalAmount) + Number($(this).val());
                                                                                $('.outdoor_totalpaid').val(totalAmount);

                                                                                var outdooredit_grandtotal = $("#outdooredit_grandtotal").val();
                                                                                var balance_amount = Number(outdooredit_grandtotal) - Number(totalAmount);
                                                                                $('.outdoorbalaeamount').val(balance_amount.toFixed(2));

                                                                                if (Number(totalAmount) > Number(outdooredit_grandtotal)) {
                                                                                    alert('!Paid Amount is More than of Total!');
                                                                                    $('.outdooreditpayment_amount' + {{ $OutdoorPayments_arr->id }}).val('');
                                                                                }
                                                                            });
                                                                        });


                                                                       
                                                                    </script>

                                                                    <tr>
                                                                        <td class="col-sm-3"><input type="date" name="payment_date[]" class="form-control" placeholder="" value="{{ $OutdoorPayments_arr->payment_date }}"></td>
                                                                        <td class="col-sm-3">
                                                                            <select class="form-control" name="payment_term[]">
                                                                                <option value="" selected class="text-muted">Terms</option>
                                                                                <option value="I"{{ $OutdoorPayments_arr->payment_term == 'I' ? 'selected' : '' }} class="text-muted">Term I</option>
                                                                                <option value="II"{{ $OutdoorPayments_arr->payment_term == 'II' ? 'selected' : '' }}  class="text-muted">Term II</option>
                                                                                <option  value="III"{{ $OutdoorPayments_arr->payment_term == 'III' ? 'selected' : '' }} class="text-muted">Term III</option>
                                                                            </select>
                                                                        </td>
                                                                        <td class="col-sm-3">

                                                                            <input type="text" class="form-control outdooreditpayment_amount{{ $OutdoorPayments_arr->id }}"
                                                                                id="outdooreditpayment_amount" value="{{ $OutdoorPayments_arr->payment_amount }}"
                                                                                name="outdooreditpayment_amount[]" placeholder="Enter here ">

                                                                            <input type="hidden" class="form-control outdoor_payment_id" value="{{ $OutdoorPayments_arr->id }}"
                                                                                name="outdoor_payment_id[]" placeholder="Enter here ">
                                                                        </td>
                                                                        <td class="col-sm-3">
                                                                        <select class=" form-control bank_id" name="bank_id[]" id="bank_id" required>
                                                                            @foreach ($Bank as $banks)
                                                                            <option value="{{ $banks->id }}"@if ($banks->id === $OutdoorPayments_arr->payment_method) selected='selected' @endif>{{ $banks->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        </div>


                                                    </div>


                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Total Paid<span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="outdoor_totalpaid" class="outdoor_totalpaid" readonly value="{{ $Outdoor->payment_amount }}" placeholder=" Total Paid">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Balance Amount<span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="outdoorbalaeamount" class="outdoorbalaeamount" value="{{ $Outdoor->balanceamount }}" placeholder=" Balance" readonly>
                                </div>
                            </div>
                     </div>
                   



                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" onclick="outdoorsubmitForm(this);" />
                        <a href="{{ route('outdoor.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
