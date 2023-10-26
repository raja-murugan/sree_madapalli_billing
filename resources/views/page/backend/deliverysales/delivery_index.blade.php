@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sales Delivery</h4>
            </div>

            <div class="page-btn">
                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('deliverysales.delivery_datefilter') }}">
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
                        <a href="{{ route('deliverysales.delivery_create') }}" class="btn btn-added" style="margin-right: 10px;">Add New</a>
                </div>


            </div>
        </div>


      
        <br/>
        
                    <div class="card">
                        <div class="card-body" style="overflow: auto;">
                                <div class="row">
                                    <table class="table">
                                        <thead><h5 style="text-transform: uppercase;text-align:center;color:black;padding-bottom:10px">{{ $curent_month}}-{{$year}}</h5></thead>
                                        <thead>
                                                <tr>
                                                    <th class="border">Date</th>
                                                    @foreach ($list as $lists)
                                                        <th colspan="3" class="border" style="text-align:center;">{{ $lists }}</th>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <th class="border">Day</th>
                                                    @foreach ($list as $lists_ass)
                                                    @php 
                                                    
                                                    $timestamp = strtotime($year .'-'. $month .'-'. $lists_ass); 
                                                    $day = date('l', $timestamp);
                                                    $date = $year .'-'. $month .'-'. $lists_ass;
                                                    @endphp

                                                    <th class="border " colspan="3" style="text-align:center;"><span class="badges bg-lightyellow" style="color: white">{{$day}}</span></th>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <th class="border">Session</th>
                                                    @foreach ($list as $lists)
                                                    @foreach ($session_terms as $session_termsarr)
                                                    <th class="border" style="text-align:center;">{{$session_termsarr['session']}}</th>
                                                    @endforeach
                                                    @endforeach
                                                </tr>
                                        </thead>
                                        <tbody>
                                                @foreach ($customer_arrdata as $customer_arrdatas)
                                                <tr class="border">
                                                    <td class="border" >{{$customer_arrdatas->name}}</td>

                                                    @foreach ($Sale_Delivery_Data as $Sale_Delivery_Datas)
                                                        @if ($customer_arrdatas->id == $Sale_Delivery_Datas['customer_id'])

                                                            @if ($Sale_Delivery_Datas['status'] == 'Yes')
                                                                <td class="border" >
                                                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" style="color:green;font-size:15px;" >
                                                                        {{ $Sale_Delivery_Datas['status'] }}</a>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                        <a href="#salesview{{ $Sale_Delivery_Datas['unique_key'] }}"data-bs-toggle="modal" data-id="{{ $Sale_Delivery_Datas['deliverysale_id'] }}" data-bs-target=".salesview-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}" class="dropdown-item">Sale Detail</a>
                                                                        </li>
                                                                        <li>
                                                                        <a href="{{ route('deliverysales.delivery_edit', ['unique_key' => $Sale_Delivery_Datas['unique_key']]) }}" class="dropdown-item">Edit Sale</a>
                                                                        </li>
                                                                        <li>
                                                                        <a href="https://bill.sreemadapalli.in/zworktechnology/sales/print/{{ $Sale_Delivery_Datas['deliverysale_id'] }}" class="dropdown-item">Print</a>
                                                                        </li>
                                                                        <li>
                                                                        <a href="#salesedelete{{ $Sale_Delivery_Datas['unique_key'] }}" data-bs-toggle="modal" data-id="{{ $Sale_Delivery_Datas['unique_key'] }}" data-bs-target=".salesedelete-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}" class="dropdown-item confirm-text">Delete Sale</a>
                                                                        </li>
                                                                    </ul>
                                                                </td>


                                                                <div class="modal fade salesview-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                                    aria-labelledby="purchaseviewLargeModalLabel{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                    aria-hidden="true">
                                                                    @include('page.backend.deliverysales.delivery_view')
                                                                </div>
                                                                <div class="modal fade salesedelete-modal-xl{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                                    aria-labelledby="deleteLargeModalLabel{{ $Sale_Delivery_Datas['unique_key'] }}"
                                                                    aria-hidden="true">
                                                                    @include('page.backend.deliverysales.delivery_delete')
                                                                </div>
                                                            @else
                                                                <td class="border"></td>
                                                            @endif

                                                        @endif


                                                        
                                                    @endforeach
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
@endsection
