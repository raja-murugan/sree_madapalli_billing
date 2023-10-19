<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Deliveryboypayoff;
use App\Models\Deliveryboypayoffdata;
use App\Models\Deliveryboy;
use App\Models\Deliveryattendance;
use App\Models\Deliveryattendancedata;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class DeliverypayoffController extends Controller
{

   public function index()
   {
       
       $today = Carbon::now()->format('Y-m-d');
       $data = Deliveryboypayoff::where('month', '=', date('m', strtotime($today)))->where('year', '=', date('Y', strtotime($today)))->where('soft_delete', '!=', 1)->get();
       $payoffdata = [];
       foreach ($data as $key => $datas) {

           $deliveryboy = Deliveryboy::findOrFail($datas->deliveryboy_id);

           $payoffdata[] = array(
               'date' => $datas->date,
               'month' => $datas->month,
               'year' => $datas->year,
               'deliveryboy_id' => $datas->deliveryboy_id,
               'deliveryboy' => $deliveryboy->name,
               'total_days' => $datas->total_days,
               'present_shifts' => $datas->present_shifts,
               'pershiftsalary' => $datas->pershiftsalary,
               'total_salaryamount' => $datas->total_salaryamount,
               'paid_salary' => $datas->paid_salary,
               'amountgiven' => $datas->amountgiven,
               'status' => $datas->status,
               'id' => $datas->id,
               'unique_key' => $datas->unique_key
           );
       }
       $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
       $timenow = Carbon::now()->format('H:i');
       return view('page.backend.deliveryboyspayoff.index', compact('payoffdata', 'deliveryboy', 'today', 'timenow'));
   }


   public function datefilter(Request $request) {
      $today = $request->get('from_date');
      
      $data = Deliveryboypayoff::where('month', '=', date('m', strtotime($today)))->where('year', '=', date('Y', strtotime($today)))->where('soft_delete', '!=', 1)->get();
      $payoffdata = [];
      foreach ($data as $key => $datas) {

          $deliveryboy = Deliveryboy::findOrFail($datas->deliveryboy_id);

          $payoffdata[] = array(
              'date' => $datas->date,
              'month' => $datas->month,
              'year' => $datas->year,
              'deliveryboy_id' => $datas->deliveryboy_id,
              'deliveryboy' => $deliveryboy->name,
              'total_days' => $datas->total_days,
              'present_shifts' => $datas->present_shifts,
              'pershiftsalary' => $datas->pershiftsalary,
              'total_salaryamount' => $datas->total_salaryamount,
              'paid_salary' => $datas->paid_salary,
              'amountgiven' => $datas->amountgiven,
              'status' => $datas->status,
              'id' => $datas->id,
              'unique_key' => $datas->unique_key
          );
      }
      $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
      $timenow = Carbon::now()->format('H:i');
      return view('page.backend.deliveryboyspayoff.index', compact('payoffdata', 'deliveryboy', 'today', 'timenow'));
   }


   public function create()
    {
        
        $Deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $maxDays=date('t');

        $years = date('Y', strtotime($today)) - 1;
        $years_arr = array($years, $years+1, $years+2);
        //$shiftatend = Empattendancedata::where('employee_id', '=', $employee_id)->first();

        $current_year = Carbon::now()->format('Y');
       
        return view('page.backend.deliveryboyspayoff.create', compact('Deliveryboy', 'today', 'timenow', 'maxDays', 'years_arr', 'current_year'));
    }


    public function store(Request $request)
    {
        $date = $request->get('date');
        $salrymonth = $request->get('salary_month');



        foreach ($request->get('amountgiven') as $key => $amount_given) {
            if($request->amountgiven[$key] != ""){
                
                $pdrandomkey = Str::random(5);
                $Deliveryboypayoffdata = new Deliveryboypayoffdata();
                $Deliveryboypayoffdata->unique_key = $pdrandomkey;
                $Deliveryboypayoffdata->date = $request->get('date');
                $Deliveryboypayoffdata->month = $request->get('salary_month');
                $Deliveryboypayoffdata->year = $request->get('salary_year');
                $Deliveryboypayoffdata->deliveryboy_id = $request->deliveryboy_id[$key];
                $Deliveryboypayoffdata->payable_amount = $request->amountgiven[$key];
                $Deliveryboypayoffdata->payoffnotes = $request->dbpayoffnotes[$key];
                $Deliveryboypayoffdata->save();

            }
        }




        foreach ($request->get('amountgiven') as $key => $amountgiven) {

            $deliveryboy_id = $request->deliveryboy_id[$key];
            $month = $request->get('salary_month');
            $year = $request->get('salary_year');

            $GetEmloyeeSalaryRow = Deliveryboypayoff::where('deliveryboy_id', '=', $deliveryboy_id)->where('month', '=', $month)->where('year', '=', $year)->first();
            if($GetEmloyeeSalaryRow != ""){

                $date = $request->date[$key];
                $total_days = $request->totaldays[$key];
                $present_shifts = $request->total_presentdays[$key];
                $pershiftsalary = $request->pershiftsalary[$key];
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

                DB::table('deliveryboypayoffs')->where('id', $GetEmloyeeSalaryRow->id)->update([
                    'total_days' => $total_days,  'present_shifts' => $present_shifts,  'pershiftsalary' => $pershiftsalary,  'total_salaryamount' => $total_salaryamount,  'paid_salary' => $newPaidSalary,  'amountgiven' => $amountgiven,  'status' => $status
                ]);

            }else {

                $srandomkey = Str::random(5);

                $Deliveryboypayoff = new Deliveryboypayoff();

                $Deliveryboypayoff->unique_key = $srandomkey;
                $Deliveryboypayoff->date = $request->get('date');
                $Deliveryboypayoff->month = $request->get('salary_month');
                $Deliveryboypayoff->year = $request->get('salary_year');
                $Deliveryboypayoff->deliveryboy_id = $request->deliveryboy_id[$key];
                $Deliveryboypayoff->total_days = $request->totaldays[$key];
                $Deliveryboypayoff->present_shifts = $request->total_presentdays[$key];
                $Deliveryboypayoff->pershiftsalary = $request->pershiftsalary[$key];
                $Deliveryboypayoff->total_salaryamount = $request->total_salaryamount[$key];
                $Deliveryboypayoff->paid_salary = $request->amountgiven[$key];
    
                $tot_salary = $request->total_salaryamount[$key];
                $paid_salary = $request->amountgiven[$key];
    
                if($tot_salary == $paid_salary){
                    $Deliveryboypayoff->status = 'Paid';
                }else if($tot_salary < $paid_salary){
                    $Deliveryboypayoff->status = 'ExtraPaid';
                }else if($paid_salary == ''){
                    $Deliveryboypayoff->status = 'NotPaid';
                }else if($tot_salary > $paid_salary){
                    $Deliveryboypayoff->status = 'Lesspaid';
                }
                $Deliveryboypayoff->save();
            }

                
            
        }


        

        return redirect()->route('deliveryboyspayoff.index')->with('message', 'Data added successfully!');
            
    }



    public function edit($deliveryboyid, $month, $year)
    {
        $GetPayoffArray = Deliveryboypayoffdata::where('deliveryboy_id', '=', $deliveryboyid)->where('month', '=', $month)->where('year', '=', $year)->get();
        $payoffdatas = [];
        foreach ($GetPayoffArray as $key => $GetPayoffArrays) {

            $deliveryboy = Deliveryboy::findOrFail($GetPayoffArrays->deliveryboy_id);

            $GetEmloyeeSalaryRow = Deliveryboypayoff::where('deliveryboy_id', '=', $GetPayoffArrays->deliveryboy_id)->where('month', '=', $GetPayoffArrays->month)->where('year', '=', $GetPayoffArrays->year)->first();

            $payoffdatas[] = array(
                'unique_key' => $GetPayoffArrays->unique_key,
                'deliveryboy_id' => $GetPayoffArrays->deliveryboy_id,
                'deliveryboy' => $deliveryboy->name,
                'date' => $GetPayoffArrays->date,
                'month' => $GetPayoffArrays->month,
                'year' => $GetPayoffArrays->year,
                'payable_amount' => $GetPayoffArrays->payable_amount,
                'payoffnotes' => $GetPayoffArrays->payoffnotes,
                'id' => $GetPayoffArrays->id,
                'present_shifts' => $GetEmloyeeSalaryRow->present_shifts,
                'total_days' => $GetEmloyeeSalaryRow->total_days,
                'pershiftsalary' => $GetEmloyeeSalaryRow->pershiftsalary,
                'total_salaryamount' => $GetEmloyeeSalaryRow->total_salaryamount,
            );
        }


        $deliveryboy = Deliveryboy::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        $maxDays=date('t');

        $years = date('Y', strtotime($today)) - 1;
        $years_arr = array($years, $years+1, $years+2);

        $current_year = Carbon::now()->format('Y');

        $Deliveryboyname = Deliveryboy::findOrFail($deliveryboyid);
       
        return view('page.backend.deliveryboyspayoff.edit', compact('deliveryboy', 'today', 'timenow', 'maxDays', 'years_arr', 'current_year', 'payoffdatas', 'year', 'month', 'deliveryboyid', 'Deliveryboyname'));
    }



    public function update(Request $request, $deliveryboyid, $month, $year)
    {
       $getinsertedP_Products = Deliveryboypayoffdata::where('deliveryboy_id', '=', $deliveryboyid)->where('month', '=', $month)->where('year', '=', $year)->get();
        $Purchaseproducts = array();
        foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
            $Purchaseproducts[] = $getinserted_P_Products->id;
        }

        $updatedpurchaseproduct_id = $request->payoffdata_id;
        $updated_PurchaseProduct_id = array_filter($updatedpurchaseproduct_id);
        $different_ids = array_merge(array_diff($Purchaseproducts, $updated_PurchaseProduct_id), array_diff($updated_PurchaseProduct_id, $Purchaseproducts));

        if (!empty($different_ids)) {
            foreach ($different_ids as $key => $different_id) {
                Deliveryboypayoffdata::where('id', $different_id)->delete();
            }
        }


        
        foreach ($request->get('payoffdata_id') as $key => $payoffdata_id) {

            $payable_amount = $request->amountgiven[$key];
            $payoffnotes = $request->payoffnotes[$key];
            $date = $request->date[$key];

            DB::table('deliveryboypayoffdatas')->where('id', $payoffdata_id)->update([
                'date' => $date,  'payable_amount' => $payable_amount,  'payoffnotes' => $payoffnotes
            ]);
        }

        $total_salary = Deliveryboypayoffdata::where('deliveryboy_id', '=', $deliveryboyid)->where('month', '=', $month)->where('year', '=', $year)->sum('payable_amount');

        DB::table('deliveryboypayoffs')->where('deliveryboy_id', $deliveryboyid)->where('month', $month)->where('year', $year)->update([
            'paid_salary' => $total_salary
        ]);



        return redirect()->route('deliveryboyspayoff.index')->with('info', 'Updated !');
    }

}
