@extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Delivery Boy - Payoff</h4>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('deliveryboyspayoff.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                        <a href="{{ route('deliveryboyspayoff.create') }}" class="btn btn-added" style="margin-right: 10px;">Add New</a>
                </div>  
                    
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>Month - Year</th>
                                <th>Delivery Boy</th>
                                <th>Salary Amount</th>
                                <th>Paid Salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payoffdata as $keydata => $datas)
                                <tr>
                                    <td> {{ $datas['month'] }} - {{ $datas['year']  }}</td>
                                    <td>{{ $datas['deliveryboy']  }}</td>
                                    <td> {{ $datas['total_salaryamount']  }}</td>
                                    <td> {{ $datas['paid_salary']  }}</td>
                                    <td>

                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                            
                                             <li>
                                                    <a href="{{ route('deliveryboyspayoff.edit', ['deliveryboyid' => $datas['deliveryboy_id'], 'month' => $datas['month'], 'year' => $datas['year']]) }}"
                                                        class="badges bg-lightgrey" style="color: white">Edit</a>
                                             </li>
                                        </ul>
                                    </td>
                                </tr>

                                
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
