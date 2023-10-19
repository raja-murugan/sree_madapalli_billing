@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Add Breakfast Attendance</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('delivery_attendance.store') }}" enctype="multipart/form-data">
                    @csrf


                  <div class="row">
                        
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $today }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $timenow }}" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Session<span
                                        style="color: red;">*</span></label>
                                    <select class="form-control js-example-basic-single select" name="session_id" id="session_id">
                                    <option value="" disabled selected hiddden>Select Session</option>
                                    @foreach ($session as $sessions)
                                        <option value="{{ $sessions->id }}"@if ($sessions->id === 1) selected='selected' @endif>{{ $sessions->name }}</option>
                                        
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                  </div>

                    <br />

                  <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
                                        <th style="font-size:15px; width:30%;">Delivery Boy</th>
                                        <th style="font-size:15px; width:40%;">Status</th>
                                        <th></th><th></th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                @foreach ($deliveryboy as $deliveryboys)
                                    <tr>
                                                
                                                <td>
                                                   <input type="hidden" id="deliveryboy_id" name="deliveryboy_id[]" value="{{$deliveryboys->id}}"/>
                                                   <input type="text"id="deliveryboy" readonly name="deliveryboy[]" value="{{$deliveryboys->name}}" class="form-control" style="background: #e9ecefad;"/>
                                                </td>
                                                <td>
                                                   <div style="display:flex;">
                                                      <div class="input-group" style="margin-right: 5px;">
                                                         <div class="input-group-text">
                                                               <input class="form-check-input" type="radio" value="Present" id="attendance" name="attendance[{{$deliveryboys->id}}]"
                                                                  aria-label="Radio button for following text input" checked>
                                                         </div>
                                                         <input type="text" class="form-control" value="Present" disabled style="background: #fff;width:10px;"
                                                               aria-label="Text input with radio button">
                                                      </div>
                                                      <div class="input-group" style="margin-right: 5px;">
                                                         <div class="input-group-text">
                                                               <input class="form-check-input" type="radio" value="Absent" id="attendance" name="attendance[{{$deliveryboys->id}}]"
                                                                  aria-label="Radio button for following text input">
                                                         </div>
                                                         <input type="text" class="form-control" value="Absent" disabled style="background: #fff;"
                                                               aria-label="Text input with radio button">
                                                      </div>
                                                   </div>
                                                </td><td></td><td></td>
                                        </tr>
                                        @endforeach
                                </table>
                                             </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <br />

                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" onclick="deliveryattendsubmitForm(this);" />
                        <a href="{{ route('delivery_attendance.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
