@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Session</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".productsession-modal-xl">Add New</button>
                    
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
                                <th>Session</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Productdata as $keydata => $Productdatas)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $Productdatas['productname'] }}</td>
                                    <td>{{ $Productdatas['category_name'] }}</td>
                                    <td>
                                    @foreach ($Productdatas['terms'] as $index => $terms_array)
                                                    @if ($terms_array['product_id'] == $Productdatas['id'])
                                                    {{ $terms_array['sessionname'] }},<br/>
                                                    @endif
                                                    @endforeach
                                    </td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $Productdatas['id'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $Productdatas['id'] }}"
                                                    data-bs-target=".productsessedit-modal-xl{{ $Productdatas['id'] }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li hidden>
                                                <a href="#delete{{ $Productdatas['id'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $Productdatas['id'] }}"
                                                    data-bs-target=".productsessedelete-modal-xl{{ $Productdatas['id'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade productsessedit-modal-xl{{ $Productdatas['id'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $Productdatas['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.productsession.edit')
                                </div>
                                <div class="modal fade productsessedelete-modal-xl{{ $Productdatas['id'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $Productdatas['id'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.productsession.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade productsession-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.productsession.create')
        </div>
    </div>
@endsection
