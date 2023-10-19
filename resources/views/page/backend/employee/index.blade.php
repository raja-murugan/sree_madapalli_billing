@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Employee</h4>
            </div>
            <div class="page-btn">
                <button type="button" class="btn btn-primary waves-effect waves-light btn-added" data-bs-toggle="modal"
                    data-bs-target=".employee-modal-xl">Add New</button>
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
                                <th>Per Day Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $keydata => $employee_data)
                                <tr>
                                    <td>{{ ++$keydata }}</td>
                                    <td>{{ $employee_data->name }}</td>
                                    <td>{{ $employee_data->phone_number  }}</td>
                                    <td>{{ $employee_data->address  }}</td>
                                    <td>₹ {{ $employee_data->perdaysalary  }}.00</td>
                                    <td>
                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                            <li>
                                                <a href="#edit{{ $employee_data->unique_key }}" data-bs-toggle="modal"
                                                    data-id="{{ $employee_data->unique_key }}"
                                                    data-bs-target=".employeeedit-modal-xl{{ $employee_data->unique_key }}"
                                                    class="badges bg-lightgrey" style="color: white">Edit</a>
                                            </li>
                                            <li>
                                                <a href="#delete{{ $employee_data->unique_key }}" data-bs-toggle="modal"
                                                    data-id="{{ $employee_data->unique_key }}"
                                                    data-bs-target=".employeedelete-modal-xl{{ $employee_data->unique_key }}"
                                                    class="badges bg-lightyellow" style="color: white">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>

                                <div class="modal fade employeeedit-modal-xl{{ $employee_data->unique_key }}"
                                    tabindex="-1" role="dialog" data-bs-backdrop="static"
                                    aria-labelledby="editLargeModalLabel{{ $employee_data->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.employee.edit')
                                </div>
                                <div class="modal fade employeedelete-modal-xl{{ $employee_data->unique_key }}"
                                    tabindex="-1" role="dialog"data-bs-backdrop="static"
                                    aria-labelledby="deleteLargeModalLabel{{ $employee_data->unique_key }}"
                                    aria-hidden="true">
                                    @include('page.backend.employee.delete')
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade employee-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
            aria-hidden="true">
            @include('page.backend.employee.create')
        </div>
    </div>
@endsection
