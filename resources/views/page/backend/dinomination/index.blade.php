@extends('layout.backend.auth')

@section('content')
    <div class="content">
         <div class="page-header">
                  <div class="page-title">
                     <h4>Determination</h4>
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
                                    <th>Amount</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($determination_Data as $keydata => $datas)
                                    <tr>
                                          <td>{{ ++$keydata }}</td>
                                          <td>{{ date('d-m-Y', strtotime($datas['date'])) }}</td>
                                          <td>{{ $datas['total_amount'] }}</td>
                                          <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                   <li>
                                                         <a href="#edit{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas['unique_key'] }}"
                                                            data-bs-target=".determinationedit-modal-xl{{ $datas['unique_key'] }}"
                                                            class="badges bg-lightgrey determinationedit{{ $datas['id'] }}" style="color: white">Edit</a>
                                                   </li>
                                                   <li>
                                                         <a href="#delete{{ $datas['unique_key'] }}" data-bs-toggle="modal"
                                                            data-id="{{ $datas['unique_key'] }}"
                                                            data-bs-target=".determinationdelete-modal-xl{{ $datas['unique_key'] }}"
                                                            class="badges bg-lightyellow" style="color: white">Delete</a>
                                                   </li>
                                                </ul>
                                          </td>
                                    </tr>
                                          <div class="modal fade determinationedit-modal-xl{{ $datas['unique_key'] }}"
                                                tabindex="-1" role="dialog" data-bs-backdrop="static"
                                                aria-labelledby="editLargeModalLabel{{ $datas['unique_key'] }}"
                                                aria-hidden="true">
                                                @include('page.backend.dinomination.edit')
                                          </div>
                                          <div class="modal fade determinationdelete-modal-xl{{ $datas['unique_key'] }}"
                                                tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                aria-labelledby="deleteLargeModalLabel{{ $datas['unique_key'] }}"
                                                aria-hidden="true">
                                                @include('page.backend.dinomination.delete')
                                          </div>

                                    
                                 @endforeach
                              </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-4">

            @include('page.backend.dinomination.create')
            </div>
        </div>
        

       
    </div>
@endsection
