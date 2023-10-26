@extends('layout.backend.noside-auth')

@section('content')
    <div class="page-wrapper ms-0">
        <div class="content">
            <form name="sales_update" id="sales_update" method="post" action="javascript:void(0)">
            @method('PUT')
               @csrf
                <div class="row">


                <style>
                    .alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #04AA6D;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
                </style>
                <div class="col-lg-9 col-sm-12">
                <div class="alert-success" style="display:none;">
                    <span class="closebtn">&times;</span>  
                    <strong>Success!</strong> Indicates a successful or positive action.
                </div>
                </div>
                <div class="col-lg-3 col-sm-12">
                
                </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-sm-12 tabs_wrapper">
                        <div class="page-header ">
                            <div class="page-title">
                                <h4>Categories</h4>
                                <h6>Manage your purchases</h6>
                            </div>
                        </div>
                        <div class="tabs-sets">
                            <ul class="nav nav-tabs " id="myTabs" role="tablist">
                                @foreach ($session as $keydata => $sessions)
                                    <li class="nav-item sessionclass" role="presentation" data-sesion_id="{{ $sessions->id }}">
                                        <button class="nav-link @if ($keydata == 0) active @endif"
                                            id="purchase{{ $sessions->id }}-tab" data-bs-toggle="tab"
                                            onclick="sessiontype({{ $sessions->id }})"
                                            data-bs-target="#purchase{{ $sessions->id }}" type="button"
                                            aria-controls="purchase{{ $sessions->id }}" aria-selected="true" 
                                            role="tab">{{ $sessions->name }}</button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>



                        <div class="tab-content" id="myTabContent">


                            @foreach ($session as $index => $session_ss)
                                <div class="tab-pane fade show @if ($session_ss->id == 1) active @endif "
                                    id="purchase{{ $session_ss->id }}" role="tabpanel"
                                    aria-labelledby="purchase{{ $session_ss->id }}-tab">
                                    <ul class=" tabs owl-carousel owl-theme owl-product  border-0 ">
                                        @foreach ($cat_Productsession as $keydata => $cat_Productsessions)
                                            @if ($cat_Productsessions['session_id'] == $session_ss->id)
                                                <li class="@if ($keydata == 0) active @endif  category_type "
                                                    id="fruits{{ $cat_Productsessions['category_id'] }}" data-cat_id="{{ $cat_Productsessions['category_id'] }}" data-session_id="{{ $session_ss->id }}">
                                                    <div class="product-details ">
                                                        <img src="{{ asset('assets/backend/img/product/product63.png') }}"
                                                            alt="img">
                                                        <h6>{{ $cat_Productsessions['category_name'] }}</h6>
                                                        <input type="hidden" name="product_catid" id="product_catid" value="{{ $cat_Productsessions['category_id'] }}" />
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>


                        <div class="tabs_container">
                            @foreach ($category as $index => $categories)
                                <div class="tab_content @if ($index == 0) active @endif"
                                    data-tab="fruits{{ $categories->id }}">
                                    
                                    <div class="row prodcttsdiv" >
                                    @foreach ($produc_session_arr as $key => $produc_session_array)
                                                @if ($produc_session_array['category_id'] == $categories->id)

                                                
                                                    <div class="col-lg-3 col-sm-6 d-flex  ">
                                                        <div class="productset flex-fill" style="border: 1px solid #afbcc6;">
                                                            <div class="productsetimg" style="height:110px;">
                                                                <img src="{{ asset('assets/product/' . $produc_session_array['productimage']) }}"
                                                                    alt="img">
                                                            </div>

                                                            <div class="productsetcontent">
                                                                <h4>{{ $produc_session_array['productname'] }}</h4>
                                                                <div style="display: flex">
                                                                    <h6 class="pos-price">₹ {{ $produc_session_array['productprice'] }}.00</h6>
                                                                    <div class="increment-decrement"
                                                                        style="margin-left:31%;margin-bottom:10px;" hidden>
                                                                        <div class="input-groups">
                                                                            <input type="button" value="-"
                                                                                class="button-minus dec button">
                                                                            <input type="text"
                                                                                name="child{{ $produc_session_array['product_id'] }}" value="1"
                                                                                class="quantity-field child{{ $produc_session_array['product_id'] }}">
                                                                            <input type="button" value="+"
                                                                                class="button-plus inc button ">
                                                                        </div>
                                                                    </div>

                                                                    <h6><input type="button" name="add_to_cart"
                                                                            class="btn btn-scanner-set selectproduct addedproduct{{ $produc_session_array['id'] }}"
                                                                            data-product_id="{{ $produc_session_array['product_id'] }}"
                                                                            data-productsession_id="{{ $produc_session_array['id'] }}"
                                                                            data-session_id="{{ $produc_session_array['session_id'] }}"
                                                                            data-product_price="{{ $produc_session_array['productprice'] }}"
                                                                            id="addedproduct{{ $produc_session_array['id'] }}"
                                                                            style="background: #7367f0;font-size: 14px;font-weight: 700;color: #fff;"
                                                                            value="Add to cart" />
                                                                            <input type="button" value="Add to cart" style="display:none;" class="btn btn-scanner-set clickquantity{{ $produc_session_array['id'] }}  rise_quantity" onClick="increment_quantity({{ $produc_session_array['id'] }})"> </h6>
                                                                    <input type="hidden" name="singlequantity" id="singlequantity{{ $produc_session_array['product_id'] }}" class="form-control" value="1" />
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                @endif
                                            @endforeach
                                        </div>
                                    
                                    

                                    
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-12 ">
                        <div class="order-list">
                            <div class="orderid">
                                <h4>Order List  #{{$latestbillno}}</h4> 
                                <h5>Date : {{$SaleData->date}}</h5>
                            </div>
                            <div class="orderid">
                                <h5>
                                    <p class="">{{$SaleData->time}}</p>
                                </h5>
                                <input type="hidden" name="date" id="date" class="" value="{{$SaleData->date}}" />
                                <input type="hidden" name="time" id="time" class="" value="{{$SaleData->time}}" />
                            </div>
                        </div>
                        <div class="card card-order">
                            <div class="card-body">



                                 <div class="setvaluecash">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="select-split ">
                                                <div class="select-group w-100">
                                                <label>Session</label>
                                                    <div style="display: flex">
                                                        @foreach ($session as $session_ids)
                                                        <div class="input-group" style="margin-right: 5px;">
                                                            <div class="input-group-text">
                                                                <input class="form-check-input" type="radio" value="{{ $session_ids->id }}" id ="session_ids" name="session_ids"
                                                                    aria-label="Radio button for following text input" @if ($session_ids->id === $SaleData->session_id) checked='checked' @endif>
                                                            </div>
                                                            <input type="text" class="form-control" value="{{ $session_ids->name }}" disabled
                                                                aria-label="Text input with radio button">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>






                                <div class="row" hidden>
                                    <div class="col-lg-12">
                                        <div class="select-split ">
                                            <div class="select-group w-100">
                                                <div style="display: flex">
                                                    <div class="input-group" style="margin-right: 5px;">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input" type="radio" value="Delivery" id ="sales_type" name="sales_type"
                                                                aria-label="Radio button for following text input" {{ $SaleData->sales_type == 'Delivery' ? 'checked' : '' }}>
                                                        </div>
                                                        <input type="text" class="form-control" value="Delivery" disabled
                                                            aria-label="Text input with radio button">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="select-split ">
                                            <div class="select-group w-100">
                                            <label>Customer</label>
                                                <select class="form-control js-example-basic-single select salepaymentpaid_customerid" name="customer_id" id="customer_id" required>
                                                    <option value="" disabled selected hiddden>Select Customer</option>
                                                    @foreach ($customer_rray as $customers)
                                                        <option value="{{ $customers->id }}"@if ($customers->id == $SaleData->customer_id) selected='selected' @endif>{{ $customers->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="totalitem">
                                    <h4>Total items : <span class="total_count"></span></h4>
                                    <a class="remove-ultr" hidden>Clear all</a>
                                </div>
                                <div class="product-table">
                                @foreach ($SaleProducts_arrdata as $keydata => $SaleProducts_data)
                                    <ul class="product-lists" id="productlist">
                                       <li>
                                          <div class="productimg">
                                             <div class="productimgs">
                                                <img src="{{ asset('assets/product/' .$SaleProducts_data['image']) }}" alt="img">
                                             </div>
                                             <div class="productcontet">
                                                <h4>{{$SaleProducts_data['product']}}
                                                </h4>
                                                <div class="productlinkset">
                                                   <h5>{{$SaleProducts_data['category']}}
                                                   <input type="hidden"  name="product_id[]"  value="{{$SaleProducts_data['product_id']}}"/>
                                                   <input type="hidden" class="li_productid" id="li_productid"  value="{{$SaleProducts_data['product_session_id']}}"/>
                                                   <input type="hidden" class="product_session_id" id="product_session_id"  value="{{$SaleProducts_data['product_session_id']}}"/>
                                                   <input type="hidden" name="saleproductsid[]" class="saleproductsid" id="saleproductsid" value="{{$SaleProducts_data['id']}}"/>
                                                   </h5>
                                                </div>
                                                <div class="increment-decrement">
                                                   <div class="input-groups">
                                                      <input type="button" value="-" class="  button" onClick="decrement_quantity({{$SaleProducts_data['product_session_id']}})">
                                                      <input type="text" name="product_quantity[]" value="{{$SaleProducts_data['quantity']}}" class="quantity-field product_quanitity" id="product_quantity{{$SaleProducts_data['product_session_id']}}">
                                                      <input type="button" value="+" class="  button " onClick="increment_quantity({{$SaleProducts_data['product_session_id']}})">
                                                      <input type="hidden" name="product_price[]" class="product_price" id="product_price{{$SaleProducts_data['product_session_id']}}"  value="{{$SaleProducts_data['price']}}"/>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </li>
                                       
                                       <input type="hidden" name="total_price[]" class="total_price{{$SaleProducts_data['product_session_id']}}" value="{{$SaleProducts_data['total_price']}}"/>
                                       <input type="hidden" name="product_session_id[]" class="product_session_id" value="{{$SaleProducts_data['product_session_id']}}"/>
                                       <li><span class="totalprice{{$SaleProducts_data['product_session_id']}}">{{$SaleProducts_data['total_price']}}</span></li>
                                       <li><a class="confirm-text" href="javascript:void(0);"><a class="confirm-text remove-tr"><img src="{{ asset('assets/backend/img/icons/delete-2.svg') }}"alt="img"></a></li>
                                    </ul>
                                    @endforeach
                                </div>
                            </div>
                            <div class="split-card">
                            </div>
                            <div class="card-body pt-0 pb-2">
                                <div class="setvalue">
                                    <ul>
                                        <li>
                                            <h5>Subtotal </h5>
                                            <h6 class="subtotalamount">{{$SaleData->sub_total}}</h6>
                                            <input type="hidden" name="subtotal" id="subtotal" value="{{$SaleData->sub_total}}" />
                                        </li>
                                        <li>
                                            <h5>Tax </h5>
                                            <h6>₹ 0</h6>
                                            <input type="hidden" name="taxamount" id="taxamount" value="0" />
                                        </li>
                                        <li class="total-value">
                                            <h5>Total </h5>
                                            <h6 class="subtotalamount">{{$SaleData->total}}</h6>
                                            <input type="hidden" name="totalamount" id="totalamount" class="sales_totamount" value="{{$SaleData->total}}" />
                                        </li>
                                    </ul>
                                </div>

                                <div class="setvaluecash">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="select-split ">
                                                <div class="select-group w-100">
                                                    <div style="display: flex">
                                                        @foreach ($Bank as $Banks)
                                                        <div class="input-group" style="margin-right: 5px;">
                                                            <div class="input-group-text">
                                                                <input class="form-check-input" type="radio" value="{{ $Banks->name }}" id ="paymentmethod" name="paymentmethod"
                                                                    aria-label="Radio button for following text input" required @if ($Banks->name === $SaleData->payment_method) checked='checked' @endif>
                                                            </div>
                                                            <input type="text" class="form-control" value="{{ $Banks->name }}" disabled
                                                                aria-label="Text input with radio button">
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-sm-12 col-12">
                                    <div class="form-group">
                                       <label>Delivery Boy</label>
                                       <select class="form-control js-example-basic-single select deliveryboy_id" name="deliveryboy_id" id="deliveryboy_id" required>
                                             <option value="" disabled selected hiddden>Select Delivery Boy</option>
                                                @foreach ($Deliveryboy as $Deliveryboys)
                                                <option value="{{ $Deliveryboys->id }}"@if ($Deliveryboys->id == $SaleData->deliveryboy_id) selected='selected' @endif>{{ $Deliveryboys->name }}</option>
                                                @endforeach
                                          </select>
                                    </div>
                                 </div>


                                <div class="form-group">
                                    <input type="text" placeholder="Enter Discount" class="sale_discount" name="sale_discount" id="sale_discount" value="{{$SaleData->sale_discount}}"/>
                                </div>


                                <div class="btn-totallabel">
                                    <button type="submit" class="btn btn-sm " id="submit"
                                        style="color:white; font-size:15px; display:contents;">Save<span class="grand_total"></span></button>
                                        <input type="hidden" name="grandtotal" class="grandtotal" id="grandtotal"/>
                                        <input type="hidden" name="saleid" class="saleid" id="saleid" value="{{$SaleData->id}}"/>
                                </div>
                                <div class="btn-pos">
                                    <ul>
                                        <li>
                                            <a class="btn" data-bs-toggle="modal" data-bs-target="#recents"><img
                                                    src="{{ asset('assets/backend/img/icons/transcation.svg') }}"
                                                    alt="img" class="me-1">
                                                Transaction</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="recents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recent Transactions</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="tabs-sets">
                        <ul class="nav nav-tabs" id="myTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab"
                                    data-bs-target="#purchase" type="button" aria-controls="purchase"
                                    aria-selected="true" role="tab">Dine In</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment"
                                    type="button" aria-controls="payment" aria-selected="false" role="tab">Take
                                    Away</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return"
                                    type="button" aria-controls="return" aria-selected="false"
                                    role="tab">Delivery</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                                aria-labelledby="purchase-tab">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img
                                                    src="{{ asset('assets/backend/img/icons/search-white.svg') }}"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Bill No</th>
                                                <th>Customer</th>
                                                <th>Amount </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($DineInoutput as $DineInoutputs)
                                            <tr>
                                                <td># {{ $DineInoutputs['bill_no'] }}</td>
                                                <td>Walk-in Customer</td>
                                                <td>₹ {{ $DineInoutputs['grandtotal'] }}</td>
                                            </tr>
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="payment" role="tabpanel">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img
                                                    src="{{ asset('assets/backend/img/icons/search-white.svg') }}"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Bill No</th>
                                                <th>Customer</th>
                                                <th>Amount </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($TakeAwayInoutput as $TakeAwayInoutputs)
                                            <tr>
                                                <td># {{ $TakeAwayInoutputs['bill_no'] }}</td>
                                                <td>Walk-out Customer</td>
                                                <td>₹ {{ $TakeAwayInoutputs['grandtotal'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="return" role="tabpanel">
                                <div class="table-top">
                                    <div class="search-set">
                                        <div class="search-input">
                                            <a class="btn btn-searchset"><img
                                                    src="{{ asset('assets/backend/img/icons/search-white.svg') }}"
                                                    alt="img"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table datanew">
                                        <thead>
                                            <tr>
                                                <th>Bill No</th>
                                                <th>Customer</th>
                                                <th>Amount </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($DeliveryInoutput as $DeliveryInoutputs)
                                            <tr>
                                                <td># {{ $DeliveryInoutputs['bill_no'] }}</td>
                                                <td>{{ $DeliveryInoutputs['customer'] }}</td>
                                                <td>₹ {{ $DeliveryInoutputs['grandtotal'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
