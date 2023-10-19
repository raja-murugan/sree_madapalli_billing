<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Expense;
use App\Models\Expensedata;
use App\Models\Bank;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PDF;

class ExpenseController extends Controller
{
    public function index()
    {

        $today = Carbon::now()->format('Y-m-d');

        $data = Expense::where('date', '=', $today)->where('soft_delete', '!=', 1)->get();

        $expense_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $bank = Bank::findOrFail($datas->bank_id);


            $Expensedata = Expensedata::where('expense_id', '=', $datas->id)->get();
            foreach ($Expensedata as $key => $Expensedatas_arr) {

                $terms[] = array(
                    'note' => $Expensedatas_arr->note,
                    'price' => $Expensedatas_arr->price,
                    'expense_id' => $Expensedatas_arr->expense_id,

                );
            }


            $expense_data[] = array(
                'unique_key' => $datas->unique_key,
                'date' => $datas->date,
                'time' => $datas->time,
                'terms' => $terms,
                'total_price' => $datas->total_price,
                'bank_id' => $datas->bank_id,
                'bank' => $bank->name,
                'id' => $datas->id,
            );

        }
        return view('page.backend.expense.index', compact('expense_data', 'today'));
    }

    public function datefilter(Request $request) {

        $today = $request->get('from_date');

        $data = Expense::where('date', '=', $today)->where('soft_delete', '!=', 1)->get();

        $expense_data = [];
        $terms = [];
        foreach ($data as $key => $datas) {
            $bank = Bank::findOrFail($datas->bank_id);


            $Expensedata = Expensedata::where('expense_id', '=', $datas->id)->get();
            foreach ($Expensedata as $key => $Expensedatas_arr) {

                $terms[] = array(
                    'note' => $Expensedatas_arr->note,
                    'price' => $Expensedatas_arr->price,
                    'expense_id' => $Expensedatas_arr->expense_id,

                );
            }


            $expense_data[] = array(
                'unique_key' => $datas->unique_key,
                'date' => $datas->date,
                'time' => $datas->time,
                'terms' => $terms,
                'total_price' => $datas->total_price,
                'bank_id' => $datas->bank_id,
                'bank' => $bank->name,
                'id' => $datas->id,
            );

        }
        return view('page.backend.expense.index', compact('expense_data', 'today'));
    }


    public function create()
    {
        $Bank = Bank::where('soft_delete', '!=', 1)->get();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');

        return view('page.backend.expense.create', compact('today', 'timenow', 'Bank'));
    }


    public function store(Request $request)
    {
        
            $randomkey = Str::random(5);

            $data = new Expense();
            $data->unique_key = $randomkey;
            $data->date = $request->get('date');
            $data->time = $request->get('time');
            $data->total_price = $request->get('total_price');
            $data->bank_id = $request->get('bank_id');
            $data->save();
    
            $insertedId = $data->id;
    
    
            foreach ($request->get('note') as $key => $note) {
    
                    $Expensedata = new Expensedata;
                    $Expensedata->expense_id = $insertedId;
                    $Expensedata->note = $note;
                    $Expensedata->price = $request->expenseprice[$key];
                    $Expensedata->save();
    
            }
    
    
            return redirect()->route('expense.index')->with('message', 'expense Data added successfully!');
    }

    public function edit($unique_key)
    {
        $Expense = Expense::where('unique_key', '=', $unique_key)->first();
        $today = Carbon::now()->format('Y-m-d');
        $timenow = Carbon::now()->format('H:i');
        $Expensedata = Expensedata::where('expense_id', '=', $Expense->id)->get();
        $Bank = Bank::where('soft_delete', '!=', 1)->get();

        return view('page.backend.expense.edit', compact('Expense', 'today', 'timenow', 'Expensedata', 'Bank'));
    }


    public function update(Request $request, $unique_key)
    {
        $Expense = Expense::where('unique_key', '=', $unique_key)->first();
       
        $Expense->date = $request->get('date');
        $Expense->time = $request->get('time');
        $Expense->total_price = $request->get('total_price');
        $Expense->bank_id = $request->get('bank_id');
        $Expense->update();

        $expense_id = $Expense->id;

        $getinsertedP_Products = Expensedata::where('expense_id', '=', $expense_id)->get();
        $Purchaseproducts = array();
        foreach ($getinsertedP_Products as $key => $getinserted_P_Products) {
            $Purchaseproducts[] = $getinserted_P_Products->id;
        }

        $updatedpurchaseproduct_id = $request->expenes_detail_id;
        $updated_PurchaseProduct_id = array_filter($updatedpurchaseproduct_id);
        $different_ids = array_merge(array_diff($Purchaseproducts, $updated_PurchaseProduct_id), array_diff($updated_PurchaseProduct_id, $Purchaseproducts));

        if (!empty($different_ids)) {
            foreach ($different_ids as $key => $different_id) {
                Expensedata::where('id', $different_id)->delete();
            }
        }



        foreach ($request->get('expenes_detail_id') as $key => $expenes_detail_id) {

            if ($expenes_detail_id > 0) {

                $ids = $expenes_detail_id;
                $expenseid = $expense_id;
                $price = $request->expenseprice[$key];
                $note = $request->note[$key];

                DB::table('expensedatas')->where('id', $ids)->update([
                    'expense_id' => $expenseid,  'price' => $price,  'note' => $note
                ]);

            } else if ($expenes_detail_id == '') {
                if ($request->note[$key] > 0) {

                    $Expensedata = new Expensedata;
                    $Expensedata->expense_id = $expenseid;
                    $Expensedata->note = $request->note[$key];
                    $Expensedata->price = $request->expenseprice[$key];
                    $Expensedata->save();
                }
            }

                
        }


        return redirect()->route('expense.index')->with('info', 'Updated !');


    }


    public function delete($unique_key)
    {
        $data = Expense::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('expense.index')->with('warning', 'Deleted !');
    }
}
