<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Deliveryboy;
use App\Models\Deliveryattendance;
use App\Models\Deliveryattendancedata;
use App\Models\Session;
use App\Models\Deliveryboypayoff;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;
class DeliveryattendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');

        $time = strtotime($today);
        $curent_month = date("F",$time);


        $month = date("m",strtotime($today));
        $year = date("Y",strtotime($today));

        $list=array();
        $monthdates = [];
        for($d=1; $d<=31; $d++)
        {
            $times = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $times) == $month)
                $list[] = date('d', $times);
                $monthdates[] = date('Y-m-d', $times);
        }
        $attendence_Data = [];



        foreach (($monthdates) as $key => $monthdate_arr) {

            $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();

            foreach ($deliveryboy as $key => $deliveryboy_arr) {

                $sesionarr = Session::where('soft_delete', '!=', 1)->get();
                foreach ($sesionarr as $key => $sesionarry) {

                    $status = '';
                    $attendencedata = Deliveryattendancedata::where('deliveryboy_id', '=', $deliveryboy_arr->id)->where('date', '=', $monthdate_arr)->where('session_id', '=', $sesionarry->id)->first();
                    if($attendencedata != ""){

                        if($attendencedata->checkleave == 1){
                            if($attendencedata->attendance == 'Present'){
                                $status = 'NULL';
                            }
                            $attendence_id = $attendencedata->id;

                        }else if($attendencedata->checkleave == 0){

                            if($attendencedata->attendance == 'Present'){
                                $status = 'P';
                            }else if($attendencedata->attendance == 'Absent'){
                                $status = 'A';
                            }
                            $attendence_id = $attendencedata->id;
                        }
                        
                    }else {
                        $attendence_id = 0;
                    }
    
    
                    $attendence_Data[] = array(
                        'deliveryboy' => $deliveryboy_arr->name,
                        'deliveryboyid' => $deliveryboy_arr->id,
                        'attendence_status' => $status,
                        'date' => date("d",strtotime($monthdate_arr)),
                        'attendence_id' => $attendence_id
                    );
                }
                
                
            }
        }
        

        




        $session = Session::where('soft_delete', '!=', 1)->get();
        $session_terms = [];
        foreach ($session as $key => $session_arr) {

            if($session_arr->id == 1){
                $session = 'BF';
            }else if($session_arr->id == 2){
                $session = 'L';
            }else if($session_arr->id == 3){
                $session = 'D';
            }

            $session_terms[] = array(
                'id' => $session_arr->id,
                'session' => $session
            );
        }
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        
        return view('page.backend.delivery_attendance.index', compact('attendence_Data', 'today', 'timenow', 'Deliveryboy', 'curent_month', 'year', 'list', 'session_terms', 'monthdates', 'month'));
    }


    public function datefilter(Request $request) {
        $today = $request->get('from_date');

        $time = strtotime($today);
        $curent_month = date("F",$time);


        $month = date("m",strtotime($today));
        $year = date("Y",strtotime($today));

        $list=array();
        $monthdates = [];
        for($d=1; $d<=31; $d++)
        {
            $times = mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $times) == $month)
                $list[] = date('d', $times);
                $monthdates[] = date('Y-m-d', $times);
        }
        $attendence_Data = [];



        foreach (($monthdates) as $key => $monthdate_arr) {

            $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();

            foreach ($deliveryboy as $key => $deliveryboy_arr) {

                $sesionarr = Session::where('soft_delete', '!=', 1)->get();
                foreach ($sesionarr as $key => $sesionarry) {

                    $status = '';
                    $attendencedata = Deliveryattendancedata::where('deliveryboy_id', '=', $deliveryboy_arr->id)->where('date', '=', $monthdate_arr)->where('session_id', '=', $sesionarry->id)->first();
                    if($attendencedata != ""){

                        if($attendencedata->checkleave == 1){
                            if($attendencedata->attendance == 'Present'){
                                $status = 'NULL';
                            }
                            $attendence_id = $attendencedata->id;
                            
                        }else if($attendencedata->checkleave == 0){

                            if($attendencedata->attendance == 'Present'){
                                $status = 'P';
                            }else if($attendencedata->attendance == 'Absent'){
                                $status = 'A';
                            }
                            $attendence_id = $attendencedata->id;
                        }
                        
                    }else {
                        $attendence_id = 0;
                    }
    
    
                    $attendence_Data[] = array(
                        'deliveryboy' => $deliveryboy_arr->name,
                        'deliveryboyid' => $deliveryboy_arr->id,
                        'attendence_status' => $status,
                        'date' => date("d",strtotime($monthdate_arr)),
                        'attendence_id' => $attendence_id
                    );
                }
                
                
            }
        }
        

        




        $session = Session::where('soft_delete', '!=', 1)->get();
        $session_terms = [];
        foreach ($session as $key => $session_arr) {

            if($session_arr->id == 1){
                $session = 'BF';
            }else if($session_arr->id == 2){
                $session = 'L';
            }else if($session_arr->id == 3){
                $session = 'D';
            }

            $session_terms[] = array(
                'id' => $session_arr->id,
                'session' => $session
            );
        }
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');

        
        return view('page.backend.delivery_attendance.index', compact('attendence_Data', 'today', 'timenow', 'Deliveryboy', 'curent_month', 'year', 'list', 'session_terms', 'monthdates', 'month'));
    }


    public function create()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.create', compact('deliveryboy', 'today', 'timenow', 'session'));
    }



    public function breakfastcreate()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.breakfastcreate', compact('deliveryboy', 'today', 'timenow', 'session'));
    }


    public function lunchcreate()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.lunchcreate', compact('deliveryboy', 'today', 'timenow', 'session'));
    }


    public function dinnercreate()
    {
        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $session = Session::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.delivery_attendance.dinnercreate', compact('deliveryboy', 'today', 'timenow', 'session'));
    }



    public function store(Request $request)
    {
        $date = $request->get('date');
        $session_id = $request->get('session_id');

        $dateatend = Deliveryattendance::where('date', '=', $date)->where('session_id', '=', $session_id)->first();
        if($dateatend == ""){

            $randomkey = Str::random(5);

            $data = new Deliveryattendance();
            $data->unique_key = $randomkey;
            $data->date = $request->get('date');
            $data->time = $request->get('time');
            $data->month = date('m', strtotime($request->get('date')));
            $data->year = date('Y', strtotime($request->get('date')));
            $data->dateno = date('d', strtotime($request->get('date')));
            $data->session_id = $request->get('session_id');
            $data->save();

            $insertedId = $data->id;


            foreach ($request->get('deliveryboy_id') as $key => $deliveryboy_id) {
                $pprandomkey = Str::random(5);
    
                    $Deliveryattendancedata = new Deliveryattendancedata;
                    $Deliveryattendancedata->deliveryattendance_id = $insertedId;
                    $Deliveryattendancedata->deliveryboy_id = $deliveryboy_id;
                    $Deliveryattendancedata->deliveryboy = $request->deliveryboy[$key];
                    $Deliveryattendancedata->attendance = $request->attendance[$deliveryboy_id];
                    $Deliveryattendancedata->date = $request->get('date');
                    $Deliveryattendancedata->session_id = $request->get('session_id');
                    $Deliveryattendancedata->month = date('m', strtotime($request->get('date')));
                    $Deliveryattendancedata->year = date('Y', strtotime($request->get('date')));
                    $Deliveryattendancedata->save();
    
            }

            return redirect()->route('delivery_attendance.index')->with('message', 'Attendance Data added successfully!');
        }else {

            return redirect()->route('delivery_attendance.index')->with('warning', 'the delivery boy BreakFast attendance already registered..Please edit!');
        }
    }



   

    public function edit($date, $session_id)
    {
        $Deliveryattendance = Deliveryattendance::where('date', '=', $date)->where('session_id', '=', $session_id)->first();
        if($Deliveryattendance != ""){

            $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
            $session = Session::where('soft_delete', '!=', 1)->get();
            $today = Carbon::now()->format('Y-m-d');
            $timenow = Carbon::now()->format('H:i');
            $Deliveryattendancedata = Deliveryattendancedata::where('deliveryattendance_id', '=', $Deliveryattendance->id)->get();

            $sessionname = Session::findOrFail($session_id);

            return view('page.backend.delivery_attendance.edit', compact('Deliveryattendance', 'deliveryboy', 'today', 'timenow', 'Deliveryattendancedata', 'session', 'sessionname', 'session_id'));
        }else {
            if($session_id == 1){

                $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
                $session = Session::where('soft_delete', '!=', 1)->get();
                $today = $date;
                $timenow = Carbon::now()->format('H:i');

                return view('page.backend.delivery_attendance.breakfastcreate', compact('deliveryboy', 'today', 'timenow', 'session'));

            }else if($session_id == 2){

                $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
                $session = Session::where('soft_delete', '!=', 1)->get();
                $today = $date;
                $timenow = Carbon::now()->format('H:i');
        
                return view('page.backend.delivery_attendance.lunchcreate', compact('deliveryboy', 'today', 'timenow', 'session'));


            }else if($session_id == 3){

                $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
                $session = Session::where('soft_delete', '!=', 1)->get();
                $today = $date;
                $timenow = Carbon::now()->format('H:i');

                return view('page.backend.delivery_attendance.dinnercreate', compact('deliveryboy', 'today', 'timenow', 'session'));

            }
        }
        

        
    }


    public function update(Request $request, $unique_key)
    {
        $delivery_attendance = Deliveryattendance::where('unique_key', '=', $unique_key)->first();

        $delivery_attendance->date = $request->get('date');
        $delivery_attendance->time = $request->get('time');
        $delivery_attendance->month = date('m', strtotime($request->get('date')));
        $delivery_attendance->year = date('Y', strtotime($request->get('date')));
        $delivery_attendance->dateno = date('d', strtotime($request->get('date')));
        $delivery_attendance->session_id = $request->get('session_id');
        $delivery_attendance->update();

        $attendance_id = $delivery_attendance->id;


        foreach ($request->get('deliveryboy_id') as $key => $deliveryboy_id) {
                
                $attendanceid = $attendance_id;
                $attendance = $request->attendance[$deliveryboy_id];

                DB::table('deliveryattendancedatas')->where('deliveryattendance_id', $attendanceid)->where('deliveryboy_id', $deliveryboy_id)->update([
                    'attendance' => $attendance
                ]);
        }


        return redirect()->route('delivery_attendance.index')->with('info', 'Updated !');


    }




    public function dayedit(Request $request, $date)
    {
        $Deliveryattendance = Deliveryattendance::where('date', '=', $date)->first();
        if($Deliveryattendance == ""){

            $session = Session::where('soft_delete', '!=', 1)->get();
            foreach ($session as $key => $sessions_arr) {

                $data = new Deliveryattendance();
                $data->date = $date;
                $data->month = date('m', strtotime($date));
                $data->year = date('Y', strtotime($date));
                $data->dateno = date('d', strtotime($date));
                $data->session_id = $sessions_arr->id;
                $data->save();


                $insertedId = $data->id;


                $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
                foreach ($Deliveryboy as $key => $Deliveryboy_arr) {

                    $Deliveryattendancedata = new Deliveryattendancedata;
                    $Deliveryattendancedata->deliveryattendance_id = $insertedId;
                    $Deliveryattendancedata->deliveryboy_id = $Deliveryboy_arr->id;
                    $Deliveryattendancedata->deliveryboy = $Deliveryboy_arr->name;
                    $Deliveryattendancedata->date = $date;
                    $Deliveryattendancedata->month = date('m', strtotime($date));
                    $Deliveryattendancedata->year = date('Y', strtotime($date));
                    $Deliveryattendancedata->attendance = 'Present';
                    $Deliveryattendancedata->session_id = $sessions_arr->id;
                    $Deliveryattendancedata->checkleave = 1;
                    $Deliveryattendancedata->save();
                }
            }

           
    
            

            return redirect()->route('delivery_attendance.index')->with('info', 'Leave Updated !');
        }else {
            return redirect()->route('delivery_attendance.index')->with('warning', 'Attendance Added for this date. so you cannot change !');
        }

            

        
    }


    public function getdeliveryboy_totpresentdays()
    {
        $salary_month = request()->get('salary_month');

        $today = Carbon::now()->format('Y-m-d');
        $year = request()->get('salary_year');

        $atendance_output = [];
        
            $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
            foreach ($Deliveryboy as $key => $Deliveryboy_arr) {

                $presentdays = Deliveryattendancedata::where('deliveryboy_id', '=', $Deliveryboy_arr->id)->where('month', '=', $salary_month)->where('year', '=', $year)->where('attendance', '=', 'Present')->get();
                $count = collect($presentdays)->count();

                $pershiftsalary = $Deliveryboy_arr->pershiftsalary;
                $total_salary = $pershiftsalary * $count;

                $paidsalary = Deliveryboypayoff::where('deliveryboy_id', '=', $Deliveryboy_arr->id)->where('month', '=', $salary_month)->where('year', '=', $year)->first();
                if($paidsalary != ""){

                    if($paidsalary->paid_salary > 0){
                        $paid_salary = $paidsalary->paid_salary;
                    }else {
                        $paid_salary = 0;
                    }
                }else {
                    $paid_salary = 0;
                }
                $balanceAmount = $total_salary - $paid_salary;

                if($total_salary == 0){
                    $placeholder = 'Enter Amount';
                    $readonly = '';
                    $noteplaceholder = 'Enter Note';
                }else {
                    if($balanceAmount == 0){
                        $readonly = 'readonly';
                        $placeholder = '';
                        $noteplaceholder = '';
                    }else {
                        $readonly = '';
                        $placeholder = 'Enter Amount';
                        $noteplaceholder = 'Enter Note';
                        
                    }
                }
                

               
                $days = cal_days_in_month( 0, $salary_month, $year);
                $atendance_output[] = array(
                    'total_days' => $days,
                    'total_presentdays' => $count,
                    'total_salary' => $total_salary,
                    'pershiftsalary' => $Deliveryboy_arr->pershiftsalary,
                    'deliveryboy' => $Deliveryboy_arr->name,
                    'id' => $Deliveryboy_arr->id,
                    'paid_salary' => $paid_salary,
                    'balanceAmount' => $balanceAmount,
                    'readonly' => $readonly,
                    'placeholder' => $placeholder,
                    'noteplaceholder' => $noteplaceholder,
                );
            
            }

            
            echo json_encode($atendance_output);
    }



}
