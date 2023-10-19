@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Add Employee Shift {{$shift}} - Attendance</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('emp_attendance.update', ['unique_key' => $EmployeeAttendance->unique_key]) }}" enctype="multipart/form-data">
                @method('PUT')
               @csrf


                  <div class="row">
                    <input type="hidden" name="shift" value="{{ $EmployeeAttendance->shift }}">
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $EmployeeAttendance->date }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $EmployeeAttendance->time }}" required>
                            </div>
                        </div>
                  </div>

                    <br />

                  <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead>
                                    <tr style="background: #f8f9fa;">
                                        <th style="font-size:15px; width:30%;">Employee</th>
                                        <th style="font-size:15px; width:70%;">Attendance</th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                @foreach ($EmployeeattendanceData as $EmployeeattendanceDatas)
                                    <tr>
                                        <td>
                                               
                                                   <input type="hidden" id="employee_id" name="employee_id[]" value="{{$EmployeeattendanceDatas->employee_id}}"/>
                                                   <input type="text"id="employee_name"name="employee_name[]" value="{{$EmployeeattendanceDatas->employee_name}}" readonly class="form-control"/>
                                               
                                        </td>
                                        <td>
                                                <div style="display: flex">
                                                    <div class="input-group" style="margin-right: 5px;">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input" type="radio" value="Present"  id="attendance{{$EmployeeattendanceDatas->employee_id}}" {{ $EmployeeattendanceDatas->attendance == 'Present' ? 'checked' : '' }} name="attendance[{{$EmployeeattendanceDatas->employee_id}}]"
                                                                aria-label="Radio button for following text input" checked>
                                                        </div>
                                                        <input type="text" class="form-control" value="Present" disabled
                                                            aria-label="Text input with radio button">
                                                    </div>
                                                    <div class="input-group" style="margin-right: 5px;">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input" type="radio" value="Absent" id="attendance{{$EmployeeattendanceDatas->employee_id}}" {{ $EmployeeattendanceDatas->attendance == 'Absent' ? 'checked' : '' }} name="attendance[{{$EmployeeattendanceDatas->employee_id}}]"
                                                                aria-label="Radio button for following text input">
                                                        </div>
                                                        <input type="text" class="form-control" value="Absent" disabled
                                                            aria-label="Text input with radio button">
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input" type="radio" value="Leave" id="attendance{{$EmployeeattendanceDatas->employee_id}}" {{ $EmployeeattendanceDatas->attendance == 'Leave' ? 'checked' : '' }} name="attendance[{{$EmployeeattendanceDatas->employee_id}}]"
                                                                aria-label="Radio button for following text input">
                                                        </div>
                                                        <input type="text" class="form-control" value="Leave" disabled
                                                            aria-label="Text input with radio button">
                                                    </div>
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <input class="form-check-input" type="radio" value="Sick Leave" id="attendance{{$EmployeeattendanceDatas->employee_id}}" {{ $EmployeeattendanceDatas->attendance == 'Sick Leave' ? 'checked' : '' }} name="attendance[{{$EmployeeattendanceDatas->employee_id}}]"
                                                                aria-label="Radio button for following text input">
                                                        </div>
                                                        <input type="text" class="form-control" value="Sick Leave" disabled
                                                            aria-label="Text input with radio button">
                                                    </div>
                                                </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <br />

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" onclick="empattendsubmitForm(this);" />
                        <a href="{{ route('emp_attendance.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
