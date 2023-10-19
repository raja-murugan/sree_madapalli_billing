@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales</h4>
            </div>

            <div class="page-btn">
                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('sales.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;" hidden>
                                       <select class="form-control" name="sales_type" id="sales_type">
                                          <option value="none">Status</option>
                                          <option value="Dine In">Dine In</option>
                                          <option value="Take Away">Take Away</option>
                                          <option value="Delivery">Delivery</option>
                                       </select>
                                 </div>
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                        <a href="{{ route('sales.create') }}" class="btn btn-added" style="margin-right: 10px;">Add New</a>
                </div>


            </div>
        </div>


        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1" style="background: #ad2a31;">
                    <div class="dash-widgetcontent">
                        <h5 style="color:white">₹ <span class="counters"  data-count="{{ $totsaleAmount }}"></span></h5>
                        <h6 style="color:white">Total Sales Value</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1" style="background: #6ed1a3;">
                    <div class="dash-widgetcontent">
                        <h5>₹ <span class="counters" data-count="{{ $total_dine_in }}"></span></h5>
                        <h6>Total Dine In</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1" style="background: #d5eb15;">
                    <div class="dash-widgetcontent">
                        <h5>₹ <span class="counters" data-count="{{ $total_take_away }}"></span></h5>
                        <h6>Total WalkAway</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1" style="background: #ffb17f;">
                    <div class="dash-widgetcontent">
                        <h5>₹ <span class="counters" data-count="{{ $totaldelivery }}"></span></h5>
                        <h6>Total Delivery</h6>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                <li class="nav-item"><a class="nav-link active" href="#solid-tab1" data-bs-toggle="tab">Dine In</a></li>
                <li class="nav-item"><a class="nav-link" href="#solid-tab2" data-bs-toggle="tab">Take Away</a></li>
                <li class="nav-item" hidden><a class="nav-link" href="#solid-tab3" data-bs-toggle="tab">Delivery</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="solid-tab1">

                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table  datanew">
                                    <thead>
                                        <tr>
                                            <th>Bill No</th>
                                            <th>Date</th>
                                            <th>Sales Type</th>
                                            <th>Payment Method</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saledinein_data as $keydata => $datas)
                                            <tr>
                                                <td>{{ $datas['bill_no'] }}</td>
                                                <td> {{ $datas['date']  }}</td>
                                                <td> {{ $datas['sales_type']  }}</td>
                                                <td>{{ $datas['payment_method']   }}</td>
                                                <td>₹ {{ $datas['grandtotal']   }}</td>
                                                <td>

                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li>
                                                            <a href="#salesview{{ $datas['unique_key'] }}"
                                                                data-bs-toggle="modal" data-id="{{ $datas['id'] }}"
                                                                data-bs-target=".salesview-modal-xl{{ $datas['unique_key'] }}"
                                                                class="badges bg-lightred salesview" style="color: white">View</a>

                                                        </li>
                                                        <li>
                                                        <a href="https://annapooranifoods.com/zworktechnology/sales/print/{{ $datas['id'] }}" class="badges btn btn-success" style="color:white">Print</a>
                                                        </li>
                                                        <li>
                                                            <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                                data-id="{{ $datas['unique_key'] }}"
                                                                data-bs-target=".salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                                class="badges bg-lightyellow" style="color: white">Delete</a>
                                                        </li>
                                                        <li>
                                                                <a href="{{ route('sales.edit', ['unique_key' => $datas['unique_key']]) }}"
                                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                                        </li>

                                                    </ul>
                                                </td>
                                            </tr>
                                            <div class="modal fade salesview-modal-xl{{ $datas['unique_key'] }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                                aria-hidden="true">
                                                @include('page.backend.sales.view')
                                            </div>
                                            <div class="modal fade salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}"
                                                aria-hidden="true">
                                                @include('page.backend.sales.delete')
                                            </div>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tab-pane" id="solid-tab2">

                    <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table  datanew">
                                        <thead>
                                            <tr>
                                                <th>Bill No</th>
                                                <th>Date</th>
                                                <th>Sales Type</th>
                                                <th>Payment Method</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($saletakeway_data as $keydata => $datas)
                                                <tr>
                                                    <td>{{ $datas['bill_no'] }}</td>
                                                    <td> {{ $datas['date']  }}</td>
                                                    <td> {{ $datas['sales_type']  }}</td>
                                                    <td>{{ $datas['payment_method']   }}</td>
                                                    <td>₹ {{ $datas['grandtotal']   }}</td>
                                                    <td>

                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                            <li>
                                                                <a href="#salesview{{ $datas['unique_key'] }}"
                                                                    data-bs-toggle="modal" data-id="{{ $datas['id'] }}"
                                                                    data-bs-target=".salesview-modal-xl{{ $datas['unique_key'] }}"
                                                                    class="badges bg-lightred salesview" style="color: white">View</a>

                                                            </li>
                                                            <li>
                                                            <a href="https://annapooranifoods.com/zworktechnology/sales/print/{{ $datas['id'] }}" class="badges btn btn-success" style="color:white">Print</a>
                                                            </li>
                                                            <li>
                                                                <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                                    data-id="{{ $datas['unique_key'] }}"
                                                                    data-bs-target=".salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                                            </li>
                                                            <li>
                                                                    <a href="{{ route('sales.edit', ['unique_key' => $datas['unique_key']]) }}"
                                                                        class="badges bg-lightgrey" style="color: white">Edit</a>
                                                            </li>

                                                        </ul>
                                                    </td>
                                                </tr>
                                                <div class="modal fade salesview-modal-xl{{ $datas['unique_key'] }}"
                                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                    aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                                    aria-hidden="true">
                                                    @include('page.backend.sales.view')
                                                </div>
                                                <div class="modal fade salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                    aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}"
                                                    aria-hidden="true">
                                                    @include('page.backend.sales.delete')
                                                </div>

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                <div class="tab-pane" id="solid-tab3" hidden>
                    <div class="card">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table  datanew">
                                            <thead>
                                                <tr>
                                                    <th>Bill No</th>
                                                    <th>Date</th>
                                                    <th>Sales Type</th>
                                                    <th>Customer</th>
                                                    <th>Payment Method</th>
                                                    <th>Delivery Boy</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($saledelivery_data as $keydata => $datas)
                                                    <tr>
                                                        <td>{{ $datas['bill_no'] }}</td>
                                                        <td> {{ $datas['date']  }}</td>
                                                        <td> {{ $datas['sales_type']  }}</td>
                                                        <td>{{ $datas['customer']}}</td>
                                                        <td>
                                                            @if ($datas['payment_method'] != "")
                                                                {{$datas['payment_method']}}
                                                            @else
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li>
                                                                    <a href="deliveryupdate{{ $datas['unique_key'] }}"
                                                                    data-bs-toggle="modal" data-id="{{ $datas['id'] }}" style="background: #e3e167;"
                                                                    data-bs-target=".deliveryupdate-modal-xl{{ $datas['unique_key'] }}"
                                                                    class="badges" style="color: white">Add</a>
                                                                </li>
                                                            </ul>
                                                            @endif
                                                        </td>
                                                        <td style="color: #dc3545;"><i class="fa fa-user-circle" data-bs-toggle="tooltip" title="fa fa-user-circle"></i> {{$datas['Delivery_boyname']}}</td>
                                                        <td>₹ {{ $datas['grandtotal']   }}</td>
                                                        <td>

                                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li>
                                                                    <a href="#salesview{{ $datas['unique_key'] }}"
                                                                        data-bs-toggle="modal" data-id="{{ $datas['id'] }}"
                                                                        data-bs-target=".salesview-modal-xl{{ $datas['unique_key'] }}"
                                                                        class="badges bg-lightred salesview" style="color: white">View</a>

                                                                </li>
                                                                <li>
                                                                <a href="https://annapooranifoods.com/zworktechnology/sales/print/{{ $datas['id'] }}" class="badges btn btn-success" style="color:white">Print</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                                        data-id="{{ $datas['unique_key'] }}"
                                                                        data-bs-target=".salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                                        class="badges bg-lightyellow" style="color: white">Delete</a>
                                                                </li>

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade deliveryupdate-modal-xl{{ $datas['unique_key'] }}"
                                                        tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                        aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                                        aria-hidden="true">
                                                        @include('page.backend.sales.deliveryupdate')
                                                    </div>
                                                    <div class="modal fade salesview-modal-xl{{ $datas['unique_key'] }}"
                                                        tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                        aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                                        aria-hidden="true">
                                                        @include('page.backend.sales.view')
                                                    </div>
                                                    <div class="modal fade salesedelete-modal-xl{{ $datas['unique_key'] }}"
                                                        tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                        aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}"
                                                        aria-hidden="true">
                                                        @include('page.backend.sales.delete')
                                                    </div>

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
@endsection
