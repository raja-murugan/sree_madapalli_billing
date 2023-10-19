@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".purchaseproduct-modal-xl">Add New</button>
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
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $keydata => $Purchaseproduct_data)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $Purchaseproduct_data->name }}</td>
                                    <td>{{ $Purchaseproduct_data->note  }}</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $Purchaseproduct_data->unique_key }}" data-bs-toggle="modal"
                                                    data-id="{{ $Purchaseproduct_data->unique_key }}"
                                                    data-bs-target=".purchaseproductedit-modal-xl{{ $Purchaseproduct_data->unique_key }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#delete{{ $Purchaseproduct_data->unique_key }}" data-bs-toggle="modal"
                                                    data-id="{{ $Purchaseproduct_data->unique_key }}"
                                                    data-bs-target=".purchaseproductdelete-modal-xl{{ $Purchaseproduct_data->unique_key }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade purchaseproductedit-modal-xl{{ $Purchaseproduct_data->unique_key }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $Purchaseproduct_data->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.purchase_product.edit')
                                </div>
                                <div class="modal fade purchaseproductdelete-modal-xl{{ $Purchaseproduct_data->unique_key }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $Purchaseproduct_data->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.purchase_product.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade purchaseproduct-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.purchase_product.create')
        </div>
    </div>
@endsection
