@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Supplier</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".supplier-modal-xl">Add New</button>
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
                            @foreach ($supplierdata as $keydata => $supplier_data)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $supplier_data['name'] }}</td>
                                    <td>{{ $supplier_data['phone_number']  }}</td>
                                    <td>{{ $supplier_data['address']  }}</td>
                                        @if ($supplier_data['account_balance'] != "")
                                        <td style="color: white;background: green;">₹ {{ $supplier_data['account_balance']  }}.00</td>
                                        @else
                                        <td></td>
                                        @endif

                                        @if ($supplier_data['pending_amount'] != "")
                                        <td style="color: white;background: red;">₹ {{ $supplier_data['pending_amount']  }}.00</td>
                                        @else
                                        <td></td>
                                        @endif
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $supplier_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $supplier_data['unique_key'] }}"
                                                    data-bs-target=".supplieredit-modal-xl{{ $supplier_data['unique_key'] }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#delete{{ $supplier_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $supplier_data['unique_key'] }}"
                                                    data-bs-target=".supplierdelete-modal-xl{{ $supplier_data['unique_key'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade supplieredit-modal-xl{{ $supplier_data['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $supplier_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.supplier.edit')
                                </div>
                                <div class="modal fade supplierdelete-modal-xl{{ $supplier_data['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $supplier_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.supplier.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade supplier-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.supplier.create')
        </div>
    </div>
@endsection
