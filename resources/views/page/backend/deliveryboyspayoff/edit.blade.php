@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Update {{$Deliveryboyname->name}} - Payoff</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
            <form autocomplete="off" method="POST" action="{{ route('deliveryboyspayoff.update', ['deliveryboyid' => $deliveryboyid, 'month' => $month, 'year' => $year]) }}" enctype="multipart/form-data">
               @method('PUT')
               @csrf


                  <div class="row">



                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Year<span
                                        style="color: red;">*</span></label>
                                <select class="form-control deliveryboysalary_year select" name="salary_year" id="salary_year" required>
                                    <option value="" selected hidden class="text-muted">Select </option>
                                    @foreach ($years_arr as $years_array)
                                    <option value="{{ $years_array }} "@if ($years_array == $year) selected='selected' @endif>{{ $years_array }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Month<span
                                        style="color: red;">*</span></label>
                                 <select class="form-control js-example-basic-single deliveryboysalary_month select" name="salary_month" id="salary_month"required>
                                    <option value="01"@if ('01' === $month) selected='selected' @endif>January</option>
                                    <option value="02"@if ('02' === $month) selected='selected' @endif>February</option>
                                    <option value="03"@if ('03' === $month) selected='selected' @endif>March</option>
                                    <option value="04"@if ('04' === $month) selected='selected' @endif>April</option>
                                    <option value="05"@if ('05' === $month) selected='selected' @endif>May</option>
                                    <option value="06"@if ('06' === $month) selected='selected' @endif>June</option>
                                    <option value="07"@if ('07' === $month) selected='selected' @endif>July</option>
                                    <option value="08"@if ('08' === $month) selected='selected' @endif>August</option>
                                    <option value="09"@if ('09' === $month) selected='selected' @endif>September</option>
                                    <option value="10"@if ('10' === $month) selected='selected' @endif>October</option>
                                    <option value="11"@if ('11' === $month) selected='selected' @endif>November</option>
                                    <option value="12"@if ('12' === $month) selected='selected' @endif>December</option>
                                 </select>
                            </div>
                        </div>

                        
                  </div>


                    <br />

                    <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead id="">
                                    <tr style="background: #f8f9fa;">
                                        <th style="font-size:15px; width:12%;">DeliveryBoy</th>
                                        <th style="font-size:15px; width:7%;">Shifts</th>
                                        <th style="font-size:15px; width:7%;">Shift / Salary</th>
                                        <th style="font-size:15px; width:10%;">Total Salary</th>
                                        <th style="font-size:15px; width:10%;">Date</th>
                                        <th style="font-size:15px; width:10%;">Paid Amount</th>
                                        <th style="font-size:15px; width:28%;">Note</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                @foreach ($payoffdatas as $payoffdatas_arr)
                                    <tr>
                                       <td>{{ $payoffdatas_arr['deliveryboy'] }}
                                          <input type="hidden" name="payoffdata_id[]" id="payoffdata_id" value="{{$payoffdatas_arr['id']}}" />
                                       </td>
                                       <td>{{ $payoffdatas_arr['present_shifts'] }}</td>
                                       <td>{{ $payoffdatas_arr['pershiftsalary'] }}</td>
                                       <td>{{ $payoffdatas_arr['total_salaryamount'] }}</td>
                                       <td><input type="date" class="form-control" id="date" name="date[]" value="{{ $payoffdatas_arr['date'] }}"/></td>
                                       <td><input type="text" class="form-control" id="amountgiven" name="amountgiven[]" value="{{ $payoffdatas_arr['payable_amount'] }}"/></td>
                                       <td><input type="text" class="form-control" id="payoffnotes" name="payoffnotes[]" value="{{ $payoffdatas_arr['payoffnotes'] }}"/></td>
                                       <td><button style="width: 35px;" class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-danger remove-dbpayofftr" type="button" >-</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                  </div>


                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" />
                        <a href="{{ route('deliveryboyspayoff.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
   $(document).on('click', '.remove-dbpayofftr', function() {
      $(this).parents('tr').remove();
   });
</script>
@endsection


