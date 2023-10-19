@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".product-modal-xl">Add New</button>
                    
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Productdata as $keydata => $Productdatas)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $Productdatas['name'] }}</td>
                                    <td>{{ $Productdatas['categoryname'] }}</td>
                                    
                                        @if ($Productdatas['image'] == "")
                                        <td></td>
                                        @elseif ($Productdatas['image'] != "")
                                        <td><img src="{{ asset('assets/product/' .$Productdatas['image']) }}" alt="" width="50" height="50"></td>
                                        @endif
                                    <td>{{ $Productdatas['price']  }}.00</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $Productdatas['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $Productdatas['unique_key'] }}"
                                                    data-bs-target=".productedit-modal-xl{{ $Productdatas['unique_key'] }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li hidden>
                                                <a href="#delete{{ $Productdatas['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $Productdatas['unique_key'] }}"
                                                    data-bs-target=".productedelete-modal-xl{{ $Productdatas['unique_key'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade productedit-modal-xl{{ $Productdatas['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $Productdatas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.product.edit')
                                </div>
                                <div class="modal fade productedelete-modal-xl{{ $Productdatas['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $Productdatas['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.product.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade product-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.product.create')
        </div>
    </div>
@endsection
