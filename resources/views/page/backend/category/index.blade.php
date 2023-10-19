@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Category</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".category-modal-xl">Add New</button>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($catdata as $keydata => $category_data)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $category_data['name'] }}</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $category_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $category_data['unique_key'] }}"
                                                    data-bs-target=".categoryeedit-modal-xl{{ $category_data['unique_key'] }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li hidden>
                                                <a href="#delete{{ $category_data['unique_key'] }}" data-bs-toggle="modal"
                                                    data-id="{{ $category_data['unique_key'] }}"
                                                    data-bs-target=".categorydelete-modal-xl{{ $category_data['unique_key'] }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade categoryeedit-modal-xl{{ $category_data['unique_key'] }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $category_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.category.edit')
                                </div>
                                <div class="modal fade categorydelete-modal-xl{{ $category_data['unique_key'] }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $category_data['unique_key'] }}"
                                    aria-hidden="true">
                                    @include('page.backend.category.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade category-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.category.create')
        </div>
    </div>
@endsection
