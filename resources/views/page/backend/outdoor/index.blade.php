@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Outdoor</h4>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('outdoor.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                        <a href="{{ route('outdoor.create') }}" class="btn btn-added" style="margin-right: 10px;">Add New</a>
                </div>  
                    
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>Bill No</th>
                                <th>Booking Date</th>
                                <th>Delivery Date</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outdoor_data as $keydata => $datas)
                                <tr>
                                    <td># {{ $datas['bill_no']  }}</td>
                                    <td> {{ date('d-m-Y', strtotime($datas['booking_date']))  }}</td>
                                    <td>{{ date('d-m-Y', strtotime($datas['delivery_date']))  }} -  {{ $datas['delivery_time']  }}</td>
                                    <td>{{ $datas['name']  }}</td> 
                                    <td>{{ $datas['total']  }}</td> 
                                    <td>{{ $datas['payment_amount']  }}</td> 
                                    <td>
                                    @if ($datas['delivery_status'] == '1')
                                    <span class="badges" style="color: green;font-size: 16px;font-weight: 800;">Delivered</sapn>

                                    @else
                                    
                                    @if ($currentdate > $datas['delivery_date'])
                                    <span class="badges" style="color: red;font-size: 16px;font-weight: 800;">Pending</sapn>
                                    @endif
                                    @endif
                                    </td> 
                                    <td>

                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="outdoorview{{ $datas['unique_key'] }}"
                                                    data-bs-toggle="modal" data-id="{{ $datas['id'] }}"
                                                    data-bs-target=".outdoorview-modal-xl{{ $datas['unique_key'] }}"
                                                    class="badges bg-lightred outdoorview" style="color: white">View</a>

                                            </li>
                                             <li>
                                                    <a href="{{ route('outdoor.edit', ['unique_key' => $datas['unique_key']]) }}"
                                                        class="badges bg-lightgrey" style="color: white">Edit</a>
                                             </li>
                                             @if ($datas['delivery_status'] == '0')
                                            <li>
                                                    <a href="paybalance{{ $datas['unique_key'] }}" data-id="{{ $datas['id'] }}"
                                                    data-bs-toggle="modal" data-id="{{ $datas['id'] }}" style="background: #e3e167;"
                                                    data-bs-target=".paybalance-modal-xl{{ $datas['unique_key'] }}"
                                                    class="badges paybalance{{ $datas['id'] }}" style="color: white">Pay Balance</a>
                                                            </li>
                                                            @endif
                                             <li>
                                                <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $datas['unique_key'] }}"
                                                    data-bs-target=".outdoordelete-modal-xl{{ $datas['unique_key'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <div class="modal fade paybalance-modal-xl{{ $datas['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.outdoor.paybalance')
                                </div>
                                <div class="modal fade outdoorview-modal-xl{{ $datas['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="purchaseviewLargeModalLabel{{ $datas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.outdoor.view')
                                </div>
                                <div class="modal fade outdoordelete-modal-xl{{ $datas['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.outdoor.delete')
                                </div>
                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
