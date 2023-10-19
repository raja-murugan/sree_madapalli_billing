@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Add Purchase</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('purchase.store') }}" enctype="multipart/form-data">
                    @csrf


                  <div class="row">



                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Bill No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="bill_no" placeholder="Enter Bill No" value="{{$billno}}">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Voucher No<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="voucher_no" placeholder="Enter Voucher No" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $today }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $timenow }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Supplier<span
                                        style="color: red;">*</span> </label>
                                <select class="form-control js-example-basic-single select" name="supplier_id" id="supplier_id" required>
                                    <option value="" disabled selected hiddden>Select Supplier</option>
                                    @foreach ($Supplier as $suppliers)
                                        <option value="{{ $suppliers->id }}">{{ $suppliers->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        
                  </div>

                    <br />

                  <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead>
                                    <tr style="background: #f8f9fa;">
                                        <th style="font-size:15px; width:30%;">Product</th>
                                        <th style="font-size:15px; width:20%;">Quantity</th>
                                        <th style="font-size:15px; width:20%;">Rate / Quantity </th>
                                        <th style="font-size:15px; width:20%;">Total </th>
                                        <th style="font-size:15px; width:10%;">Action </th>
                                    </tr>
                                </thead>
                                <tbody class="product_fields">
                                    <tr>
                                        <td style="background: #eee;">
                                            <input type="hidden"id="purchase_detail_id"name="purchase_detail_id[]" />
                                            <select class="form-control js-example-basic-single purchaseproduct_id select" name="purchaseproduct_id[]"
                                                id="purchaseproduct_id1"required>
                                                <option value="" selected hidden class="text-muted">Select Product
                                                </option>
                                                @foreach ($purchaseproduct as $productlists)
                                                    <option value="{{ $productlists->id }}">{{ $productlists->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td style="background: #eee;">
                                            <input type="text" class="form-control purchase_quantity" id="quantity" name="purchase_quantity[]"
                                                placeholder="Quantity" value="" required />
                                        </td>
                                        <td style="background: #eee;">
                                            <input type="text" class="form-control purchase_price" id="price" name="purchase_price[]"
                                                placeholder="Price" value="" required />
                                        </td>
                                        <td style="background: #eee;">
                                            <input type="text" class="form-control total_price" id="total_price" name="total_price[]"
                                                placeholder="" value="" readonly />
                                        </td>
                                        <td style="background: #eee;">
                                            <button style="width: 35px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addproductfields"
                                                type="button" id="" value="Add">+</button>
                                             <button style="width: 35px;" class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-danger remove-purchasetr" type="button" >-</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <br /><br /><br />

                  <div class="row">
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Tax<span
                                        style="color: red;">*</span></label>
                                       <select class="select tax" name="tax" id="tax" required>
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
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Discount Type<span
                                        style="color: red;">*</span></label>
                                  <select class="select discount_type" name="discount_type" id="discount_type" required>
                                       <option value="none">Select</option>
                                       <option value="percentage">Percentage(%)</option>
                                       <option value="fixed">Fixed</option>
                                 </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Discount<span
                                        style="color: red;">*</span></label>
                                <input type="text" id="discount" name="discount" class="discount" placeholder="Enter Discount" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payment Method<span
                                        style="color: red;">*</span></label>
                                 <select class="select payment_method" name="payment_method" id="payment_method" required>
                                    @foreach ($bank as $banks)
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
                                    <h5><span class="subtotal">  </span></h5>
                                    <input type="hidden" class="form-control sub_total" name="sub_total" id="sub_total">
                                 </li>
                                 <li>
                                    <h4>Tax Amount </h4>
                                    <h5><span class="taxamount">  </span></h5>
                                    <input type="hidden" class="form-control tax_amount" name="tax_amount" id="tax_amount">
                                 </li>
                                 <li>
                                    <h4>Total</h4>
                                    <h5><span class="totalamount">  </span></h5>
                                    <input type="hidden" class="form-control total" name="total" id="total">
                                 </li>
                                 <li>
                                    <h4>Discount</h4>
                                    <h5><span class="discountprice">  </span></h5>
                                    <input type="hidden" class="form-control discount_price" name="discount_price" id="discount_price">
                                 </li>
                                 <li class="total">
                                    <h4>Grand Total</h4>
                                    <h5><span class="purchasegrand_total">  </span></h5>
                                    <input type="hidden" class="form-control purchase_grandtotal" name="purchase_grandtotal" id="purchase_grandtotal">
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <br /><br />


                     <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Payable Amount<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="paidamount" class="paidamount" placeholder="Enter Payable Amount" required style="background: #d1e9d0;">
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Balance Amount<span
                                        style="color: red;">*</span></label>
                                <input type="text" name="balanceamount" class="balanceamount" placeholder="Enter Payable Amount" readonly style="background: #e79fa6de;">
                            </div>
                        </div>
                     </div>


                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" onclick="purchasesubmitForm(this);" />
                        <a href="{{ route('purchase.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
