@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Add Delivery Boy Payoff</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
                <form autocomplete="off" method="POST" action="{{ route('deliveryboyspayoff.store') }}" enctype="multipart/form-data">
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
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Year<span
                                        style="color: red;">*</span></label>
                                <select class="form-control deliveryboysalary_year select" name="salary_year" id="salary_year" required>
                                    <option value="" selected hidden class="text-muted">Select </option>
                                    @foreach ($years_arr as $years_array)
                                    <option value="{{ $years_array }} "@if ($years_array == $current_year) selected='selected' @endif>{{ $years_array }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Month<span
                                        style="color: red;">*</span></label>
                                 <select class="form-control js-example-basic-single deliveryboysalary_month select" name="salary_month" id="salary_month"required>
                                    <option value="" selected hidden class="text-muted">Select Month </option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                 </select>
                            </div>
                        </div>

                        
                  </div>


                    <br />

                    <div class="row">
                        <div class="table-responsive col-lg-12 col-sm-12 col-12">
                            <table class="table">
                                <thead id="head_deliveryboysalrayrow" style="display:none">
                                    <tr style="background: #f8f9fa;">
                                        <th style="font-size:15px; width:12%;">DeliveryBoy</th>
                                        <th style="font-size:15px; width:7%;">Shifts</th>
                                        <th style="font-size:15px; width:7%;">Shift / Salary</th>
                                        <th style="font-size:15px; width:10%;">Total Salary</th>
                                        <th style="font-size:15px; width:10%;">Paid</th>
                                        <th style="font-size:15px; width:10%;">Balance</th>
                                        <th style="font-size:15px; width:16%;">Salary</th>
                                        <th style="font-size:15px; width:28%;">Note</th>
                                    </tr>
                                </thead>
                                <tbody id="deliveryboysalrayrow">
                                </tbody>
                            </table>
                        </div>
                  </div>

<script>
$(document).ready(function() {
     $('.deliveryboysalary_month').on('change', function () {
        var salary_month = $(this).val();
        var salary_year = $(".deliveryboysalary_year").val();
        console.log(salary_year);
        $.ajax({
            url: '/getdeliveryboy_totpresentdays/',
            type: 'get',
            data: {
                salary_month: salary_month,
                salary_year: salary_year
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var len = response.length;
                $('#deliveryboysalrayrow').html('');
                for (var i = 0; i < len; i++) {

                        var column_0 = $('<td/>', {
                            html: response[i].deliveryboy + '<input type="hidden" id="deliveryboy_id" name="deliveryboy_id[]" value="' + response[i].id + '"/>',
                        });
                        var column_1 = $('<td/>', {
                            html: response[i].total_presentdays + '<input type="hidden" id="total_presentdays" name="total_presentdays[]" style="background: white;" value="' + response[i].total_presentdays + '" readonly class="form-control"/><input type="hidden" id="totaldays" name="totaldays[]"  readonly style="background: white;" value="' + response[i].total_days + '" class="form-control"/>',
                        });
                        var column_2 = $('<td/>', {
                            html: response[i].pershiftsalary + '<input type="hidden" id="pershiftsalary" name="pershiftsalary[]" style="background: white;" value="' + response[i].pershiftsalary + '" readonly class="form-control"/>',
                        });
                        var column_3 = $('<td/>', {
                            html: response[i].total_salary + '<input type="hidden" id="total_salaryamount" name="total_salaryamount[]" style="background: white;color: #198754;font-weight:800;" value="' + response[i].total_salary + '" readonly class="form-control total_salaryamount"/>',
                        });
                        var column_4 = $('<td/>', {
                            html: response[i].paid_salary + '<input type="hidden" id="paid_salaryamount" name="paid_salaryamount[]" style="background: white;color: red;font-weight:800;" value="' + response[i].paid_salary + '" readonly class="form-control paid_salaryamount"/>',
                        });
                        var column_5 = $('<td/>', {
                            html: response[i].balanceAmount + '<input type="hidden" id="balncesalary" name="balncesalary[]" style="background: #bbee9a;" value="' + response[i].balanceAmount + '" readonly class="form-control paid_salaryamount"/>',
                        });
                        var column_6 = $('<td/>', {
                            html: '<input type="text" class="form-control dbsalry_amountgiven" id="amountgiven" name="amountgiven[]" ' + response[i].readonly + '  style="background: #f8f9fa;" placeholder="' + response[i].placeholder + '"/>',
                        });
                        var column_7 = $('<td/>', {
                            html: '<input type="text" class="form-control dbpayoffnotes" id="dbpayoffnotes" name="dbpayoffnotes[]" ' + response[i].readonly + ' placeholder="' + response[i].noteplaceholder + '"/>',
                        });

                        var row = $('<tr id=salrydetailrow/>', {}).append(column_0, column_1, column_2,
                            column_3, column_4, column_5, column_6, column_7);

                        $('#deliveryboysalrayrow').append(row);
                        $('#head_deliveryboysalrayrow').show();
                }
            }
        });
    });

    $(document).on("keyup", ".dbsalry_amountgiven", function() {
        var amountgiven = $(this).val();
        var total_salaryamount = $(this).parents('tr').find('.total_salaryamount').val();
        var paid_salaryamount = $(this).parents('tr').find('.paid_salaryamount').val();
        var balanceSalary = Number(total_salaryamount) - Number(paid_salaryamount);
        if (Number(amountgiven) > Number(balanceSalary)) {
            alert('!Paid Amount is More than of Total!');
            //$(this).parents('tr').find('.amountgiven').val('');
        }
    });
});



</script>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" />
                        <a href="{{ route('deliveryboyspayoff.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection


