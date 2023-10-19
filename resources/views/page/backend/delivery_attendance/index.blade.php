                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            @extends('layout.backend.auth')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Delivery Attendance</h4>
            </div>
            <div class="page-btn">

                <div style="display: flex;">
                        <form autocomplete="off" method="POST" action="{{ route('delivery_attendance.datefilter') }}">
                            @method('PUT')
                            @csrf
                            <div style="display: flex">
                                 <div style="margin-right: 10px;"><input type="date" name="from_date"
                                        class="form-control from_date" value="{{ $today }}"></div>
                                <div style="margin-right: 10px;"><input type="submit" class="btn btn-success"
                                        value="Search" /></div>
                            </div>
                        </form>
                        <a href="{{ route('delivery_attendance.breakfastcreate') }}" class="btn btn-added" style="margin-right: 10px;background: black;">BreakFast</a>
                        <a href="{{ route('delivery_attendance.lunchcreate') }}" class="btn btn-added" style="margin-right: 10px;background: black;">Lunch</a>
                        <a href="{{ route('delivery_attendance.dinnercreate') }}" class="btn btn-added" style="margin-right: 10px;background: black;">Dinner</a>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body" style="overflow: auto;">

                    <div class="row">
                        <table class="table">
                            <thead><h5 style="text-transform: uppercase;text-align:center;color:black;padding-bottom:10px">{{ $curent_month}}-{{$year}}</h5></thead>
                            <thead>
                                <tr>
                                    <th class="border">Date</th>
                                    @foreach ($list as $lists)
                                        <th colspan="3" class="border" style="text-align:center;">{{ $lists }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="border">Day</th>
                                    @foreach ($list as $lists_ass)
                                    @php 
                                    
                                    $timestamp = strtotime($year .'-'. $month .'-'. $lists_ass); 
                                    $day = date('l', $timestamp);
                                    $date = $year .'-'. $month .'-'. $lists_ass;
                                    @endphp

                                    
                                            <th class="border" colspan="3" style="text-align:center;">
                                                <a href="#dayedit{{ $date }}" data-bs-toggle="modal" data-bs-target=".dayedit-modal-xl{{ $date }}"
                                                                class="badges bg-lightyellow dayedit{{ $date }}" style="color: white">{{$day}}</a>
                                            </th>
                                            <div class="modal fade dayedit-modal-xl{{ $date }}"
                                                tabindex="-1" role="dialog"data-bs-backdrop="static"
                                                aria-labelledby="deleteLargeModalLabel{{ $date }}"
                                                aria-hidden="true">
                                                @include('page.backend.delivery_attendance.dayedit')
                                            </div>

                                    
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="border">Session</th>
                                    @foreach ($list as $lists)
                                    @foreach ($session_terms as $session_termsarr)
                                    <th class="border" style="text-align:center;">{{$session_termsarr['session']}}</th>
                                    @endforeach
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="border">Add / Edit</td>
                                @foreach ($list as $lists)
                               @foreach ($session_terms as $session_termsarr)
                                     <td class="border"><a href="{{ route('delivery_attendance.edit', ['date' => $year.'-'.$month. '-'.$lists, 'session_id' => $session_termsarr['id']]) }}" class="btn btn-sm btn-soft-info">
                                     <i class="fa fa-edit" data-bs-toggle="tooltip" title="fa fa-edit"></i></a></td>
                                @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                        <tbody>
                            @foreach ($Deliveryboy as $Deliveryboyarr)
                            <tr class="border">
                                <td class="border" >{{$Deliveryboyarr->name}}</td>

                                @foreach ($attendence_Data as $attendence_Data_arr)
                                    @if ($Deliveryboyarr->id == $attendence_Data_arr['deliveryboyid'])

                                        @if ($attendence_Data_arr['attendence_status'] == 'P')
                                            <td class="border" style="color:green;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
                                        @elseif ($attendence_Data_arr['attendence_status'] == 'A')
                                            <td class="border" style="color:red;" >{{ $attendence_Data_arr['attendence_status'] }}</td>
                                        @elseif($attendence_Data_arr['attendence_status'] == 'NULL')
                                             <td class="border" style="color:#76691b;font-weight: 800;">H</td>
                                            @else
                                             <td class="border"></td>
                                        @endif

                                    @endif
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
@endsection
