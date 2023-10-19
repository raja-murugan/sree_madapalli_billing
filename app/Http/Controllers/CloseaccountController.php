<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Closeaccount;
use App\Models\Sale;
use App\Models\Expense;
use App\Models\Openaccount;


use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use PDF;


class CloseaccountController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $data = Closeaccount::where('soft_delete', '!=', 1)->get();


        $openaccountamount = Openaccount::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('amount');
        $saletotalamount = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('grandtotal');
        $salegpaytotalamount = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->where('payment_method', '=', 'GPAY')->sum('grandtotal');
        $salecashtotalamount = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->where('payment_method', '=', 'Cash')->sum('grandtotal');
        $saleqrcodetotalamount = Sale::where('soft_delete', '!=', 1)->where('date', '=', $today)->where('payment_method', '=', 'QR CODE')->sum('grandtotal');
        $expenseamount = Expense::where('soft_delete', '!=', 1)->where('date', '=', $today)->sum('total_price');

        $closeamount = $salegpaytotalamount + $salecashtotalamount + $saleqrcodetotalamount + $expenseamount;
        $closeamounttotal = $closeamount - $openaccountamount;

        
        return view('page.backend.closeaccount.index', compact('data', 'today', 'openaccountamount', 'saletotalamount', 'salegpaytotalamount', 'salecashtotalamount', 'saleqrcodetotalamount', 'expenseamount', 'closeamounttotal'));
        
    }



    public function store(Request $request)
    {
        $olddata = Closeaccount::where('date', '=', $request->get('date'))->where('soft_delete', '!=', 1)->first();

        if($olddata == ''){

            $randomkey = Str::random(5);

            $data = new Closeaccount();
    
            $data->unique_key = $randomkey;
            $data->date = $request->get('date');
            $data->opening_balance = $request->get('opening_balance');
            $data->sales = $request->get('sales');
            $data->qrcode = $request->get('qrcode');
            $data->card = $request->get('card');
            $data->cash_in_hand = $request->get('cash_in_hand');
            $data->expense = $request->get('expense');
            $data->close_amount = $request->get('close_amount');
    
            $data->save();
    
    
            return redirect()->route('closeaccount.index')->with('message', 'Added !');
        }else {
            return redirect()->route('closeaccount.index')->with('info', 'Already Existed !');
        }
        
    }


    public function edit(Request $request, $unique_key)
    {
        $CloseaccountData = Closeaccount::where('unique_key', '=', $unique_key)->first();

            $CloseaccountData->date = $request->get('date');
            $CloseaccountData->opening_balance = $request->get('opening_balance');
            $CloseaccountData->sales = $request->get('sales');
            $CloseaccountData->qrcode = $request->get('qrcode');
            $CloseaccountData->card = $request->get('card');
            $CloseaccountData->cash_in_hand = $request->get('cash_in_hand');
            $CloseaccountData->expense = $request->get('expense');
            $CloseaccountData->close_amount = $request->get('close_amount');

            $CloseaccountData->update();

        return redirect()->route('closeaccount.index')->with('info', 'Updated !');
    }


    public function delete($unique_key)
    {
        $data = Closeaccount::where('unique_key', '=', $unique_key)->first();

        $data->soft_delete = 1;

        $data->update();

        return redirect()->route('closeaccount.index')->with('warning', 'Deleted !');
    }
}
