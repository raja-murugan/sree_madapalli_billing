@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Delivery Boys</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".bs-example-modal-xl">Add New</button>
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
                                <th>Phone Number</th>
                                <th>Delivery Area</th>
                                <th>Per Shift Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $keydata => $deliveryboydata)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $deliveryboydata->name }}</td>
                                    <td>{{ $deliveryboydata->phone_number }}</td>
                                    <td>{{ $deliveryboydata->deliveryarea->name }}</td>
                                    <td>₹ {{ $deliveryboydata->pershiftsalary }}.00</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $deliveryboydata->unique_key }}" data-bs-toggle="modal"
                                                    data-id="{{ $deliveryboydata->unique_key }}"
                                                    data-bs-target=".edit-modal-xl{{ $deliveryboydata->unique_key }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#delete{{ $deliveryboydata->unique_key }}" data-bs-toggle="modal"
                                                    data-id="{{ $deliveryboydata->unique_key }}"
                                                    data-bs-target=".delete-modal-xl{{ $deliveryboydata->unique_key }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade edit-modal-xl{{ $deliveryboydata->unique_key }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $deliveryboydata->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.deliveryboy.edit')
                                </div>
                                <div class="modal fade delete-modal-xl{{ $deliveryboydata->unique_key }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $deliveryboydata->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.deliveryboy.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.deliveryboy.create')
        </div>
    </div>
@endsection
