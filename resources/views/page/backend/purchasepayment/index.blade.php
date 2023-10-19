@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Purchase Payment</h4>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('purchasepayment.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                </div>  
                    
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">


               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table  datanew">
                              <thead>
                                 <tr>
                                    <th>Sl. No</th>
                                    <th>Supplier</th>
                                    <th>Date</th>
                                    <th>Paid Amount</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($purchasepayment_data as $keydata => $purchasepayment_datas)
                                    <tr>
                                          <td>{{ ++$keydata }}</td>
                                          <td>{{ $purchasepayment_datas['supplier'] }}</td>
                                          <td>{{ $purchasepayment_datas['date'] }}</td>
                                          <td>{{ $purchasepayment_datas['paid_amount']  }}.00</td>
                                          <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                   <li>
                                                         <a href="#edit{{ $purchasepayment_datas['unique_key'] }}" data-bs-toggle="modal"
                                                            data-id="{{ $purchasepayment_datas['unique_key'] }}"
                                                            data-bs-target=".purchasepaymentedit-modal-xl{{ $purchasepayment_datas['unique_key'] }}"
                                                            class="badges bg-lightgrey" style="color: white">Edit</a>
                                                   </li>
                                                   <li>
                                                         <a href="#delete{{ $purchasepayment_datas['unique_key'] }}" data-bs-toggle="modal"
                                                            data-id="{{ $purchasepayment_datas['unique_key'] }}"
                                                            data-bs-target=".purchasepaymentdelete-modal-xl{{ $purchasepayment_datas['unique_key'] }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                   </li>
                                                </ul>
                                          </td>
                                    </tr>
                                          <div class="modal fade purchasepaymentedit-modal-xl{{ $purchasepayment_datas['unique_key'] }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="editLargeModalLabel{{ $purchasepayment_datas['unique_key'] }}"
                                                aria-hidden="true">
                                                @include('page.backend.purchasepayment.edit')
                                          </div>
                                          <div class="modal fade purchasepaymentdelete-modal-xl{{ $purchasepayment_datas['unique_key'] }}"
                                                tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                aria-labelledby="deleteLargeModalLabel{{ $purchasepayment_datas['unique_key'] }}"
                                                aria-hidden="true">
                                                @include('page.backend.purchasepayment.delete')
                                          </div>

                                    
                                 @endforeach
                              </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-4">

            @include('page.backend.purchasepayment.create')
            </div>
        </div>
        

       
    </div>
@endsection
