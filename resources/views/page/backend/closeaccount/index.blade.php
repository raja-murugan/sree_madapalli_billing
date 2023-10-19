@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Close Account</h4>
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
                                    <th>Date</th>
                                    <th>Close Amount</th>
                                    <th>Sales</th>
                                    <th>Profit / Loss</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($data as $keydata => $datas)
                                    <tr>
                                          <td>{{ ++$keydata }}</td>
                                          <td>{{ date('d-m-Y', strtotime($datas->date)) }}</td>
                                          <td>{{ $datas->close_amount }}</td>
                                          <td>{{ $datas->sales }}</td>
                                          @if ($datas->close_amount > $datas->sales)
                                             @php $profit = $datas->close_amount - $datas->sales; @endphp
                                             <td>+{{ $profit }}</td>
                                          @elseif ($datas->close_amount < $datas->sales)
                                             @php $loss = $datas->sales - $datas->close_amount; @endphp
                                             <td>-{{ $loss }}</td>
                                          @else
                                          <td></td>
                                          @endif
                                          <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                   <li>
                                                         <a href="#edit{{ $datas->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas->unique_key }}"
                                                            data-bs-target=".closeaccountedit-modal-xl{{ $datas->unique_key }}"
                                                            class="badges bg-lightgrey" style="color: white">Edit</a>
                                                   </li>
                                                   <li>
                                                         <a href="#delete{{ $datas->unique_key }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas->unique_key }}"
                                                            data-bs-target=".closeaccountdelete-modal-xl{{ $datas->unique_key }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                   </li>
                                                </ul>
                                          </td>
                                    </tr>
                                          <div class="modal fade closeaccountedit-modal-xl{{ $datas->unique_key }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="editLargeModalLabel{{ $datas->unique_key }}"
                                                aria-hidden="true">
                                                @include('page.backend.closeaccount.edit')
                                          </div>
                                          <div class="modal fade closeaccountdelete-modal-xl{{ $datas->unique_key }}"
                                                tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                aria-labelledby="deleteLargeModalLabel{{ $datas->unique_key }}"
                                                aria-hidden="true">
                                                @include('page.backend.closeaccount.delete')
                                          </div>

                                    
                                 @endforeach
                              </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-4">

            @include('page.backend.closeaccount.create')
            </div>
        </div>
        

       
    </div>
@endsection
