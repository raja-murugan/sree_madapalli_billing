@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Add Outdoor</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('outdoor.store') }}" enctype="multipart/form-data">
                    @csrf


                  <div class="row">

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Bill No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="bill_no" placeholder="Enter Bill No" readonly value="{{$billno}}">
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Booking Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="booking_date" placeholder="" value="{{ $today }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Delivery Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="delivery_date" placeholder=""  required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Delivery Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="delivery_time" placeholder=""  required>
                            </div>
                        </div>

                  </div><br/>
                  <div class="row">

                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Name<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="name" placeholder="Enter Customer Name" >
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Address<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="address" placeholder="Enter Customer Address" >
                            </div>
                        </div>


                        <div class="col-lg-4 col-sm-4 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Phone No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="phone_number" placeholder="Enter Customer Phone No" >
                            </div>
                        </div>

                      
                        <div class="col-lg-12 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Note</label>
                                <input type="text" name="note" placeholder="Enter note" >
                            </div>
                        </div>


                      
                  </div>

                    <br /><br/>

                  <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="font-size:15px; width:20%;">Product</th>
                                        <th style="font-size:15px; width:25%;">Note</th>
                                        <th style="font-size:15px; width:10%;">Quantity</th>
                                        <th style="font-size:15px; width:15%;">Price / Qty</th>
                                        <th style="font-size:15px; width:20%;">Total</th>
                                        <th style="font-size:15px; width:10%;">Action </th>
                                    </tr>
                                </thead>
                                <tbody class="outdoor_fields">
                                    <tr>
                                       <td><input type="hidden"id="outdoor_detail_id"name="outdoor_detail_id[]" value=""/>
                                          <select class="form-control js-example-basic-single outdoorproduct_id select" name="outdoorproduct_id[]"
                                                id="outdoorproduct_id1"required>
                                                <option value="" selected hidden class="text-muted">Select Product
                                                </option>
                                                @foreach ($outdoorproduct as $outdoorproducts)
                                                    <option value="{{ $outdoorproducts->id }}">{{ $outdoorproducts->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                       </td>
                                       <td><textarea type="text" name="outdoornote[]" class="form-control" placeholder="Enter note" ></textarea></td>
                                       <td><input type="text" class="form-control outdoorquantity" id="outdoorquantity" name="outdoorquantity[]" placeholder="quantity" value="" required /></td>
                                        <td>
                                            <input type="text" class="form-control outdoorpriceperquantity" id="outdoorpriceperquantity" name="outdoorpriceperquantity[]" placeholder="note" value="" required />
                                        </td>
                                        <td><input type="text" class="form-control outdoorprice" id="outdoorprice" name="outdoorprice[]" placeholder="Price" value="" required /></td>
                                        <td>
                                            <button style="width: 35px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addoutdoorfields"
                                                type="button" id="" value="Add">+</button>
                                             <button style="width: 35px;" class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-danger remove-outdoortr" type="button" >-</button>
                                        </td>
                                    </tr>
                                    
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
                                             <option value="0">No Tax</option>
                                             <option value="3">GST - (3%)</option>
                                             <option value="8">GST - (8%)</option>
                                             <option value="12">GST - (12%)</option>
                                             <option value="18">GST - (18%)</option>
                                             <option value="28">GST - (28%)</option>
                                       </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payment Method<span
                                        style="color: red;">*</span></label>
                                 <select class="select bank_id" name="bank_id" id="bank_id" required>
                                    @foreach ($Bank as $banks)
                                       <option value="{{ $banks->id }}">{{ $banks->name }}</option>
                                    @endforeach
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
                                    <h5><span class="outdoorsubtotal">  </span></h5>
                                    <input type="hidden" class="form-control outdoorsub_total" name="outdoorsub_total" id="outdoorsub_total">
                                 </li>
                                 <li>
                                    <h4>Tax Amount </h4>
                                    <h5><span class="outdoortaxamount">  </span></h5>
                                    <input type="hidden" class="form-control outdoortax_amount" name="outdoortax_amount" id="outdoortax_amount">
                                 </li>
                                 <li class="total">
                                    <h4>Grand Total</h4>
                                    <h5><span class="outdoorgrandtotal">  </span></h5>
                                    <input type="hidden" class="form-control outdoor_grandtotal" name="outdoor_grandtotal" id="outdoor_grandtotal">
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <br /><br />


                     <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payment Term<span
                                        style="color: red;">*</span></label>
                                        <select class="select payment_term" name="payment_term" id="payment_term" >
                                             <option value="">Select</option>
                                             <option value="I">I</option>
                                             <option value="II">II</option>
                                             <option value="III">III</option>
                                       </select>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payable Amount<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="payment_amount" class="outdoor_payment_amount" placeholder="Enter Payable Amount"  style="background: #d1e9d0;">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Balance Amount<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="balanceamount" class="outdoorbalanceamount" placeholder=" Balance" readonly style="background: #e79fa6de;">
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
