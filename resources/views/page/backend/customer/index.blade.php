@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Customer</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".customer-modal-xl">Add New</button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Name</th>
                                <th>Phone No</th>
                                <th>Address</th>
                                <th>Account Balance</th>
                                <th>Pending Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customerdata as $keydata => $custmer_data)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $custmer_data['name'] }}</td>
                                    <td>{{ $custmer_data['phone_number']  }}</td>
                                    <td>{{ $custmer_data['address']  }}</td>
                                        @if ($custmer_data['account_balance'] != "")
                                        <td style="color: white;background: green;">₹ {{ $custmer_data['account_balance']  }}.00</td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($custmer_data['pending_amount'] != "")
                                        <td style="color: white;background: red;">₹ {{ $custmer_data['pending_amount']  }}.00</td>
                                        @else
                                        <td></td>
                                        @endif
                                    
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $custmer_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $custmer_data['unique_key'] }}"
                                                    data-bs-target=".customeredit-modal-xl{{ $custmer_data['unique_key'] }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#delete{{ $custmer_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{$custmer_data['unique_key'] }}"
                                                    data-bs-target=".customerdelete-modal-xl{{ $custmer_data['unique_key'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade customeredit-modal-xl{{ $custmer_data['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $custmer_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.customer.edit')
                                </div>
                                <div class="modal fade customerdelete-modal-xl{{ $custmer_data['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $custmer_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.customer.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade customer-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.customer.create')
        </div>
    </div>
@endsection
