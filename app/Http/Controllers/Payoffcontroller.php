<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Payoff;
use App\Models\Payoffdata;
use App\Models\Employee;
use App\Models\Empattendance;
use App\Models\Empattendancedata;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class Payoffcontroller extends Controller
{
    public function index()
    {
        
        $today = Carbon::now()->format('Y-m-d');
        $data = Payoff::where('month', '=', date('m', strtotime($today)))->where('year', '=', date('Y', strtotime($today)))->where('soft_delete', '!=', 1)->get();
        $payoffdata = [];
        foreach ($data as $key => $datas) {

            $employee = Employee::findOrFail($datas->employee_id);

            $payoffdata[] = array(
                'date' => $datas->date,
                'month' => $datas->month,
                'year' => $datas->year,
                'employee_id' => $datas->employee_id,
                'employee' => $employee->name,
                'total_days' => $datas->total_days,
                'present_days' => $datas->present_days,
                'perdaysalary' => $datas->perdaysalary,
                'total_salaryamount' => $datas->total_salaryamount,
                'paid_salary' => $datas->paid_salary,
                'amountgiven' => $datas->amountgiven,
                'status' => $datas->status,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key
            );
        }
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');
        return view('page.backend.payoff.index', compact('payoffdata', 'employee', 'today', 'timenow'));
    }



    public function datefilter(Request $request) {
        $today = $request->get('from_date');
        $data = Payoff::where('month', '=', date('m', strtotime($today)))->where('year', '=', date('Y', strtotime($today)))->where('soft_delete', '!=', 1)->get();
        $payoffdata = [];
        foreach ($data as $key => $datas) {

            $employee = Employee::findOrFail($datas->employee_id);

            $payoffdata[] = array(
                'date' => $datas->date,
                'month' => $datas->month,
                'year' => $datas->year,
                'employee_id' => $datas->employee_id,
                'employee' => $employee->name,
                'total_days' => $datas->total_days,
                'present_days' => $datas->present_days,
                'perdaysalary' => $datas->perdaysalary,
                'total_salaryamount' => $datas->total_salaryamount,
                'paid_salary' => $datas->paid_salary,
                'amountgiven' => $datas->amountgiven,
                'status' => $datas->status,
                'id' => $datas->id,
                'unique_key' => $datas->unique_key
            );
        }
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $timenow = Carbon::now()->format('H:i');
        return view('page.backend.payoff.index', compact('payoffdata', 'employee', 'today', 'timenow'));
    }

    public function create()
    {
        
        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $maxDays=date('t');

        $years = date('Y', strtotime($today)) - 1;
        $years_arr = array($years, $years+1, $years+2);
        //$shiftatend = Empattendancedata::where('employee_id', '=', $employee_id)->first();

        $current_year = Carbon::now()->format('Y');
       
        return view('page.backend.payoff.create', compact('employee', 'today', 'timenow', 'maxDays', 'years_arr', 'current_year'));
    }



    public function store(Request $request)
    {
        $date = $request->get('date');
        $salrymonth = $request->get('salary_month');



        foreach ($request->get('amountgiven') as $key => $amount_given) {
            if($request->amountgiven[$key] != ""){
                
                $pdrandomkey = Str::random(5);
                $Payoffdata = new Payoffdata();
                $Payoffdata->unique_key = $pdrandomkey;
                $Payoffdata->date = $request->get('date');
                $Payoffdata->month = $request->get('salary_month');
                $Payoffdata->year = $request->get('salary_year');
                $Payoffdata->employee_id = $request->employee_id[$key];
                $Payoffdata->payable_amount = $request->amountgiven[$key];
                $Payoffdata->payoffnotes = $request->payoffnotes[$key];
                $Payoffdata->save();

            }
        }




        foreach ($request->get('amountgiven') as $key => $amountgiven) {

            $employee_id = $request->employee_id[$key];
            $month = $request->get('salary_month');
            $year = $request->get('salary_year');

            $GetEmloyeeSalaryRow = Payoff::where('employee_id', '=', $employee_id)->where('month', '=', $month)->where('year', '=', $year)->first();
            if($GetEmloyeeSalaryRow != ""){

                $date = $request->date[$key];
                $total_days = $request->totaldays[$key];
                $present_days = $request->total_presentdays[$key];
                $perdaysalary = $request->perdaysalary[$key];
                $total_salaryamount = $request->total_salaryamount[$key];

                $oldpaid_salary = $request->paid_salaryamount[$key];
                $amountgiven = $request->amountgiven[$key];

                $newPaidSalary = $oldpaid_salary + $amountgiven;

                if($total_salaryamount == $newPaidSalary){
                    $status = 'Paid';
                }else if($total_salaryamount < $newPaidSalary){
                    $status = 'ExtraPaid';
                }else if($total_salaryamount == ''){
                    $status = 'NotPaid';
                }else if($total_salaryamount > $newPaidSalary){
                    $status = 'Lesspaid';
                }

                DB::table('payoffs')->where('id', $GetEmloyeeSalaryRow->id)->update([
                    'total_days' => $total_days,  'present_days' => $present_days,  'perdaysalary' => $perdaysalary,  'total_salaryamount' => $total_salaryamount,  'paid_salary' => $newPaidSalary,  'amountgiven' => $amountgiven,  'status' => $status
                ]);

            }else {

                $randomkey = Str::random(5);

                $Payoff = new Payoff();

                $Payoff->unique_key = $randomkey;
                $Payoff->date = $request->get('date');
                $Payoff->month = $request->get('salary_month');
                $Payoff->year = $request->get('salary_year');
                $Payoff->employee_id = $request->employee_id[$key];
                $Payoff->total_days = $request->totaldays[$key];
                $Payoff->present_days = $request->total_presentdays[$key];
                $Payoff->perdaysalary = $request->perdaysalary[$key];
                $Payoff->total_salaryamount = $request->total_salaryamount[$key];
                $Payoff->paid_salary = $request->amountgiven[$key];
    
                $tot_salary = $request->total_salaryamount[$key];
                $paid_salary = $request->amountgiven[$key];
    
                if($tot_salary == $paid_salary){
                    $Payoff->status = 'Paid';
                }else if($tot_salary < $paid_salary){
                    $Payoff->status = 'ExtraPaid';
                }else if($paid_salary == ''){
                    $Payoff->status = 'NotPaid';
                }else if($tot_salary > $paid_salary){
                    $Payoff->status = 'Lesspaid';
                }
                $Payoff->save();
            }

                
            
        }


        

        return redirect()->route('payoff.index')->with('message', 'Data added successfully!');
            
    }


    public function edit($empid, $month, $year)
    {
        $GetPayoffArray = Payoffdata::where('employee_id', '=', $empid)->where('month', '=', $month)->where('year', '=', $year)->get();
        $payoffdatas = [];
        foreach ($GetPayoffArray as $key => $GetPayoffArrays) {

            $employee = Employee::findOrFail($GetPayoffArrays->employee_id);

            $GetEmloyeeSalaryRow = Payoff::where('employee_id', '=', $GetPayoffArrays->employee_id)->where('month', '=', $GetPayoffArrays->month)->where('year', '=', $GetPayoffArrays->year)->first();

            $payoffdatas[] = array(
                'unique_key' => $GetPayoffArrays->unique_key,
                'employee_id' => $GetPayoffArrays->employee_id,
                'employee' => $employee->name,
                'date' => $GetPayoffArrays->date,
                'month' => $GetPayoffArrays->month,
                'year' => $GetPayoffArrays->year,
                'payable_amount' => $GetPayoffArrays->payable_amount,
                'payoffnotes' => $GetPayoffArrays->payoffnotes,
                'id' => $GetPayoffArrays->id,
                'present_days' => $GetEmloyeeSalaryRow->present_days,
                'total_days' => $GetEmloyeeSalaryRow->total_days,
                'perdaysalary' => $GetEmloyeeSalaryRow->perdaysalary,
                'total_salaryamount' => $GetEmloyeeSalaryRow->total_salaryamount,
            );
        }


        $employee = Employee::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $maxDays=date('t');

        $years = date('Y', strtotime($today)) - 1;
        $years_arr = array($years, $years+1, $years+2);

        $current_year = Carbon::now()->format('Y');

        $employeename = Employee::findOrFail($empid);
       
        return view('page.backend.payoff.edit', compact('employee', 'today', 'timenow', 'maxDays', 'years_arr', 'current_year', 'payoffdatas', 'year', 'month', 'empid', 'employeename'));
    }



    public function update(Request $request, $empid, $month, $year)
    {
       $getinsertedP_Products = Payoffdata::where('employee_id', '=', $empid)->where('month', '=', $month)->where('year', '=', $year)->get();
        $Purchaseproducts = array();
        foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
            $Purchaseproducts[] = $getinserted_P_Products->id;
        }

        $updatedpurchaseproduct_id = $request->payoffdata_id;
        $updated_PurchaseProduct_id = array_filter($updatedpurchaseproduct_id);
        $different_ids = array_merge(array_diff($Purchaseproducts, $updated_PurchaseProduct_id), array_diff($updated_PurchaseProduct_id, $Purchaseproducts));

        if (!empty($different_ids)) {
            foreach ($different_ids as $key => $different_id) {
                Payoffdata::where('id', $different_id)->delete();
            }
        }


        
        foreach ($request->get('payoffdata_id') as $key => $payoffdata_id) {

            $payable_amount = $request->amountgiven[$key];
            $payoffnotes = $request->payoffnotes[$key];
            $date = $request->date[$key];

            DB::table('payoffdatas')->where('id', $payoffdata_id)->update([
                'date' => $date,  'payable_amount' => $payable_amount,  'payoffnotes' => $payoffnotes
            ]);
        }

        $total_salary = Payoffdata::where('employee_id', '=', $empid)->where('month', '=', $month)->where('year', '=', $year)->sum('payable_amount');

        DB::table('payoffs')->where('employee_id', $empid)->where('month', $month)->where('year', $year)->update([
            'paid_salary' => $total_salary
        ]);



        return redirect()->route('payoff.index')->with('info', 'Updated !');
    }
    
}
