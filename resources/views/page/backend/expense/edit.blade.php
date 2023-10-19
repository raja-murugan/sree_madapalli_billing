@extends('layout.backend.auth')

@section('content')

   <div class="content">
      <div class="page-header">
         <div class="page-title">
            <h4>Add Expense</h4>
         </div>
      </div>



        <div class="card">
            <div class="card-body">
               <form autocomplete="off" method="POST" action="{{ route('expense.update', ['unique_key' => $Expense->unique_key]) }}" enctype="multipart/form-data">
                  @method('PUT')
                  @csrf


                  <div class="row">



                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Date<span
                                        style="color: red;">*</span></label>
                                <input type="date" name="date" placeholder="" value="{{ $Expense->date }}" required>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Time<span
                                        style="color: red;">*</span></label>
                                <input type="time" name="time" placeholder="" value="{{ $Expense->time }}" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-12">
                            <div class="form-group">
                                <label style="font-size:15px;padding-top: 5px;padding-bottom: 2px;">Bank<span
                                        style="color: red;">*</span> </label>
                                <select class="form-control js-example-basic-single select" name="bank_id" id="bank_id" required>
                                    <option value="" disabled selected hiddden>Select Bank</option>
                                    @foreach ($Bank as $Banks)
                                        <option value="{{ $Banks->id }}"@if ($Banks->id === $Expense->bank_id) selected='selected' @endif>{{ $Banks->name }}</option>
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
                                        <th style="font-size:15px; width:40%;">Note</th>
                                        <th style="font-size:15px; width:40%;">Price</th>
                                        <th style="font-size:15px; width:20%;">Action </th>
                                    </tr>
                                </thead>
                                <tbody class="expense_fields">
                                @foreach ($Expensedata as $index => $Expensedatas)
                                    <tr>
                                        <td>
                                          <input type="hidden"id="expenes_detail_id"name="expenes_detail_id[]" value="{{ $Expensedatas->id }}"/>
                                            <input type="text" class="form-control note" id="note" name="note[]" placeholder="note" value="{{ $Expensedatas->note }}" required />
                                        </td>
                                        <td>
                                            <input type="text" class="form-control expenseprice" id="expenseprice" value="{{ $Expensedatas->price }}" name="expenseprice[]" placeholder="Price" value="" required />
                                        </td>
                                        <td style="background: #eee;">
                                            <button style="width: 35px;"class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-primary addexpensefields"
                                                type="button" id="" value="Add">+</button>
                                             <button style="width: 35px;" class="py-1 text-white font-medium rounded-lg text-sm  text-center btn btn-danger remove-expensetr" type="button" >-</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tbody>
                                <tr>
                                 <td></td>
                                 <td><input type="text" class="form-control expensetotal_price" id="total_price" value="{{ $Expense->total_price }}" name="total_price" placeholder="Total" readonly /></td></tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
                  <br />

               


                   



                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" onclick="expensesubmitForm(this);" />
                        <a href="{{ route('expense.index') }}" class="btn btn-danger" value="">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
